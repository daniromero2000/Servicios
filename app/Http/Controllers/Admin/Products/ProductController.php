<?php

namespace App\Http\Controllers\Admin\Products;

use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\Products\Product;
use App\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Entities\Products\Repositories\ProductRepository;
use App\Entities\Products\Requests\CreateProductRequest;
use App\Entities\Products\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Entities\Products\Transformations\ProductTransformable;
use App\Entities\Tools\UploadableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ProductTransformable, UploadableTrait;

    private $productRepo, $brandRepo;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->productRepo = $productRepository;
        $this->brandRepo = $brandRepository;
    }

    public function index()
    {
        $list = $this->productRepo->listProducts('id');

        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'));
        }

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();
        return view('products.list', [
            'products' => $products,
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc')->all(),
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc')
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'product' => new Product
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->except('_token', '_method');
        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->productRepo->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('description_image1') && $request->file('description_image1') instanceof UploadedFile) {
            $data['description_image1'] = $this->productRepo->saveCoverImage($request->file('description_image1'));
        }

        if ($request->hasFile('description_image2') && $request->file('description_image2') instanceof UploadedFile) {
            $data['description_image2'] = $this->productRepo->saveCoverImage($request->file('description_image2'));
        }

        if ($request->hasFile('description_image3') && $request->file('description_image3') instanceof UploadedFile) {
            $data['description_image3'] = $this->productRepo->saveCoverImage($request->file('description_image3'));
        }

        if ($request->hasFile('description_image4') && $request->file('description_image4') instanceof UploadedFile) {
            $data['description_image4'] = $this->productRepo->saveCoverImage($request->file('description_image4'));
        }

        if ($request->hasFile('specification_image') && $request->file('specification_image') instanceof UploadedFile) {
            $data['specification_image'] = $this->productRepo->saveCoverImage($request->file('specification_image'));
        }

        $product = $this->productRepo->createProduct($data);
        $productRepo = new ProductRepository($product);

        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        $productRepo = new ProductRepository($product);
        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        return redirect()->route('products.index')->with('message', 'Creación Exitosa');
    }

    public function show(int $id)
    {
        $product = $this->productRepo->findProductById($id);
        return view('products.show', [], compact('product'));
    }

    public function edit(int $id)
    {
        $product = $this->productRepo->findProductById($id);

        return view('products.edit', [
            'product' => $product,
            'images' => $product->images()->get(['src']),
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
        ]);
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productRepo = new ProductRepository($product);

        $data = $request->except(
            '_token',
            '_method',
            'default',
            'image'
        );

        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover')) {
            $data['cover'] = $productRepo->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        $productRepo->updateProduct($data);

        return redirect()->route('products.index')->with('message', 'Actualización Exitosa!');
    }

    public function destroy($id)
    {
        $product = $this->productRepo->findProductById($id);
        $productRepo = new ProductRepository($product);
        $productRepo->removeProduct();

        return redirect()->route('products.index')->with('message', 'Eliminado Satisfactoriamente');
    }

    public function removeImage(Request $request)
    {
        $this->productRepo->deleteFile($request->only('product', 'image'), 'uploads');
        return redirect()->back()->with('message', 'Imagen Eliminada Satisfactoriamente');
    }

    public function removeThumbnail(Request $request)
    {
        $this->productRepo->deleteThumb($request->input('src'));
        return redirect()->back()->with('message', 'Imagen Eliminada Satisfactoriamente');
    }

    private function validateFields(array $data)
    {
        $validator = Validator::make($data, [
            'productAttributeQuantity' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator;
        }
    }
}