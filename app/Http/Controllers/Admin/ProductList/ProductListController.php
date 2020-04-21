<?php

namespace App\Http\Controllers\Admin\ProductList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductListController extends Controller
{

    public function __construct()
    {
    }
    public function index(Request $request)
    {
        return redirect('Hola');
    }

    public function store(Request $request)
    {
        return redirect('Guardado');
    }
}