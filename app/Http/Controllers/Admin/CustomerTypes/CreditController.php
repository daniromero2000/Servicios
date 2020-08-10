<?php

namespace App\Http\Controllers\Admin\CustomerTypes;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CreditController extends Controller
{
   public function index()
   {
       return view('customertype.index');
   }  
}
