<?php

namespace App\Http\Controllers\NewAdmin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function index()
    {
        return view('newAdmin.home');
    }

}
