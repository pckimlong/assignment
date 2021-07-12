<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:company')->except('logout');
        $this->middleware('guest:jobseeker')->except('logout');
    }

    /// Company
    public function showComanyLoginForm()
    {
        return view('company.login');
    }
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            Auth::shouldUse('company');
            return redirect()->intended('/company');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    /// job seeker
    public function showJobSeekerLoginForm()
    {
        return view('jobseeker.login');
    }
    public function jobSeekerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('jobseeker')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            Auth::shouldUse('jobseeker');
            // dd(Auth::user()->jobSeeker->firstname);
            return redirect()->intended('/');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    

    public function logoutCompany() {
        Auth::guard('company')->logout();
        return redirect('/');
    }
    
}
