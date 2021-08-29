<?php

namespace App\Http\Controllers\Parent\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        return view('back.teacher.auth.passwords.email');
    }
    public function broker()
    {
         return Password::broker('teachers');
    }
}