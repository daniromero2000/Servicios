<?php

namespace App\Http\Controllers\Admin\OportudataLogs;

use App\Entities\OportudataLogs\OportudataLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OportudataLogController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');

        $data += [
            'fecha' => date('Y-m-d H:i:s'),
            'usuario' => auth()->user()->codeOportudata,
            'state' => 'A'
        ];

        dd($data);

        OportudataLog::create($data);
    }
}
