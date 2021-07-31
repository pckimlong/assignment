@extends('layouts.post')

@section('content')
<section class="show-page pt-4 mb-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <div class="job-listing border">
          <div class="company-info">
            <div class="company-banner">
              <div class="banner-overlay"></div>
              <div class="company-media">


                <img src="{{asset($company->logo)}}" alt="" class="company-logo">
                <div>
                  <a href="{{ route('company', ['id'=>$company->id]) }}" class="secondary-link">
                    <p class="font-weight-bold">{{$company->company_name}}</p>
                    <p class="company-category">{{$company->industry->name}}</p>
                  </a>
                </div>
              </div>
              <div class="company-website">
                <a href="{{$company->website}}" target="_blank"><i class="fas fa-globe"></i></a>
              </div>
            </div>

            
            <div class = 'py-3 px-4'>
              <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Website</h6>
              <p class="m-b-10 f-w-600">{{ $company->website ?? ''}}</p>
            </div>

            <div class = 'py-3 px-4'>
              <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Location</h6>
              <p class="m-b-10 f-w-600">{{ $company->province->province ?? ''}}</p>
              <p class="m-b-10 f-w-600">{{ $company->address ?? ''}}</p>
            </div>

            <div class = 'py-3 px-4'>
              <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Contact Information</h6>
              <p class="m-b-10 f-w-600">{{ $company->contact_person_name ?? ''}}</p>
              <p class="m-b-10 f-w-600">{{ $company->phone ?? ''}}</p>
              <p class="m-b-10 f-w-600">{{ $company->email ?? ''}}</p>
            </div>

            <div class = 'py-5 px-4'>
              <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Company Decription</h6>
              <div class="py-2">
                <p>{{$company->description}}</p>
              </div>
            </div>

            
            
          </div>
        </div>
      </div>

      <div class="col-sm-12 col-md-4">
        <div class="card ">
          <div class="card-header">
            Company Jobs ({{ $jobs->count() }} active jobs)
          </div>
          <div class="card-body">
            <div class="similar-jobs">
              @foreach ($jobs as $job)
              @if($jobs)
                <div class="job-item border-bottom row">
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
                    <p>No active jobs</p>
                  </div>
                </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>

@endsection

@push('css')
<style>
  .company-banner {
    min-height: 20vh;
    position: relative;
    overflow: hidden;
  }

  .company-banner-img {
    width: 100%;
    height: auto;
    overflow: hidden;
  }

  .banner-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, .3));
    width: 100%;
    height: 200px;
  }

  .company-website {
    position: absolute;
    right: 20px;
    bottom: 20px;
    color: white;
  }

  .company-media {
    position: absolute;
    display: flex;
    align-items: center;
    left: 2rem;
    bottom: 1rem;
    color: #333;
    padding-right: 2rem;
    background-color:rgba(255,255,255,.8);
  }

  .company-logo {
    max-width: 100px;
    height: auto;
    margin-right: 1rem;
    padding: 1rem;
    background-color: white;
  }

  .company-category {
    font-size: 1.3rem;
  }

  .company-link:hover {
    color: #ddd;
  }

  .job-title {
    font-size: 1.3rem;
    font-weight: bold;
  }

  .job-hdr {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(to right, #e1edf7, #EDF2F7)
  }

  .job-item{
    margin-bottom: .5rem;
    padding:.5rem 0;
  }
  .job-item:hover {
    background-color:#eee;
  } 

</style>
@endpush

@push('js')

@endpush