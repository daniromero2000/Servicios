<?php

namespace App\Http\Controllers\Admin\Products;


use App\Entities\ProductStatuses\Repositories\Interfaces\ProductStatusRepositoryInterface;
use App\Entities\ProductStatuses\Repositories\ProductStatusRepository;
use App\Entities\ProductStatuses\Requests\CreateProductStatusRequest;
use App\Entities\ProductStatuses\Requests\UpdateProductStatusRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductStatusController extends Controller
{
    private $productStatuses;


    public function __construct(ProductStatusRepositoryInterface $productStatusRepository)
    {
        $this->productStatuses = $productStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->guard('employee')->user();
        return view('admin.product-statuses.list', [
            'productStatuses' => $this->productStatuses->listProductStatuses(),
            'user' =>  $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductStatusRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductStatusRequest $request)
    {
        $this->productStatuses->createProductStatus($request->except('_token', '_method'));
        $request->session()->flash('message', 'Creación Exitosa');
        return redirect()->route('admin.product-statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('admin.product-statuses.edit', ['productStatus' => $this->productStatuses->findProductStatusById($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductStatusRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductStatusRequest $request, int $id)
    {
        $productStatus = $this->productStatuses->findProducttatusById($id);

        $update = new ProductStatusRepository($productStatus);
        $update->updateProductStatus($request->all());

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.product-statuses.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->productStatuses->findProductStatusById($id)->delete();

        request()->session()->flash('message', 'Eliminado Satisfactoriamente');
        return redirect()->route('admin.product-statuses.index');
    }
}
