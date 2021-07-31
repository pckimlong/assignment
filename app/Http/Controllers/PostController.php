<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use App\Models\JobSeeker;
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

        return view('post.show')->with([
            'post' => $post,
            'company' => $company,
            'similarJobs' => $similarPosts,
        ]);
    }
}
