<?php

namespace App\Http\Controllers\Student\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/student/dashboard';

    public function showResetForm(Request $request, $token = null)
    {
        //dd("check");
        return view('back.student.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        return Password::broker('students');
    }

    protected function guard()
    {
        return Auth::guard('student');
    }
}