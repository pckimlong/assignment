<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\JobPost;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;

class JobController extends Controller
{
    public function index(Request $request)
    {
        Paginator::useBootstrap();
        $posts = JobPost::orderBy('id', 'desc')->paginate(10);
        $industries = Industry::orderBy('name')->get();
        return view('job.index-2', [
            'posts' => $posts, 
            'industries' => $industries, 
            'q'=>'',
            'q' => $request->q,
             'industry_id' => 0,
             'job_level' => 0,
             'qualification' => 0,
             'term' => 0,
        ]);
    }

    //api route
    public function search(Request $request)
    {
        Paginator::useBootstrap();
        if ($request->q) {
            $posts = JobPost::where('job_title', 'LIKE', '%' . $request->q . '%');
        } elseif ($request->industry_id) {
            $posts = JobPost::whereHas('company', function ($query) use ($request) {
                return $query->where('industry_id', $request->industry_id);
            });
        } elseif ($request->job_level) {
            $s = JobPost::where('job_level', 'Like', '%' . $request->job_level . '%');
        } elseif ($request->qualification) {
            $posts = JobPost::where('qualification', 'Like', '%' . $request->qualification . '%');
        } elseif ($request->term) {
            $posts = JobPost::where('term', 'Like', '%' . $request->term . '%');
        } else {
            $posts = JobPost::take(30);
        }

        $posts = $posts->has('company')->with('company')->orderBy('id', 'desc')->paginate(10);
        $industries = Industry::orderBy('name')->get();
        // return $posts->toJson();
        return view('job.index-2', [
            'posts' => $posts,
             'industries' => $industries, 
             'q' => $request->q,
             'industry_id' => $request->industry_id,
             'job_level' => $request->job_level,
             'qualification' => $request->qualification,
             'term' => $request->term,
    ]);
    }

}
