<?php

namespace App\Http\Controllers\Admin\Products;

use App\Entities\Attributes\Repositories\AttributeRepositoryInterface;
use App\Entities\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use App\Entities\Brands\Repositories\BrandRepositoryInterface;
use App\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use App\Entities\ProductAttributes\ProductAttribute;
use App\Entities\Products\Exceptions\ProductInvalidArgumentException;
use App\Entities\Products\Exceptions\ProductNotFoundException;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Entities\ProductStatuses\ProductStatus;
use App\Entities\ProductStatuses\Repositories\Interfaces\ProductStatusRepositoryInterface;
use App\Entities\ProductStatuses\Repositories\ProductStatusRepository;

class ProductController extends Controller
{
    use ProductTransformable, UploadableTrait;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * @var ProductStatusRepositoryInterface
     */
    private $productStatusRepo;

    /**
     * @var SubsidiaryRepositoryInterface
     */
    private $subsidiaryRepo;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepo;

    /**
     * @var AttributeValueRepositoryInterface
     */
    private $attributeValueRepository;

    /**
     * @var ProductAttribute
     */
    private $productAttribute;

    /**
     * @var BrandRepositoryInterface
     */
    private $brandRepo;

    /**
     * ProductController constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param SubsidiaryRepositoryInterface $subsidiaryRepository
     * @param AttributeRepositoryInterface $attributeRepository
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @param ProductAttribute $productAttribute
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(
        ProductStatusRepositoryInterface $productStatusRepository,
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        SubsidiaryRepositoryInterface $subsidiaryRepository,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        ProductAttribute $productAttribute,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->productRepo = $productRepository;
        $this->categoryRepo = $categoryRepository;
        $this->subsidiaryRepo = $subsidiaryRepository;
        $this->attributeRepo = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->productAttribute = $productAttribute;
        $this->brandRepo = $brandRepository;
        $this->productStatusRepo = $productStatusRepository;

        $this->middleware(['permission:create-product, guard:employee'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:update-product, guard:employee'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-product, guard:employee'], ['only' => ['destroy']]);
        $this->middleware(['permission:view-product, guard:employee'], ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = $this->productRepo->listProducts('id');

        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'));
        }

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();

        return view('admin.products.list', [
            'products' => $this->productRepo->paginateArrayResults($products, 25),
            'user' => auth()->guard('employee')->user()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'statuses' => $this->productStatusRepo->listProductStatuses(),
            'categories' => $this->categoryRepo->listCategories('name', 'asc')->where('parent_id', 1),
            'subsidiaries' =>  $this->subsidiaryRepo->listSubsidiaries('name', 'asc'),
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'default_weight' => env('SHOP_WEIGHT'),
            'weight_units' => Product::MASS_UNIT,
            'product' => new Product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->except('_token', '_method');
        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->productRepo->saveCoverImage($request->file('cover'));
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

        if ($request->has('categories')) {
            $productRepo->syncCategories($request->input('categories'));
        } else {
            $productRepo->detachCategories();
        }

        if ($request->has('subsidiaries')) {
            $productRepo->syncSubsidiaries($request->input('subsidiaries'));
        } else {
            $productRepo->detachSubsidiaries();
        }

        return redirect()->route('admin.products.edit', $product->id)->with('message', 'Creación Exitosa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $subsidiary2 = DB::table('product_subsidiary')->where('product_id', $id)->value('subsidiary_id');
        $product = $this->productRepo->findProductById($id);
        return view('admin.products.show', [
            'subsidiaries' =>  $this->subsidiaryRepo->listSubsidiaries('name', 'asc'),
            'selectedIds' => $product->subsidiaries()->pluck('subsidiary_id')->all(),
            'user' => auth()->guard('employee')->user(),
            'subsidiary' =>  $this->subsidiaryRepo->findSubsidiaryById($subsidiary2)
        ], compact('product', 'subsidiary2'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productAttributes = $product->attributes()->get();

        $qty = $productAttributes->map(function ($item) {
            return $item->quantity;
        })->sum();

        if (request()->has('delete') && request()->has('pa')) {
            $pa = $productAttributes->where('id', request()->input('pa'))->first();
            $pa->attributesValues()->detach();
            $pa->delete();

            request()->session()->flash('message', 'Eliminado Satisfactoriamente');
            return redirect()->route('admin.products.edit', [$product->id, 'combination' => 1]);
        }

        $categories = $this->categoryRepo->listCategories('name', 'asc')
            ->where('parent_id', 1);

        $subsidiaries = $this->subsidiaryRepo->listSubsidiaries('name', 'asc');

        return view('admin.products.edit', [
            'product' => $product,
            'statuses' => $this->productStatusRepo->listProductStatuses(),
            'statusId' => $product->product_status_id->id,
            'images' => $product->images()->get(['src']),
            'categories' => $categories,
            'selectedIdsC' => $product->categories()->pluck('category_id')->all(),
            'subsidiaries' => $subsidiaries,
            'selectedIds' => $product->subsidiaries()->pluck('subsidiary_id')->all(),
            'attributes' => $this->attributeRepo->listAttributes(),
            'productAttributes' => $productAttributes,
            'qty' => $qty,
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \App\Entities\Products\Exceptions\ProductUpdateErrorException
     */
    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productRepo = new ProductRepository($product);

