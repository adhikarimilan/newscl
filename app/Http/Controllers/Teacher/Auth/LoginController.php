<?php

namespace App\Http\Controllers\Teacher\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/teacher';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:teacher')->except('logout');
    }
    public function showLoginForm()
    {
        return view('back.teacher.auth.login');
    }
    public function login(Request $request){
        
        //dd(Hash::make($request->password));
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $data=$request->only('email','password');
        $auth=auth()->guard('teacher')->attempt($data,$request->remember);
        if($auth){
            if(auth()->guard('teacher')->user()->active)
            return redirect()->intended(url('teacher/dashboard'));
            else
           { 
            auth()->guard('teacher')->logout();  
            return redirect()->back()->withError('Account not activated, please contact admin');
            }
        }else{
            //dd($auth);
            return redirect()->back()->withInput($request->only('email'))->withError('credentials do not match');
        }
    }
    public function logout(Request $request){
        auth()->guard('teacher')->logout();
        $request->session()->invalidate();
        return redirect(url('teacher/login'));

    }
}
