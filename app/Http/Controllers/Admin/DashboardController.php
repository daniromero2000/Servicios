<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentUser = \Auth::user();
        return view('dashboard',['currentUser'=>$currentUser]);
    }

    public function getModulesDashboard(){
        $userInfo = \Auth::user();

        $query = DB::select("SELECT modu.name, modu.icon, modu.route
        FROM permissions_profile_module as ppm
        LEFT JOIN modules as modu ON ppm.id_module = modu.id
        WHERE ppm.id_profile = :idProfile", ['idProfile' => $userInfo->idProfile]);

        return $query;
    }
}
