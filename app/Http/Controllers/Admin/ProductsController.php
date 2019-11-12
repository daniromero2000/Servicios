<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProductImage;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['linesBrands', 'productsPublic', 'productsDetails']]);
    }

    public function index(Request $request)
    {
        $lines = DB::table('lines')
            ->select('name', 'id')
            ->whereNull("deleted_at")
            ->get();

        $brands = DB::table('brands')
            ->select('name', 'id')
            ->whereNull("deleted_at")
            ->get();

        $cities = DB::table('profiles')
            ->select('name', 'id')
            ->where('city', true)
            ->get();

        $products = DB::table('products')
            ->join('brands', 'idBrand', '=', 'brands.id')
            ->join('profiles', 'id_city', '=', 'profiles.id')
            ->join('lines', 'idLine', '=', 'lines.id')
            ->select('products.name', 'products.id', 'products.reference AS reference', 'specifications', 'price', 'brands.name AS brand', 'brands.id AS brandId', 'lines.name AS line', 'lines.id AS lineId', 'profiles.name AS city')
            ->where(function ($query) use ($request) {
                $query->where('products.name', 'LIKE', '%' . $request->q . '%')
                    ->Orwhere('products.reference', 'LIKE', '%' . $request->q . '%');
            });

        // delete filter
        if ($request->delete == "true") {
            $products->where('products.deleted_at', '<>', null);
        } else {
            $products->whereNull("products.deleted_at");
        }
        //city filter
        if (!is_null($request->city)) {
            $products->where('id_city', $request->city);
        }
        //line filter
        if (!is_null($request->line)) {
            $products->where('idLine', $request->line);
        }
        //brand filter
        if (!is_null($request->brand)) {
            $products->where('idBrand', $request->brand);
        }
        // pagination
        $products->orderBy('products.id', 'desc')
            ->skip($request->page * ($request->actual - 1))
            ->take($request->page);
        //json response
        return response()->json([
            'products' => $products->get(),
            'lines'    => $lines,
            'brands'   => $brands,
            'cities'   => $cities
        ]);
    }

    public function store(Request $request)
    {

        $product = new Product();
        $product->name = $request->get('name');
        $product->idBrand = $request->get('idBrand');
        $product->idLine = $request->get('idLine');
        $product->id_city = $request->get('idCity');

        if ($product->save()) {
            return $product->id;
        } else {
            return false;
        }
    }

    public function edit($id)
    {
        $lines = DB::table('lines')
            ->select('name', 'id')
            ->whereNull("deleted_at")
            ->get();

        $brands = DB::table('brands')
            ->select('name', 'id')
            ->whereNull("deleted_at")
            ->get();

        $cities = DB::table('profiles')
            ->select('name', 'id')
            ->where('city', true)
            ->get();

        $images = DB::table('product_images')
            ->select('id', 'name')
            ->where('idProduct', $id)
            ->orderBy('order')
            ->get();

        return response()->json([
            'product' => Product::Find($id),
            'lines' => $lines,
            'brands' => $brands,
            'cities' => $cities,
            'images' => $images
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::Find($id);
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->specifications = $request->specifications;
        $product->price = $request->price;
        $product->idBrand = $request->idBrand;
        $product->idLine = $request->idLine;
        $product->id_city = $request->id_city;
        $product->save();

        return response()->json(true);
    }

    public function destroy($id)
    {
        Product::findOrfail($id)->delete();

        return response()->json(true);
    }

    public function deleteImage($id)
    {

        $images = ProductImage::findOrfail($id);

        if (PHP_OS == "Linux") {
            unlink(storage_path("app/public/" . $images->name));
        } else {
            unlink(storage_path("app\public\\" . $images->name));
        }

        $images->delete();

        return response()->json(true);
    }

    public function images(Request $request)
    {
        for ($i = 0; $i < (int) $request->nImages; $i++) {
            $images = new ProductImage();
            $images->name =  Explode("/", $request->file('imgs' . $i)->store('public'))[1]; //take only name
            $images->order = ProductImage::where('idProduct', $request->idProduct)->count();
            $images->idProduct = $request->idProduct;
            $images->save();
        }
        return response()->json(true);
    }

    public function imagesUpdate(Request $request)
    {
        $i = 0;
        $images = $request->all();
        foreach ($images as $value) {
            $updateImage = ProductImage::find($value['id']);
            $updateImage->order = $i++;
            $updateImage->save();
        }

        return response()->json(true);
    }

    public function linesBrands(Request $request)
    {
        $linesBrands = DB::table('products')
            ->join('brands', 'idBrand', '=', 'brands.id')
            ->join('lines', 'idLine', '=', 'lines.id')
            ->select('products.idLine AS idLine', 'lines.name AS lineName', 'products.idBrand AS idBrand', 'brands.name AS brandsName')
            ->whereNull("products.deleted_at")
            ->distinct()
            ->get();

        $linesBrands = $linesBrands->groupBy('lineName');

        $linesBrands = $linesBrands->map(function ($item, $key) {
            return [
                'id'     => $item->first()->idLine,
                'name'   => $item->first()->lineName,
                'brands' => $item->map(function ($item2, $key) {
                    return [
                        'id'   => $item2->idBrand,
                        'name' => $item2->brandsName
                    ];
                })
            ];
        });

        return response()->json($linesBrands);
    }

    public function productsPublic(Request $request)
    {
        $products = DB::table('products')
            ->join('brands', 'idBrand', '=', 'brands.id')
            ->join('profiles', 'id_city', '=', 'profiles.id')
            ->join('lines', 'idLine', '=', 'lines.id')
            ->leftJoin('product_images', function ($q) use ($request) {
                $q->on('product_images.idProduct', 'products.id')
                    ->where('product_images.order', 0);
            })
            ->select('products.name', 'products.id', 'products.reference AS reference', 'specifications', 'price', 'brands.name AS brand', 'brands.id AS brandId', 'lines.name AS line', 'lines.id AS lineId', 'profiles.name AS city', 'product_images.name AS image')
            ->whereNull("products.deleted_at");


        if (!is_null($request->line)) {
            $products->where('idLine', $request->line);
        }

        if (!is_null($request->brand)) {
            $products->where('idBrand', $request->brand);
        }

        $products->orderBy('products.id', 'desc')
            ->skip($request->page * ($request->actual - 1))
            ->take($request->page);


        return response()->json($products->get());
    }

    public function productsDetails(Request $request)
    {
        $product = DB::table('products')
            ->join('brands', 'idBrand', '=', 'brands.id')
            ->join('profiles', 'id_city', '=', 'profiles.id')
            ->join('lines', 'idLine', '=', 'lines.id')
            ->leftJoin('product_images', 'product_images.idProduct', '=', 'products.id')
            ->select('products.name', 'products.id', 'products.reference AS reference', 'specifications', 'price', 'brands.name AS brand', 'brands.id AS brandId', 'lines.name AS line', 'lines.id AS lineId', 'profiles.name AS city', 'product_images.name AS image')
            ->where("products.id", $request->id)
            ->get();

        $product = [
            'id'             => $product->first()->id,
            'name'           => $product->first()->name,
            'brand'          => $product->first()->brand,
            'brandId'        => $product->first()->brandId,
            'city'           => $product->first()->city,
            'line'           => $product->first()->line,
            'lineId'         => $product->first()->lineId,
            'price'          => $product->first()->price,
            'reference'      => $product->first()->reference,
            'specifications' => $product->first()->specifications,
            'images'         => $product->map(function ($item2, $key) {
                return $item2->image;
            })
        ];

        return response()->json($product);
    }
}
