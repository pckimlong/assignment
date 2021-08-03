<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyLogin;
use App\Models\Industry;
use App\Models\JobPost;
use App\Models\JobPostActivity;
use App\Models\JobSeeker;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class CompanyController extends Controller
{   

    public function overview()
    {
        return view('company.company-overview');
    }
    //! Manage Job ------------------------------------------------------------
    public function deleteJob($jobId)
    {
        $delete = JobPost::where('id', $jobId)->where('company_id', auth()->user()->id)->delete();
        if($delete){
            Alert::toast('Job post deleted!', 'info');
            return redirect()->back();
        }
        Alert::toast('Failed to delete job post!', 'error');
    }

    //! View company public-----------------------------------------------------
    public function companyView($id)
    {
        $company = Company::findOrFail($id);
        $jobs = JobPost::whereHas('company', function ($query) use ($company) {
            return $query->where('company_id', $company->id);
        })->where('is_active', true)->orderBy('id', 'desc')->get();
        return view('company.company-view', [
            'company' => $company,
            'jobs' => $jobs,
        ]);
    }
    //! Job Application--------------------------------------------------
    public function jobActivitiesView()
    {
        Paginator::useBootstrap();
        $company = Company::find(auth()->user()->id);
        $ids =  $company->posts()->pluck('id');
        $activities = JobPostActivity::whereIn('job_post_id', $ids)->latest()->paginate(10);
        return view('company.job-activities')->with([
            'activities' => $activities,
        ]);;
    }
    public function showActivity($id)
    {
        $activity = JobPostActivity::find($id);

        $post = $activity->jobPost()->first();
        $userId = $activity->job_seeker_id;
        $jobseeker = JobSeeker::find($userId);

        $company = $post->company()->first();
        return view('company.job-activity-show')->with([
            'jobseeker' => $jobseeker,
            'post' => $post,
            'company' => $company,
            'activity' => $activity
        ]);
    }

    //! Job List --------------------------------------------------------
    public function jobListView()
    {
        Paginator::useBootstrap();
        $posts = JobPost::where('company_id', auth()->user()->id)->orderBy('is_active', 'desc')->orderBy('id', 'desc')->paginate(10);
        return view('company.company-joblist')->with([
            'posts' => $posts
        ]);
    }

    //! Upload job----------------------------------------------------
    public function uploadView()
    {
        return view('company.upload-job');
    }

    public function storeJob(Request $request)
    {
        $this->validatePost($request);

        $companyId = auth()->user()->id;

        $postData = array_merge(['company_id' => auth()->user()->id], $request->all());

        $post = JobPost::create($postData);
        if ($post) {
            Alert::toast('Job Posted!', 'success');
            return redirect()->route('company.info');
        }
        Alert::toast('Job post failed!', 'warning');
        return redirect()->back();

    }
    protected function validatePost(Request $request)
    {
        return $request->validate([
            'job_title' => 'required|min:5',
            'hire_amount' => 'required|numeric',
            'job_level' => 'required',
            'min_salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'max_salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'min_age' => 'nullable|numeric',
            'max_age' => 'nullable|numeric',
            'job_location' => 'required|string',
            'languages' => 'required|string',
            'deadline' => 'required',
            'sex' => 'required|string|max:1',
            'term' => 'required|string',
            'skills' => 'required',
            'qualification' => 'required|string',
        ]);
    }
    
    //! Company information----------------------------------------------------
    public function infoView()
    {
        $company = Company::find(auth()->user()->id);
        $industries = Industry::orderBy('name')->get();
        $provinces = Province::orderBy('province')->get();
        
        return view('company.company-info', [
                'company'=> $company,
                'industries' => $industries,
                'provinces' => $provinces,
            ]);
    }
    public function update(Request $request)
    {
        $valid = $this->validateCompanyUpdate($request);
        $company = Company::find(auth()->user()->id);
        if ($this->companyUpdate($company, $request) && $valid) {
            Alert::toast('Company updated!', 'success');
            return redirect()->route('company.info');
        }
        Alert::toast('Failed!', 'error');
        return redirect()->route('company.info');
    }
    protected function validateCompanyUpdate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'company_name' => 'required|min:5',
            'description' => 'required|min:5',
            'logo' => 'image|max:2999',
            'email' => 'required|email',
            'contact_person_name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|numeric',
        ]);

        if($validator->fails()){
             redirect()->route('company.info')->withInput()->withErrors($validator);
             return false;
        }
        return true;

    }
    protected function companyUpdate(Company $company, Request $request)
    {
        $company->company_name = $request->company_name;
        $company->industry_id = $request->industry_id;
        $company->website = $request->website;
        $company->email = $request->email;
        $company->contact_person_name = $request->contact_person_name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->province_id = $request->province_id;
        $company->description = $request->description; 

        //logo should exist but still checking for the name
        if ($request->hasFile('logo')) {
            $fileNameToStore = $this->getFileName($request->file('logo'));
            $logoPath = $request->file('logo')->storeAs('public/companies/logos', $fileNameToStore);
            if ($company->logo) {
                Storage::delete('public/companies/logos/' . basename($company->logo));
            }
            $company->logo = 'storage/companies/logos/' . $fileNameToStore;

            
        }

        if ($company->save()) {
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


    //! Change password --------------------------------------------------------
    public function changePasswordView(){
        return view('company.company-change-password');
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

        $authUser = CompanyLogin::find(auth()->user()->id);
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

}
