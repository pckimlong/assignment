<?php

namespace App\Http\Controllers;

use App\Models\Industry;
use App\Models\JobPost;
use App\Models\JobPostActivity;
use App\Models\JobSeeker;
use App\Models\JobSeekerSavedJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        if(auth('company')->check()){
            return redirect(route('company.info'));
        }

        // global
        $posts = JobPost::where('is_active', true)->latest()->take(11)->with('company')->get();
        $industries = Industry::orderBy('name')->orderBy('name')->get();

        if(auth('jobseeker')->check()){
            $jobSeekerId = Auth::guard('jobseeker')->user()->id;
            $seeker = JobSeeker::find($jobSeekerId);
            return view('home')->with([
            'posts' => $posts,
            'industries' => $industries,
        ]);
        }

        return view('home')->with([
            'posts' => $posts,
            'industries' => $industries,
        ]);
        
    }

    public function show($id)
    {
        $post = JobPost::findOrFail($id);
        $company = $post->company()->first();
        $similarPosts = JobPost::whereHas('company', function ($query) use ($company) {
            return $query->where('industry_id', $company->industry_id);
        })->where('id', '<>', $post->id)->with('company')->take(5)->get();
        $hasSaved = false;
        $hasApplied = false;
        $jobseekerId = auth('jobseeker')->user()->id ?? 0;
        if($jobseekerId != null){
            $saved = JobSeekerSavedJobs::where('job_seeker_id', $jobseekerId)
            ->where('job_post_id', $id)->exists();
            if($saved){
                $hasSaved = true;
            }
            $applied = JobPostActivity::where('job_seeker_id', $jobseekerId)
            ->where('job_post_id', $id)->exists();
            if($applied){
                $hasApplied = true;
            }
        }

        return view('post.show')->with([
            'post' => $post,
            'company' => $company,
            'hasSaved' => $hasSaved,
            'similarJobs' => $similarPosts,
            'jobseeker' => JobSeeker::find($jobseekerId),
            'hasApplied' => $hasApplied,
        ]);
    }
}
