<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function jobseekerHome($jobSeekerId)
    {
        
        $seeker = JobSeeker::find($jobSeekerId);
        $posts =[];
        $categories = [];
        $topEmployers =[];
        return view('home', [])->with([
            'posts' => $posts,
            'categories' => $categories,
            'topEmployers' => $topEmployers
        ]);
        
    }
    public function index()
    {
        // dd(Auth::guard('jobseeker'));
        $posts =[];
        $categories = [];
        $topEmployers =[];
        return view('home')->with([
            'posts' => $posts,
            'categories' => $categories,
            'topEmployers' => $topEmployers
        ]);
        
    }
}
