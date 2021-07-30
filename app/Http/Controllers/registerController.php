<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLogin;
use App\Models\JobSeeker;
use App\Models\JobSeekerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:company');
        $this->middleware('guest:jobseeker');
    }

    /// Show register form---------------------
    public function showCompanyRegisterForm()
    {
        return view('company.register');
    }

    public function showJobSeekerRegisterForm()
    {
        return view('jobseeker.register');
    }


    /// create -----------------------------------------
    protected function createCompany(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $companyDetail = Company::create();
        $company = CompanyLogin::create([
            'id' => $companyDetail['id'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        Alert::toast('Account created successfully!', 'success');
        return redirect()->intended('company/login');
    }

    protected function createJobSeeker(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:job_seeker_logins',
            'password' => 'required|min:6|confirmed',
        ]);

        $data = $request->all();

        $seeker = JobSeeker::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone_number' => $data['phone'],
        ]);

        $login = JobSeekerLogin::create([
            'id' => $seeker['id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        Alert::toast('Account created successfully!', 'success');
        return redirect("/")->withSuccess('You have signed-in');

        // return redirect()->intended('/');
    }
}
