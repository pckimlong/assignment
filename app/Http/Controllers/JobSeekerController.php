<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\JobSeekerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class JobSeekerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:jobseeker')->except(route('index'));
    }

    public function index()
    {
        return view('jobseeker.job-seeker-account');
    }
    //! apply job----------------------------------------------------
    

    public function showCV()
    {
        return view('jobseeker.job-seeker-cv');
    }
    public function changePasswordView()
    {
        return view('jobseeker.job-seeker-change-password');
    }
    public function changePassword(Request $request)
    {
        if (!auth()->user()) {
            Alert::toast('Not authenticated!', 'success');
            return redirect()->back();
        }

        //check if the password is valid
        $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|min:8'
        ]);

        $authUser = JobSeekerLogin::find(auth()->user()->id);
        $currentP = $request->current_password;
        $newP = $request->new_password;
        $confirmP = $request->confirm_password;

        if (Hash::check($currentP, $authUser->password)) {
            if (Str::of($newP)->exactly($confirmP)) {
                $authUser->password = Hash::make($newP);
                if ($authUser->save()) {
                    Alert::toast('Password Changed!', 'success');
                } else {
                    Alert::toast('Something went wrong!', 'warning');
                }
            } else {
                Alert::toast('Comfirm password do not match!', 'info');
            }
        } else {
            Alert::toast('Incorrect current Password!', 'info');
        }
        return redirect()->back();
    }
    public function showSavedJob()
    {
        return view('jobseeker.job-seeker-saved-job');
    }
    public function deactive()
    {
        return view('jobseeker.job-seeker-deactive');
    }
    public function deleteAccount()
    {
        $user = JobSeeker::find(auth()->user()->id);
        Auth::logout($user->id);
        if ($user->delete()) {
            Alert::toast('Your account was deleted successfully!', 'info');
            return redirect(route('index'));
        } else {
            return view('jobseeker.job-seeker-deactive');
        }
    }
    

    public function logoutJobSeeker() {
        dd('hi');
        Auth::guard('jobseeker')->logout();
        return redirect()->intended('/');
    }
}
