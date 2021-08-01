<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobSeeker;
use App\Models\JobSeekerSavedJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        if(auth('company')->check()){
            return redirect(route('company.overview'));
        }

        // global
        $posts = JobPost::latest()->take(20)->with('company')->get();
        $categories = [];
        $topEmployers =[];

        if(auth('jobseeker')->check()){
            $jobSeekerId = Auth::guard('jobseeker')->user()->id;
            $seeker = JobSeeker::find($jobSeekerId);
            return view('home')->with([
            'posts' => $posts,
            'categories' => $categories,
            'topEmployers' => $topEmployers
        ]);
        }

        return view('home')->with([
            'posts' => $posts,
            'categories' => $categories,
            'topEmployers' => $topEmployers
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
        $jobseekerId = auth('jobseeker')->user()->id ?? 0;
        if($jobseekerId != null){
            $count = JobSeekerSavedJobs::where('job_seeker_id', $jobseekerId)
            ->where('job_post_id', $id)->count();
            if($count > 0){
                $hasSaved = true;
            }
        }

        return view('post.show')->with([
            'post' => $post,
            'company' => $company,
            'hasSaved' => $hasSaved,
            'similarJobs' => $similarPosts,
        ]);
    }
}
