@extends('layouts.account')
@section('content')
<div class="account-layout border">
    <div class="account-hdr border bg-primary text-white shadow">
      My saved Jobs
    </div>
    <div class="account-bdy p-3">
      <div class="my-2">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
          {{-- <table class="table table-striped table-hover"> --}}
            <thead class="bg-light small">
              <tr>
                <th>Job Position</th>
                <th>Job Level</th>
                <th>Company</th>
                <th>No of vacancy</th>
                <th>Apply Before</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jobs as $job)
              <tr >
                <td><a href="{{route('post.show',['job'=>$job])}}">{{$job->job_title}}</a></td>
                <td>{{$job->job_level}}</td>
                <td><a href="{{route('company',['id'=>$job->company_id])}}">{{substr($job->company->company_name,0,14)}}..</a></td>
                <td>{{$job->hire_amount}}</td>
                <td>{{date('d/m/Y',$job->deadlineTimestamp())}}, {{date('d',$job->remainingDays()) }} days</td>
                <td><form action="{{ route('jobseeker.unsave-job', ['jobId'=>$job->id]) }}" method="POST">
                  @csrf
                  @method("delete")
                  <button type="submit" href="#" class="btn secondary-outline-btn">Unsave</button>
                </form></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection