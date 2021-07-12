<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:jobseeker')->except(route('post.index'));
    }

    public function index()
    {
        return view('jobseeker.job-seeker-account');
    }

    public function logoutJobSeeker() {
        dd('hi');
        Auth::guard('jobseeker')->logout();
        return redirect()->intended('/');
    }
}
