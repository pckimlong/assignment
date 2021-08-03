@extends('layouts.account')

@section('content')
  <div class="account-layout  border">
    <div class="account-hdr bg-primary text-white border">
      Job Applications
    </div>
    <div class="account-bdy p-3">
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <p class="mb-3 alert alert-primary">Listing all the Applicants who applied for your <strong>job listings</strong>.</p>
          <div class="table-responsive pt-3">
            <table class="table table-hover table-striped small">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Applicant Name</th>
                  <th>Email</th>
                  <th>Job Title</th>
                  <th>Applied on</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if($activities && $activities->count())
                  @foreach($activities as $activity)
                  <tr>
                    <td></td>
                    <td>{{$activity->jobSeeker->fullname()}}</td>
                    <td><a href="mailto:{{$activity->jobSeeker->login->email}}">{{$activity->jobSeeker->login->email}}</a></td>
                    <td><a href="{{route('post.show',['job'=>$activity->jobPost->id])}}">{{substr($activity->jobPost->job_title,0,14)}}...</a></td>
                    <td>{{$activity->created_at}}</td>
                    <td><a href="{{route('company.activities.show',['id'=>$activity])}}" class="btn primary-outline-btn">View</a>
                      <form action="{{route('company.activities.destroy')}}" method="POST" class="d-inline-block">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="activity_id" value="{{$activity->id}}">
                        <button type="submit" class="btn danger-btn">Delete</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td>You haven't received any job activities.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-center mt-4 custom-pagination">
            {{ $activities && $activities->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endSection
