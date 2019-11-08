<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Line;

class LinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->delete == "true") {
            $lines = DB::table('lines')
                ->select('name', 'id')
                ->where('name', 'LIKE', '%' . $request->q . '%')
                ->where('deleted_at', '<>', null)
                ->orderBy('id', 'desc')
                ->skip($request->page * ($request->actual - 1))
                ->take($request->page)
                ->get();
        } else {
            $lines = DB::table('lines')
                ->select('name', 'id')
                ->where('name', 'LIKE', '%' . $request->q . '%')
                ->whereNull("deleted_at")
                ->orderBy('id', 'desc')
                ->skip($request->page * ($request->actual - 1))
                ->take($request->page)
                ->get();
        }
        return response()->json($lines);
    }

    public function create()
    { }

    public function store(Request $request)
    {
        try {

            $lines = new Line;
            $lines->name = $request->name;
            $lines->save();
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
            $lines = Line::find($id);
            $lines->name = $request->name;
            $lines->save();
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
        $lines = Line::findOrFail($id);
        $lines->delete();

        return response()->json([true]);
    }
}
