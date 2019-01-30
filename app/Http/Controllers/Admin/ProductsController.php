<?php

/**
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO DE PRODUCTOS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: controlador REST para la administracion de Productos.
    ** todos los metodos se dividen en dos partes consulta a BD y respuesta en json
    **Date: 26/12/2018
     **/

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\ProductImage;
use Files;




class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['linesBrands','productsPublic']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //query list of lines
        $lines = DB::table('lines')
                ->select('name','id')
                ->whereNull("deleted_at")
                ->get();

         //query list of brands
        $brands = DB::table('brands')
                ->select('name','id')
                ->whereNull("deleted_at")
                ->get();
        //query list of cities
             

        $cities = DB::table('profiles')
                ->select('name','id')
                ->where('city',true)
                ->get();
        

          //consulta join products brands lines cities tables 
        
                
        $products = DB::table('products')
                    ->join('brands', 'idBrand', '=', 'brands.id')
                    ->join('profiles', 'id_city', '=', 'profiles.id')
                    ->join('lines', 'idLine', '=', 'lines.id')
                    ->select('products.name','products.id','products.reference AS reference','specifications','price','brands.name AS brand','brands.id AS brandId','lines.name AS line','lines.id AS lineId','profiles.name AS city')
                    ->where(function ($query) use ($request){
                            $query->where('products.name','LIKE','%' . $request->q . '%')
                                  ->Orwhere('products.reference','LIKE','%' . $request->q . '%');
                    });
                    

         // delete filter      
        if($request->delete=="true"){
             $products->where('products.deleted_at', '<>' , null);
        }else{
            $products->whereNull("products.deleted_at");
        }
        //city filter
        if(!is_null($request->city)){
             $products->where('id_city', $request->city);
        }
        //line filter
        if(!is_null($request->line)){
             $products->where('idLine', $request->line);
        }
        //brand filter
        if(!is_null($request->brand)){
             $products->where('idBrand', $request->brand);
        }
        // pagination 
        $products->orderBy('products.id', 'desc')
                 ->skip($request->page*($request->actual-1))
                 ->take($request->page);
        //json response
        return response()->json(['products' => $products->get(),'lines' => $lines,'brands' => $brands, 'cities' =>$cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //query
        $product = new Product();
        //asignation
        $product->name = $request->get('name');
        $product->idBrand = $request->get('idBrand');
        $product->idLine = $request->get('idLine');
        $product->id_city = $request->get('idCity');

        //response
        if($product->save()){
            return $product->id;
        }else{
            return false;
        }
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //query list of lines
        $lines = DB::table('lines')
                ->select('name','id')
                ->whereNull("deleted_at")
                ->get();

         //query list of brands
        $brands = DB::table('brands')
                ->select('name','id')
                ->whereNull("deleted_at")
                ->get();
        //query list of cities
             
       $cities = DB::table('profiles')
                ->select('name','id')
                ->where('city',true)
                ->get();

         //images list query
        $images = DB::table('product_images')
                ->select('id','name')
                ->where('idProduct',$id)
                ->orderBy('order')
                ->get();
        // recover product to edit
        $product = Product::Find($id);

        return response()->json(['product' => $product, 'lines' => $lines, 'brands' => $brands, 'cities' => $cities, 'images' => $images]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        //query
        $product = Product::Find($id);
        //update
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->specifications = $request->specifications;
        $product->price = $request->price;
        $product->idBrand = $request->idBrand;
        $product->idLine = $request->idLine;
        $product->id_city = $request->id_city;

        $product->save();
        //response
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //query
        $product = Product::findOrfail($id)->delete();
        //response
        return response()->json(true);
    }

    /**
     * Remove the specified images from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function deleteImage($id)
    {
        //query
        $images = ProductImage::findOrfail($id);
        //detect os
        if(PHP_OS == "Linux"){
            //delete whit path
            unlink(storage_path("app/public/".$images->name));
        }else{
            unlink(storage_path("app\public\\".$images->name));
        }
        
        $images->delete();
        return response()->json(true);
    }

    /**
     * store a grup of images in server and store de name in DB
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response whit a set of images
     */

    public function images(Request $request)
    {
      
        for ($i=0; $i < (int)$request->nImages ; $i++) { 

            //query
            $images = new ProductImage();
            // to save in public/storage  execute php artisan storage:link
            $images->name =  Explode("/",$request->file('imgs'.$i)->store('public'))[1];//take only name
            //put a new image in the last position
            $count = ProductImage::where('idProduct', $request->idProduct)->count();
            $images->order = $count;

            $images->idProduct = $request->idProduct;
            $images->save();

        }
        return response()->json(true);
    }

      /**
     * store a grup of images in server and store de name in DB
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response with a set of images
     */ 

    public function imagesUpdate(Request $request)
    {
        $i=0;//images order 
        $images = $request->all();
        foreach ($images as $value) {
            //query
            $updateImage = ProductImage::find($value['id']);
            //update
            $updateImage->order = $i++;
            $updateImage->save();
        }
        //response
        return response()->json(true);
        
    }

       /**
     * 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response  list of lines with their sespective brands [[idLine,nameLine,[[idBrand,nameBrand]......[others brand]]].......[others line]]
     */ 

    public function linesBrands(Request $request)
    {
        //All the combinations of lines and brands of the products there are products.
        $linesBrands = DB::table('products')
                    ->join('brands', 'idBrand', '=', 'brands.id')
                    ->join('lines', 'idLine', '=', 'lines.id')
                    ->select('products.idLine AS idLine','lines.name AS lineName','products.idBrand AS idBrand','brands.name AS brandsName')
                    ->whereNull("products.deleted_at")
                    //->whereNull("lines.deleted_at")//uncomment if a client can saw a product with deleted line
                    ->distinct()
                    ->get();
        

        $linesBrands = $linesBrands->groupBy('lineName');
        //agrup a brands with our sespectiv line
        $linesBrands = $linesBrands->map(function ($item, $key){
            return [ 'id' => $item->first()->idLine, 'name' => $item->first()->lineName, 'brands' => $item->map(function ($item2, $key){
                                                                        return [ 'id' => $item2->idBrand, 'name' => $item2->brandsName];
                                                                    })];
        });

        return response()->json($linesBrands);
    }

    public function productsPublic(Request $request)
    {
        //consulta join products brands lines cities tables       
        $products = DB::table('products')
                    ->join('brands', 'idBrand', '=', 'brands.id')
                    ->join('profiles', 'id_city', '=', 'profiles.id')
                    ->join('lines', 'idLine', '=', 'lines.id')
                    ->leftJoin('product_images',function($q) use ($request){
                        $q->on('product_images.idProduct', 'products.id')
                            ->where('product_images.order',0);
                    })
                    ->select('products.name','products.id','products.reference AS reference','specifications','price','brands.name AS brand','brands.id AS brandId','lines.name AS line','lines.id AS lineId','profiles.name AS city','product_images.name AS image')
                    ->whereNull("products.deleted_at");

        //line filter
        if(!is_null($request->line)){
             $products->where('idLine', $request->line);
        }
        //brand filter
        if(!is_null($request->brand)){
             $products->where('idBrand', $request->brand);
        }
        // pagination  
        $products->orderBy('products.id', 'desc')
                 ->skip($request->page*($request->actual-1))
                 ->take($request->page);
         //json response
        return response()->json($products->get());
       
    }
}
