<?php

namespace  App\Http\Controllers\Admin\DocumentCategories;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;
use App\Entities\DocumentCategories\Repositories\Interfaces\DocumentCategoryRepositoryInterface;

class DocumentCategoryController extends Controller
{
    private $documentCategoryInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        DocumentCategoryRepositoryInterface $documentCategoryRepositoryInterface
    ) {
        $this->toolsInterface                  = $toolRepositoryInterface;
        $this->documentCategoryInterface       = $documentCategoryRepositoryInterface;
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->documentCategoryInterface->searchDocumentCategory(request()->input('q'), $skip * 30);
            $paginate = $this->documentCategoryInterface->countDocumentCategories(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->documentCategoryInterface->searchDocumentCategory(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->documentCategoryInterface->countDocumentCategories(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->documentCategoryInterface->countDocumentCategories('');
            $list = $this->documentCategoryInterface->listDocumentCategories($skip * 30);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);
        return view('documentsCategory.index', [
            'documentCategory' => $list,
            'skip'              => $skip,
            'headers'           => ['#', 'Nombre', 'Fecha', 'Estado', 'Opciones'],
            'routeEdit'         => 'document-categories.update',
            'optionsRoutes'     => '' . (request()->segment(2)),
            'title'             => 'Documentos',
            'inputs' => [
                ['label' => 'Nombre', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Estado', 'type' => 'select', 'name' => 'is_active', 'options' => [['id' => 1, 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']], 'option' => 'name']
            ],
            'paginate'        => $getPaginate['paginate'],
            'position'        => $getPaginate['position'],
            'page'            => $getPaginate['page'],
            'limit'           => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('documentsCategory.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');
        $data['company_id'] = 1;
        $this->documentCategoryInterface->createDocumentCategory($data);

        return redirect()->route('document-categories.index')->with('message', 'Creación Exitosa');
    }

    public function show($id)
    {
        return view('documentsCategory.show', [
            'documentCategory' => $this->documentCategoryInterface->findDocumentCategoryById($id)
        ]);
    }

    public function edit($id)
    {
        return view('documentmanagement::edit');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $data['id'] = $id;
        $this->documentCategoryInterface->updateDocumentCategory($data);

        return redirect()->route('document-categories.index')->with('message', 'Actualización Exitosa');
    }

    public function destroy($id)
    {
        $this->documentCategoryInterface->deleteDocumentCategory($id);

        return redirect()->route('document-categories.index')->with('message', 'Eliminado Exitosamente');
    }
}
