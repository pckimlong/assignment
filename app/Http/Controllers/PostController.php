<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index()
    {
        if(auth('company')->check()){
            // return view('company.company-overview');
            return redirect(route('company.overview'));
        }
        if(auth('jobseeker')->check()){
            $jobSeekerId = Auth::guard('jobseeker')->user()->id;
            $seeker = JobSeeker::find($jobSeekerId);
            $posts =[];
            $categories = [];
            $topEmployers =[];
            return view('home')->with([
            'posts' => $posts,
            'categories' => $categories,
            'topEmployers' => $topEmployers
        ]);
        }
        

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
