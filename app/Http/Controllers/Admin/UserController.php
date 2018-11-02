<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UserController extends Controller
{


    
    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::selectRaw("*")->paginate(15);
        return view('users.index',['users'=>$users]);   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         request()->validate([
            'name'=>'required',
            'email'=>'required',
            'idProfile'=>'required',
            'password'=>'required|confirmed'
        ]);

        $user= new User;

        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=$request->get('password');
        $user->password=Hash::make($user->password);
        
        if ($request->get('idProfile') == "admin") {
                $user->idProfile=1;
        }elseif($request->get('idProfile') == "digital"){
                $user->idProfile=2;
        }else{
                $user->idProfile=3;            
        }    
        
        $user->save();

        return redirect()->route('users.index')->with('success','user add successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::find($id);

        return  view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
       
       return view('users.edit',compact('user','id'));
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
        $user= User::findOrfail($id);
        $user->name= $request->name;
        $user->email= $request->email;
        if ($request->get('idProfile') == "admin") {
                $user->idProfile=1;
        }elseif($request->get('idProfile') == "digital"){
                $user->idProfile=2;
        }else{
                $user->idProfile=3;            
        }     
        $user->save();

        return  view('users.show',compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrfail($id);
            $user->delete();

            return redirect()->route('users.index');
    }
}
