<?php

namespace App\Http\Controllers\Admin\Auth;
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm()
    {
        //dd(Hash::make('#6eMhwB['));
        return view('back.admin.auth.login');
    }
    public function login(Request $request){
        
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $data=$request->only('email','password');
        $auth=auth()->guard('admin')->attempt($data,$request->remember);
        if($auth){
            //dd(Auth::guard('admin')->user()->name);
            return redirect()->intended(url('admin/dashboard'));
        }else{
            //dd($auth);
            return redirect()->back()->withInput($request->only('email'));
        }
    }
    public function logout(Request $request){
        auth()->guard('admin')->logout();
        $request->session()->invalidate();
        return redirect(url('admin/login'));

    }
}
