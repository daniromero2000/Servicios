<?php

namespace App\Http\Controllers\Assessor;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Assessor;
use Illuminate\Support\Facades\DB;



class LoginController extends Controller
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

 

    protected $guard = 'assessor';

 

    /**

     * Where to redirect users after login.

     *

     * @var string

     */

    protected $redirectTo = '/home';

 

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }



    public function showLoginForm()

    {

        return view('assessors.login');

    }

 

    public function login(Request $request)

    {
        $assessor = DB::connection('oportudata')->table('ASESORES')->where('CODIGO','=',$request->codigo)->where('NUM_DOC','=',$request->num_doc)->first();

        //return $request;
        //$assessor=Assessor::where('name',$request->name)->where('password',$request->password)->first(); 

        if ($assessor) {
            Auth::loginUsingId($assessor->CODIGO);
            //Auth::login($assessor);
            

            return view('assessors.dashboard');
        }


        //return response()->json([auth()->guard('assessor')->attempt(['email' => $request->email, 'password' => $request->password])]);

            

        return back()->withErrors(['email' => 'Email or password are wrong.']);

    }

    public function logout(Request $request) {
        Auth::logout();
        return view('assessors.login');
    }

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

}
