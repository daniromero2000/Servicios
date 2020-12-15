<?php

namespace  App\Http\Controllers\Admin\Document;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Entities\Documents\Repositories\Interfaces\DocumentRepositoryInterface;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\DocumentCategories\Repositories\Interfaces\DocumentCategoryRepositoryInterface;

class DocumentController extends Controller
{
    private $documentInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        DocumentRepositoryInterface $documentRepositoryInterface,
        DocumentCategoryRepositoryInterface $documentCategoryRepositoryInterface
    ) {
        $this->toolsInterface                  = $toolRepositoryInterface;
        $this->documentInterface               = $documentRepositoryInterface;
        $this->documentCategoryInterface       = $documentCategoryRepositoryInterface;
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->documentInterface->searchDocument(request()->input('q'), $skip * 30);
            $paginate = $this->documentInterface->countDocuments(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->documentInterface->searchDocument(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->documentInterface->countDocuments(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->documentInterface->countDocuments('');
            $list = $this->documentInterface->listDocuments($skip * 30);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        $attached = [];

        foreach ($list as $key3 => $value3) {
            $attached[$list[$key3]->id] = $value3->categoryLog->pluck('document_category_id')->all();
        }

        return view('documents.index', [
            'documents'       => $list,
            'skip'            => $skip,
            'headers'         => ['Nombre', 'Fecha', 'Estado', 'Opciones'],
            'routeEdit'       => 'documents.update',
            'optionsRoutes'   => '' . (request()->segment(2)),
            'title'           => 'Documentos',
            'attached'        => $attached,
            'inputs' => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Estado', 'type' => 'select', 'name' => 'is_active', 'options' => [['id' => 1, 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']], 'option' => 'name'],
                ['label' => 'Documento', 'type' => 'file', 'name' => 'src'],
                ['title' => 'Categorias', 'label' => 'name', 'type' => 'checkbox', 'array' => $this->documentCategoryInterface->findDocumentCategories(), 'name' => 'categories[]']
            ],
            'paginate'        => $getPaginate['paginate'],
            'position'        => $getPaginate['position'],
            'page'            => $getPaginate['page'],
            'limit'           => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('documents.create', [
            'categories' => $this->documentCategoryInterface->findDocumentCategories()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');

        if ($request->hasFile('src') && $request->file('src') instanceof UploadedFile) {
            $data['src'] = $this->documentInterface->saveDocumentFile($request->file('src'));
        }

        $data['slug'] = str_slug($request->input('name'));
        $finance      = $this->documentInterface->createDocument(['data' => $data, 'categories' => $request->input('categories')]);

        return redirect()->route('documents.index')->with('message', 'Creación Exitosa');
    }

    public function show($id)
    {
        $data = $this->documentInterface->findDocumentById($id);
        $attached = [];

        $attached[$data->id] = $data->categoryLog->pluck('document  _category_id')->all();

        return view('documents.show', [
            'breadcrumb' => [
                ['route' => 'documents.index', 'status' => '', 'name' => 'Indicadores'],
                ['route' => '', 'status' => 'active', 'name' => $data->name]
            ],
            'inputs' => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Estado', 'type' => 'select', 'name' => 'is_active', 'options' => [['id' => 1, 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']], 'option' => 'name'],
                ['title' => 'Categorias', 'label' => 'name', 'type' => 'checkbox', 'array' => $this->documentCategoryInterface->findDocumentCategoriesForCompany(auth()->guard('employee')->user()->company_id), 'name' => 'categories[]']
            ],
            'attached'   => $attached,
            'document'   => $data
        ]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');

        dd($request->hasFile('src') instanceof UploadedFile);

        if ($request->hasFile('src') && $request->file('src') instanceof UploadedFile) {
            $data['src'] = $this->documentInterface->saveDocumentFile($request->file('src'));
        }

        $data['slug'] = str_slug($request->input('name'));
        $finance      = $this->documentInterface->updateDocument(['data' => $data, 'categories' => $request->input('categories'), 'id' => $id]);

        return redirect()->route('documents.index')->with('message', 'Actualización  Exitosa');
    }

    public function destroy($id)
    {
        $document = $this->documentInterface->findDocumentById($id);
        $document->delete();

        return redirect()->route('documents.index')->with('message', 'Se ha eliminado correctamente');
    }
}
