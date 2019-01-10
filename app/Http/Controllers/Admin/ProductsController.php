<?php

/**
    **Proyecto: SERVICIOS FINANCIEROS
    **Caso de Uso: MODULO CATALOGO DE PRODUCTOS
    **Autor: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Descripción: controlador REST para la administracion de Productos.
    ** todos los metodos se dividen en dos partes consulta a BD y respuesta en json
    **Fecha: 26/12/2018
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
        $this->middleware('auth');
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
             

        $cities = DB::table('ciudades')
                ->select('name','id','departament')
                ->orderBy('departament')
                ->get();
        

          //consulta join products brands lines cities tables 
        
                
        $products = DB::table('products')
                    ->join('brands', 'idBrand', '=', 'brands.id')
                    ->join('ciudades', 'idCity', '=', 'ciudades.id')
                    ->join('lines', 'idLine', '=', 'lines.id')
                    ->select('products.name','products.id','products.reference AS reference','specifications','price','brands.name AS brand','brands.id AS brandId','lines.name AS line','lines.id AS lineId','ciudades.name AS city','ciudades.id AS cityId')
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
             $products->where('idCity', $request->city);
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
        //respuesta en json
        return response()->json([$products->get(),$lines,$brands,$cities]);
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
        //consulta
        $product = new Product();

        $product->name = $request->get('name');
        $product->idBrand = $request->get('idBrand');
        $product->idLine = $request->get('idLine');
        $product->idCity = $request->get('idCity');

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
             

        $cities = DB::table('ciudades')
                ->select('name','id','departament')
                ->orderBy('departament')
                ->get();

         //images list query
        $images = DB::table('product_images')
                ->select('id','name')
                ->where('idProduct',$id)
                ->get();

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
        //consulta
        $product = Product::Find($id);
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->specifications = $request->specifications;
        $product->price = $request->price;
        $product->idBrand = $request->idBrand;
        $product->idLine = $request->idLine;
        $product->idCity = $request->idCity;

        $product->save();
        //resoupuesta
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
        $product = Product::findOrfail($id)->delete();

        return response()->json(true);
    }

     public function deleteImage($id)
    {
        $images = ProductImage::findOrfail($id);
        if(PHP_OS == "Linux"){
            unlink(storage_path("app/public/".$images->name));
        }else{
            unlink(storage_path("app\public\\".$images->name));
        }
        
        $images->delete();
        return response()->json(true);
    }

    public function images(Request $request)
    {
      
        for ($i=0; $i < (int)$request->nImages ; $i++) { 

            //query
            $images = new ProductImage();

            $images->name =  Explode("/",$request->file('imgs'.$i)->store('public'))[1];//take only name
            $images->idProduct = $request->idProduct;
            $images->save();

        }
        return response()->json(true);
    }

}
