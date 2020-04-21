<?php

namespace App\Http\Controllers\Admin\Factors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FactorsController extends Controller
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