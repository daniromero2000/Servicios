<?php

namespace App\Http\Controllers\Admin\AppErrors;

use App\Entities\AppErrors\Repositories\Interfaces\AppErrorRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Tools\Repositories\Interfaces\ToolRepositoryInterface;

class AppErrorController extends Controller
{
    private $appErrorInterface, $toolsInterface;

    public function __construct(
        AppErrorRepositoryInterface $appErrorRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->appErrorInterface = $appErrorRepositoryInterface;
        $this->toolsInterface = $toolRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skip = $this->toolsInterface->getSkip($request->input('skip'));
        $errors = $this->appErrorInterface->listAppErrors($skip * 30);
        return view('appError.list', compact('errors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'status' => $request['status'],
            'data' => $request['data']
        ];
        return $this->appErrorInterface->createAppError($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}