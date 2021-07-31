@extends('layouts.account')
@section('content')
<div class="account-layout border">
    <div class="account-hdr bg-primary text-white border">
      Resume
    </div>
    <div class="account-bdy p-3">
      <div class="row mb-3">
        <div class="col-sm-12 col-md-12">
          <form action="{{route('company.storejob')}}" id="postForm" method="POST">

            @csrf
            <div class="form-group">
              <label for="">Job title</label>
              <input type="text" placeholder="Job title" class="form-control @error('job_title') is-invalid @enderror" name="job_title" value="{{ old('job_title') }}" required autofocus >
              @error('job_title')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Job level</label>
                  <select name="job_level" class="form-control" value="{{old('job_level')}}" required>
                    @foreach (Config::get('constants.job_level') as $level)
                      <option value="{{ $level }}">{{ $level }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="">Term</label>
                  <select name="term" class="form-control" value="{{old('term')}}" required>
                    @foreach (Config::get('constants.term') as $term)
                      <option value="{{ $term }}">{{ $term }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
       

            <div class="form-group">
              <label for="">Job location</label>
              <input type="text" placeholder="Job location" class="form-control @error('job_location') is-invalid @enderror" name="job_location" value="{{ old('job_location') }}" required >
              @error('job_location')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Age</label>
                  <div class="row">
                    <div class ="col-md">
                      <input type="number" placeholder="Youngest age" class="form-control @error('min_age') is-invalid @enderror" name="min_age" value="{{ old('min_age') }}" required >
                      @error('min_age')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class ="col-md">
                      <input type="number" placeholder="Oldest age" class="form-control @error('max_age') is-invalid @enderror" name="max_age" value="{{ old('max_age') }}" required >
                      @error('max_age')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="">Sex</label>
                  <select name="sex" class="form-control" value="{{old('sex')}}" required>
                    <option value="B">Unlimited</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Required language <span class="text-info">( If multiple separate with "," )</span></label>
              <input type="text" placeholder="Khmer,English etc" class="form-control @error('languages') is-invalid @enderror" name="languages" value="{{ old('languages') }}" required >
              @error('languages')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Offered Salary (Monthly)</label>
                  <div class="row">
                    <div class ="col-md">
                      <input type="number" placeholder="Lowest $" class="form-control @error('min_salary') is-invalid @enderror" name="min_salary" value="{{ old('min_salary') }}" required >
                      @error('min_salary')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class ="col-md">
                      <input type="number" placeholder="Highest $" class="form-control @error('max_salary') is-invalid @enderror" name="max_salary" value="{{ old('max_salary') }}" required >
                      @error('max_salary')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="">Hire amount</label>
                  <input type="number" class="form-control @error('hire_amount') is-invalid @enderror" name="hire_amount" value="{{ old('hire_amount') }}" required >
                  @error('hire_amount')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Skills <span class="text-info">( If multiple separate with "," )</span></label>
              <input type="text" placeholder="Skill1,Skill2 etc" class="form-control @error('skills') is-invalid @enderror" name="skills" value="{{ old('skills') }}" required >
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Qualification	</label>
                  <select name="qualification" class="form-control" value="{{old('qualification')}}">
                    @foreach (Config::get('constants.qualification') as $qualification)
                      <option value="{{ $qualification }}">{{ $qualification }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="">Year of Experience</label>
                  <input type="number" class="form-control @error('year_of_experience') is-invalid @enderror" name="year_of_experience" value="{{ old('year_of_experience') }}" required >
                  @error('year_of_experience')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Job Description (Specifications) <small>Optional Field</small></label>
              <input type="hidden" id="specifications" name="specifications" value="{{old('specifications')}}">
              <div id="quillEditor" style="height:200px"></div>
            </div>

            <button type="button" id="postBtn" class="btn primary-btn">Create Job Post</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection