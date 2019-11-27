<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard', [
            'currentUser' => \Auth::user()
        ]);
    }

    public function getModulesDashboard()
    {
        $userInfo = auth()->user();
        $query = DB::select("SELECT modu.name, modu.icon, modu.route
        FROM permissions_profile_module as ppm
        LEFT JOIN modules as modu ON ppm.id_module = modu.id
        WHERE ppm.id_profile = :idProfile", ['idProfile' => $userInfo->idProfile]);

        return $query;
    }

}
