<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginAdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if ($this->attemptLogin($request)) {
            $userInfo = auth()->user();
            $date = Carbon::now();
            $resp = DB::select("SELECT modu.name, modu.icon, modu.route
            FROM permissions_profile_module as ppm
            LEFT JOIN modules as modu ON ppm.id_module = modu.id
            WHERE ppm.id_profile = :idProfile order by modu.name", ['idProfile' => $userInfo->idProfile]);
            session(['modules' => $resp]);

            // $data = [
            //     'modulo' => 'Panel Asesores',
            //     'proceso' => 'Inicio de Sesion',
            //     'accion' => 'Ingresar',
            //     'identificacion' => $userInfo->codeOportudata,
            //     'fecha' => $date,
            //     'usuario' => $userInfo->email,
            //     'state' => 'A'
            // ];

            // $oportudataLog = OportudataLog::create($data);

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function username()
    {
        return 'email';
    }
}
