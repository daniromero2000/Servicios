<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Profiles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

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
    public function index(Request $request)
    {
        $query="SELECT users.`id`, users.`name`, users.`email`, users.`idProfile`, users.`created_at`, users.`created_at` FROM users WHERE 1";


        if($request->get('q')){
            $query .= sprintf(" AND (users.`name` LIKE '%s' OR users.`email` LIKE '%s') ", '%'.$request->get('q').'%', '%'.$request->get('q').'%');
        }

        if($request->get('profileUser')){
            $query .= sprintf(" AND users.`idProfile` = '%s' ", $request->get('profileUser'));
        }       

        if($request->get('fecha_ini')){
            $query .= sprintf(" AND users.`created_at` > '%s' ", $request->get('fecha_ini').' 00:00:00');
        }

        if($request->get('fecha_fin')){
            $query .= sprintf(" AND users.`created_at` < '%s' ", $request->get('fecha_fin').' 23:59:59');
        }

        $query .= " ORDER BY users.`id` DESC ";

        $query .= sprintf(" LIMIT %s, 30", $request->get('limitFrom'));

        $resp = DB::select($query);

        return $resp;
 
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
    
        $user= new User;

        $user->name=$request->get('name');
        $user->email=$request->get('email');
        $user->password=$request->get('password');
        $user->password=Hash::make($user->password);

        $idProfile=User::selectRaw('profiles.id, profiles.name,users.idProfile')
            ->leftjoin('profiles','profiles.id','=','users.idProfile')
            ->where('profiles.name','=',$request->get('idProfile'))
            ->orderBy('profiles.id')->first();

        $user->idProfile=$idProfile->id;

        
        $user->save();

        return response()->json([true]);

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

        return  response()->json([true]);
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

            return response()->json([true]);
    }
}