        if ($request->has('attributeValue')) {
            $this->saveProductCombinations($request, $product);
            return redirect()->route('admin.products.edit', [$id, 'combination' => 1])
                ->with('message', 'Combinación de atributo creada exitosamente');
        }

        $data = $request->except(
            'categories',
            'subsidiaries',
            '_token',
            '_method',
            'default',
            'image',
            'productAttributeQuantity',
            'productAttributePrice',
            'attributeValue',
            'combination'
        );

        if ($data['product_status_id'] == 1) {
            $data['quantity'] = 0;
        }

        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover')) {
            $data['cover'] = $productRepo->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        if ($request->has('categories')) {
            $productRepo->syncCategories($request->input('categories'));
        } else {
            $productRepo->detachCategories();
        }

        if ($request->has('subsidiaries')) {
            $productRepo->syncSubsidiaries($request->input('subsidiaries'));
        } else {
            $productRepo->detachSubsidiaries();
        }

        $productRepo->updateProduct($data);

        return redirect()->route('admin.products.edit', $id)
            ->with('message', 'Actualización Exitosa!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = $this->productRepo->findProductById($id);
        $product->categories()->sync([]);
        $product->subsidiaries()->sync([]);
        $productAttr = $product->attributes();

        $productAttr->each(function ($pa) {
            DB::table('attribute_value_product_attribute')->where('product_attribute_id', $pa->id)->delete();
        });

        $productAttr->where('product_id', $product->id)->delete();

        $productRepo = new ProductRepository($product);
        $productRepo->removeProduct();

        return redirect()->route('admin.products.index')->with('message', 'Eliminado Satisfactoriamente');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeImage(Request $request)
    {
        $this->productRepo->deleteFile($request->only('product', 'image'), 'uploads');
        return redirect()->back()->with('message', 'Imagen Eliminada Satisfactoriamente');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeThumbnail(Request $request)
    {
        $this->productRepo->deleteThumb($request->input('src'));
        return redirect()->back()->with('message', 'Imagen Eliminada Satisfactoriamente');
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return boolean
     */
    private function saveProductCombinations(Request $request, Product $product): bool
    {
        $fields = $request->only(
            'attributeValue',
            'productAttributeQuantity',
            'productAttributePrice',
            'sale_price',
            'default'
        );

        if ($errors = $this->validateFields($fields)) {
            return redirect()->route('admin.products.edit', [$product->id, 'combination' => 1])
                ->withErrors($errors);
        }

        $quantity = $fields['productAttributeQuantity'];
        $attributeValue = (int) $fields['attributeValue'][0];

        $productAttributeValue = ((float) DB::table('attribute_values')->where('id', $attributeValue)->value('value') / 100);


        $sale_price = ($product->price) - ($product->price * $productAttributeValue);
        $price = $productAttributeValue * 100;


        $attributeValues = $request->input('attributeValue');
        $productRepo = new ProductRepository($product);

        $hasDefault = $productRepo->listProductAttributes()->where('default', 1)->count();

        $default = 0;
        if ($request->has('default')) {
            $default = $fields['default'];
        }

        if ($default == 1 && $hasDefault > 0) {
            $default = 0;
        }
        $productAttribute = $productRepo->saveProductAttributes(
            new ProductAttribute(compact('quantity', 'price', 'sale_price', 'default'))
        );

        // save the combinations
        return collect($attributeValues)->each(function ($attributeValueId) use ($productRepo, $productAttribute) {
            $attribute = $this->attributeValueRepository->find($attributeValueId);
            return $productRepo->saveCombination($productAttribute, $attribute);
        })->count();
    }

    /**
     * @param array $data
     *
     * @return
     */
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
