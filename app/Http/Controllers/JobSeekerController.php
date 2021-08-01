<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\JobSeekerEducation;
use App\Models\JobSeekerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
    

    //! cv------------------------------------------------------------
    public function showCV()
    {
        $jobseeker = JobSeeker::find(auth()->user()->id);
        $educations = $jobseeker->educations;
        $experiences = $jobseeker->experiences;
        return view('jobseeker.job-seeker-cv',[
            'jobseeker' => $jobseeker,
            'educations' => $educations,
            'experiences' => $experiences,
        ]);
    }
    public function updateCV(Request $request)
    {
        $this->validateCVUpdate($request);
        $company = JobSeeker::find(auth()->user()->id);
        if ($this->cvUpdate($company, $request)) {
            Alert::toast('Resume updated!', 'success');
            return redirect()->route('jobseeker.cv');
        }
        Alert::toast('Failed!', 'error');
        return redirect()->route('jobseeker.cv');
    }
    protected function validateCVUpdate(Request $request)
    {
        $request->validate([
            'firstname' => ['required','min:1'],
            'lastname' => ['required','min:1'],
            'birthdate' => ['required'],
            'gender' => ['required'],
            'nationality' => ['required'],
            'marital_status' => ['required'],
            'current_address' => ['required'],
            'phone_number' => ['required', 'numeric'],
            'languages' => ['required'],
            'hobbies' => ['required'],
            'skills' => ['required'],
            'profile_image' => ['required','image']

        ]);
    }
    protected function cvUpdate(JobSeeker $jobSeeker, Request $request)
    {
        $jobSeeker->firstname = $request->firstname;
        $jobSeeker->lastname = $request->lastname;
        $jobSeeker->birthdate= $request->birthdate;
        $jobSeeker->gender= $request->gender;
        $jobSeeker->nationality = $request->nationality;
        $jobSeeker->marital_status = $request->marital_status;
        $jobSeeker->current_address = $request->current_address;
        $jobSeeker->phone_number = $request->phone_number;
        $jobSeeker->languages = $request->languages;
        $jobSeeker->hobbies = $request->hobbies;
        $jobSeeker->profile_image = $request->profile_image;
        $jobSeeker->skills = $request->skills;
        // dd($request->profile_image);
        if ($request->hasFile('profile_image')) {
            $fileNameToStore = $this->getFileName($request->file('profile_image'));
            $logoPath = $request->file('profile_image')->storeAs('public/jobseeker/avatars', $fileNameToStore);
            if ($jobSeeker->profile_image) {
                Storage::delete('public/jobseeker/avatars/' . basename($jobSeeker->profile_image));
            }
            $jobSeeker->profile_image = 'storage/jobseeker/avatars/' . $fileNameToStore;
        }
        if ($jobSeeker->save()) {
            return true;
        }
        return false;
    }
    protected function getFileName($file)
    {
        $fileName = $file->getClientOriginalName();
        $actualFileName = pathinfo($fileName, PATHINFO_FILENAME);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        return $actualFileName . time() . '.' . $fileExtension;
    }



    //! change password---------------------------------------------------
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
    
    //! saved job-------------------------------------------------------
    public function showSavedJob()
    {
        return view('jobseeker.job-seeker-saved-job');
    }

    //! deactive account------------------------------------------------------------
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
