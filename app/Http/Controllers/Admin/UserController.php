<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Profiles;
use App\ProfilesAssessor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

    public function index(Request $request)
    {
        $query = "SELECT `profiles`.`id` AS profileID, `profiles`.`name` AS profileName, users.`id`, users.`name`, users.`email`, users.`idProfile`, users.`created_at`, users.`created_at`, users.`codeOportudata` FROM users LEFT JOIN profiles ON `profiles`.`id`=`users`.`idProfile` WHERE 1";

        if ($request->get('q')) {
            $query .= sprintf(" AND (users.`name` LIKE '%s' OR users.`email` LIKE '%s') ", '%' . $request->get('q') . '%', '%' . $request->get('q') . '%');
        }

        $query .= " ORDER BY users.`id` DESC ";
        $query .= sprintf(" LIMIT %s, 30", $request->get('limitFrom'));

        return response()->json([
            'users'    => DB::select($query),
            'profiles' => Profiles::selectRaw('id AS profileID, name AS profileName')->get(),
            'assesors' => DB::connection('oportudata')->table('ASESORES')->get()
        ]);
    }


    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->get('name');
        $user->codeOportudata = $request->get('codeOportudata');
        $user->email = $request->get('email');
        $user->password = $request->get('password');
        $user->password = Hash::make($user->password);
        $user->idProfile = (int) $request->get('idProfile');
        $user->save();

        return response()->json([true]);
    }

    public function addAssessorProfile(Request $request)
    {
        $assessor = new ProfilesAssessor;
        $oportudataAssessor = DB::connection('oportudata')->table('ASESORES')->where('CODIGO', '=', $request->get('code'))->first();

        if ($oportudataAssessor != NULL) {
            $AssessorProfile = ProfilesAssessor::select('code')->where('code', '=', $request->get('code'))->first();

            if (!$AssessorProfile != NULL) {
                $assessor->code = $request->get('code');
                $assessor->profile = $request->get('profile');
                $assessor->save();
                return response()->json([true]);
            }
            return response()->json([false]);
        }
        return response()->json([-1]);
    }

    public function getAllAssessor()
    {
        return response()->json([DB::connection('oportudata')->table('ASESORES')->get()]);
    }

    public function show($id)
    {
        return  view('users.show', [
            'user' =>  User::find($id)
        ]);
    }

    public function edit($id)
    {
        return view('users.edit', [
            'user' => User::find($id),
            'id'   => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->codeOportudata = $request->get('codeOportudata');
        if ($request->get('idProfile') == "admin") {
            $user->idProfile = 1;
        } elseif ($request->get('idProfile') == "digital") {
            $user->idProfile = 2;
        } else {
            $user->idProfile = 3;
        }
        $user->save();

        return  response()->json([true]);
    }

    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();

        return response()->json([true]);
    }
}
