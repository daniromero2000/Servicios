<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Profiles;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->delete == "true") {
            $profiles = DB::table('profiles')
                ->select('name', 'id', 'city')
                ->where('name', 'LIKE', '%' . $request->q . '%')
                ->where('deleted_at', '<>', null)
                ->orderBy('id', 'desc')
                ->skip($request->page * ($request->actual - 1))
                ->take($request->page)
                ->get();
        } else {
            $profiles = DB::table('profiles')
                ->select('name', 'id', 'city')
                ->where('name', 'LIKE', '%' . $request->q . '%')
                ->whereNull("deleted_at")
                ->orderBy('id', 'desc')
                ->skip($request->page * ($request->actual - 1))
                ->take($request->page)
                ->get();
        }

        return response()->json($profiles);
    }


    public function create()
    { }


    public function store(Request $request)
    {
        try {
            $profiles = new Profiles;
            $profiles->name = $request->name;
            $profiles->city = $request->city;
            $profiles->save();

            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function show($id)
    { }

    public function edit($id)
    { }

    public function update(Request $request, $id)
    {
        try {
            $profiles = Profiles::find($id);
            $profiles->name = $request->name;
            $profiles->city = $request->city;
            $profiles->save();
            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function destroy($id)
    {
        $lines = profiles::findOrFail($id);
        $lines->delete();

        return response()->json([true]);
    }
}
