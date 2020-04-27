<?php

namespace App\Http\Controllers\Admin\Brands;

use App\Http\Controllers\Controller;
use App\Entities\Brands\Repositories\BrandRepository;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\Brands\Requests\CreateBrandRequest;
use App\Entities\Brands\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * @var BrandRepositoryInterface
     */
    private $brandRepo;

    /**
     * BrandController constructor.
     *
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepo = $brandRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('brands.list', [
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * @param CreateBrandRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateBrandRequest $request)
    {
        $this->brandRepo->createBrand($request->all());

        return redirect()->route('brands.index')->with('message', 'Create brand successful!');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view(
            'brands.edit',
            [
                'brand' => $this->brandRepo->findBrandById($id)
            ]
        );
    }

    /**
     * @param UpdateBrandRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Entities\Brands\Exceptions\UpdateBrandErrorException
     */
    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = $this->brandRepo->findBrandById($id);
        $brandRepo = new BrandRepository($brand);
        $brandRepo->updateBrand($request->all());

        return redirect()->route('brands.edit', $id)->with('message', 'Actualización Exitosa!');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $brand = $this->brandRepo->findBrandById($id);
        $brandRepo = new BrandRepository($brand);
        $brandRepo->dissociateProducts();
        $brandRepo->deleteBrand();

        return redirect()->route('brands.index')->with('message', 'Eliminado Satisfactoriamente');
    }
}
