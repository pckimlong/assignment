<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Industry;
use App\Models\JobPost;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $posts = JobPost::paginate(2);
        // $posts = [];
        return view('job.index-2', ['posts' => $posts]);
    }

    //api route
    public function search(Request $request)
    {
        if ($request->q) {
            $posts = JobPost::where('job_title', 'LIKE', '%' . $request->q . '%');
        } elseif ($request->category_id) {
            $posts = JobPost::whereHas('company', function ($query) use ($request) {
                return $query->where('company_category_id', $request->category_id);
            });
        } elseif ($request->job_level) {
            $s = JobPost::where('job_level', 'Like', '%' . $request->job_level . '%');
        } elseif ($request->education_level) {
            $posts = JobPost::where('education_level', 'Like', '%' . $request->education_level . '%');
        } elseif ($request->employment_type) {
            $posts = JobPost::where('employment_type', 'Like', '%' . $request->employment_type . '%');
        } else {
            $posts = JobPost::take(30);
        }

        $posts = $posts->has('company')->with('company')->paginate(6);

        return $posts->toJson();
    }
    public function getCategories()
    {
        $categories = Industry::all();
        return $categories->toJson();
    }
    public function getAllOrganization()
    {
        $companies = Company::all();
        return $companies->toJson();
    }
    public function getAllByTitle()
    {
        $posts = JobPost::where('deadline', '>', Carbon::now())->get()->pluck('id', 'job_title');
        return $posts->toJson();
    }
}
