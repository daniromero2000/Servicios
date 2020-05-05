<?php

namespace App\Http\Controllers\Admin\Brands;

use App\Http\Controllers\Controller;
use App\Entities\Brands\Repositories\BrandRepository;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\Brands\Requests\CreateBrandRequest;
use App\Entities\Brands\Requests\UpdateBrandRequest;
use App\Entities\Tools\UploadableTrait;
use Illuminate\Http\UploadedFile;

class BrandController extends Controller
{
    use UploadableTrait;

    private $brandRepo;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepo = $brandRepository;
    }

    public function index()
    {
        return view('brands.list', [
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all()
        ]);
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(CreateBrandRequest $request)
    {
        $data = $request->except(
            '_token',
            '_method',
        );

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->brandRepo->saveCoverImage($request->file('cover'));
        }

        $this->brandRepo->createBrand($data);

        return redirect()->route('products.index')->with('message', 'Create brand successful!');
    }

    public function edit($id)
    {
        return view(
            'brands.edit',
            [
                'brand' => $this->brandRepo->findBrandById($id)
            ]
        );
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = $this->brandRepo->findBrandById($id);
        $brandRepo = new BrandRepository($brand);

        $data = $request->except(
            '_token',
            '_method',
            'default',
            'image',
        );

        if ($request->hasFile('cover')) {
            $data['cover'] = $brandRepo->saveCoverImage($request->file('cover'));
        }

        $brandRepo->updateBrand($data);

        return redirect()->route('products.index')->with('message', 'Actualización Exitosa!');
    }

    public function destroy($id)
    {
        $brand = $this->brandRepo->findBrandById($id);
        $brandRepo = new BrandRepository($brand);
        $brandRepo->dissociateProducts();
        $brandRepo->deleteBrand();

        return redirect()->route('products.index')->with('message', 'Eliminado Satisfactoriamente');
    }
}