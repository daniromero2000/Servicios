<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Brand;


class BrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->delete == "true") {
            $brands = DB::table('brands')
                ->select('name', 'id')
                ->where('name', 'LIKE', '%' . $request->q . '%')
                ->where('deleted_at', '<>', null)
                ->orderBy('id', 'desc')
                ->skip($request->page * ($request->actual - 1))
                ->take($request->page)
                ->get();
        } else {
            $brands = DB::table('brands')
                ->select('name', 'id')
                ->where('name', 'LIKE', '%' . $request->q . '%')
                ->whereNull("deleted_at")
                ->orderBy('id', 'desc')
                ->skip($request->page * ($request->actual - 1))
                ->take($request->page)
                ->get();
        }

        return response()->json($brands);
    }

    public function store(Request $request)
    {
        try {
            $brands          = new Brand;
            $brands->name    = $request->name;
            $brands->id_user = Auth::id();
            $brands->save();
            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $brands       = Brand::find($id);
            $brands->name = $request->name;
            $brands->save();

            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json("indeterminate error");
            }
        }
    }

    public function destroy($id)
    {
        $brands = Brand::findOrFail($id);
        $brands->delete();

        return response()->json([true]);
    }
}
