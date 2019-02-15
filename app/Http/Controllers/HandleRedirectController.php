<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Session;

class HandleRedirectController extends Controller
{
    public function handle() {

        if(\Auth::check() && \Auth::user()->admin == 1) {
            $user = \Auth::user()->username;
            $user = ucwords(strtolower($user));
            Session::flash("successmessage", "Welcome back Admin, ".$user."!");
            return Redirect('admin_dashboard');
        }

        if(\Auth::check() && \Auth::user()->role == 'teacher') {
            $user = \Auth::user()->username;
            $user = ucwords(strtolower($user));
            Session::flash("successmessage", "Hello, Teacher ".$user."!");
            return Redirect('teacher_dashboard');
        }

        if(\Auth::check() && \Auth::user()->role == 'student') {
            $user = \Auth::user()->username;
            $user = ucwords(strtolower($user));
            Session::flash("successmessage", "Hi there, ".$user."!");
            return Redirect('student_dashboard');
        }
    }
}
