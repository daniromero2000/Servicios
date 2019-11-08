<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class Assessors extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('assessors.dashboard');
    }
}
