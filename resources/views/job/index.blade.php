{{-- @extends('layouts.job')
@section('content')

<section class="search-bar mt-2 px-0">
  <div class="py-4">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form>
          <div class="row m-1">
            <div class="col-md-12 input-group">
              <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Search By Job Title"
                v-model="jobTitle"
              />
              <span class="input-group-append">
                <button class="btn btn-success pt-1">
                  <span class="icon-search"></span> Search Jobs
                </button>
              </span>
            </div>
          </div>
        </form>
      </div>
      <div class="col-sm-12 col-md-6 offset-md-3 small text-center my-2">
        <div class="row">
          <div class="col-sm-6 col-md-3">
            <router-link to="/">All Jobs</router-link>
          </div>
          <div class="col-sm-6 col-md-3">
            <router-link to="/jobs-by-organization"
              >By Organisation</router-link
            >
          </div>
          <div class="col-sm-6 col-md-3">
            <router-link to="/jobs-by-category">By Job Category</router-link>
          </div>
          <div class="col-sm-6 col-md-3">
            <router-link to="/jobs-by-title">By Job Title</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="card ">
  <div class="card-header">
    Similar Jobs
  </div>
  <div class="card-body">
    <div class="similar-jobs">
      @foreach ($jobs as $job)
      @if($jobs)
        <div class="job-item border-bottom row">
          <div class="col-4">
            <img src="{{asset($job->company->logo)}}" width = "100px" class="company-logo" alt="">
          </div>
          <div class="job-desc col-8">
            <a href="{{route('post.show',['job'=>$job->id])}}" class="job-category text-muted font-weight-bold">
              <p class="text-muted h6">{{$job->job_title}}</p>
              <p class="small">{{$job->company->title}}</p>
              <p class="font-weight-normal small text-danger">Deadline: {{date('d',$job->remainingDays())}} days</p>
            </a>
          </div>
        </div>
        @else
        <div class="card">
          <div class="card-header">
            <p>No similar jobs</p>
          </div>
        </div>
        @endif
      @endforeach
    </div>
    {{ $jobs->links() }}
  </div>
</div>

@endsection

@push('css')
  <style>
    .search-bar {
      background-color: #f5fdff;
    }
    .w-5{
      display: none;
    }
    .card-list-component {
      width: 100%;
      padding: 0.5rem 0.25rem;
      color: #888;
      cursor: pointer;
      margin-bottom: 1rem;
    }
    .card-list-component:hover {
      background-color: #f5fdff;
    }
    .hover-shadow:hover {
      box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.25);
    }
  </style>
@endpush --}}



{{-- @extends('layouts.job')
@section('content')
<section class="job-section">
  <app-component/>
</section>  
@endsection --}}