<?php

namespace App\Http\Controllers;

use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:company');
        $this->middleware('guest:jobseeker');
    }

    /// Company
    public function showCompanyLoginForm()
    {
        return view('company.login');
    }
    public function companyLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            Auth::shouldUse('company');
            return redirect()->intended(route('index'));
        }
        Alert::toast('Incorrect email or password!', 'error');
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
            return redirect()->intended(route('index'));
        }
        Alert::toast('Incorrect email or password!', 'error');
        return back()->withInput($request->only('email', 'remember'));
    }

    

    public function logoutCompany() {
        Auth::guard('company')->logout();
        return redirect('/');
    }
    
}
