@extends('layouts.account')
@section('content')
<div class="account-layout border">
    <div class="account-hdr bg-primary text-white border">
      Resume(CV)
    </div>
    <div class="account-bdy p-3">
      <div class="row mb-3">
        <div class="col-sm-12 col-md-12">
          <form action="{{route('jobseeker.cv.update')}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="m-b-25 my-2"> <img src="{{asset($jobseeker->avatar())}}" width="120px" class="rounded img-thumbnail" alt="User-Profile-Image"> </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile_image"
                      aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose photo...</label>
                    @error('profile_image')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label for="">First Name</label>
                  <input type="text" placeholder="First Name" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname')?? $jobseeker->firstname }}" required >
                    @error('firstname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6">
                  <label for="">Last Name</label>
                  <input type="text" placeholder="Last Name" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname')?? $jobseeker->lastname }}" required >
                    @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Date of Birth</label>
                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate')?? $jobseeker->birthdate }}" required >
                      </div>
                  <div class="col-md-6">
                    <label for="">Gender</label>
                    <select name="gender" class="form-control" value="{{old('gender')?? $jobseeker->gender}}" required>
                      <option value=""  {{old('gender')?? $jobseeker->gender == 'null' ? 'selected' : '' }}>-- Gender --</option>
                      <option value="M" {{old('gender')?? $jobseeker->gender == 'M' ? 'selected' : '' }}>Male</option>
                      <option value="F" {{old('gender')?? $jobseeker->gender == 'F' ? 'selected' : '' }}>Female</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Nationality</label>
                  <input type="text" placeholder="Nationality" class="form-control @error('nationality') is-invalid @enderror" name="nationality" value="{{ old('nationality')?? $jobseeker->nationality }}" required >
                    @error('nationality')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                  <div class="col-md-6">
                    <label for="">Marital Status</label>
                    <select  name="marital_status" class="form-control" value="{{old('marital_status')?? $jobseeker->marital_status}}" required>
                      <option value="" {{ $jobseeker->marital_status == 'null' ? 'selected' : '' }}>-- Marital Status --</option>
                      <option value="Single" {{ old('marital_status')?? $jobseeker->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                      <option value="Married" {{ old('marital_status')?? $jobseeker->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Current Address</label>
                <input type="text" placeholder="Current Address" class="form-control @error('current_address') is-invalid @enderror" name="current_address" value="{{ old('current_address')?? $jobseeker->current_address }}" required >
                @error('current_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Phone Number</label>
                    <input type="text" placeholder="Phone Number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') ?? $jobseeker->phone_number }}"  >
                      @error('phone_number')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="">Email Address <span class="text-info">(link with account)</span></label>
                    <input type="text" placeholder="Email Address" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')?? $jobseeker->login->email }}" disabled="disabled" >
                      @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="">Backgroud Education</label>
                
                  <table id='tbEducation' class = "table table-hover">
                    <tbody>
                      @foreach ($educations as $education)
                      <tr >
                        <td width="13%">{{ $education->startYear() }} - {{ $education->endYear() }}</td>
                        <td width="3%">:</td>
                        <td width="60%">{{ $education->school_name }}, {{ $education->major }}, {{ $education->certification }}</td>
                        <td width="4%" id="delete_row"><a class = 'fas fa-times text-muted'></a></td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  <div class="mx-2 text-primary d-flex flex-row-reverse">
                    <a href="{{ route('company.registration') }}">Add Education</a>
                </div>
              </div>

              
              <div class="form-group">
                <label for="">Working Experience</label>
                
                  <table id='tbEducation' class = "table table-hover">
                    <tbody>
                      @foreach ($experiences as $experience)
                      <tr >
                        <td width="13%">{{ $experience->startYear() }} - {{ $experience->endYear() }}</td>
                        <td width="3%">:</td>
                        <td width="60%">{{ $experience->job_name }}, {{ $experience->company }}, {{ $experience->description }}</td>
                        <td width="4%" id="delete_row"><a class = 'fas fa-times text-muted'></a></td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                  <div class="mx-2 text-primary d-flex flex-row-reverse">
                    <a href="{{ route('company.registration') }}">Add Experience</a>
                </div>
              </div>

              <div class="form-group">
                <label for="">Language</label>
                <input type="text" placeholder="Language eg. Khmer, English..." class="form-control @error('languages') is-invalid @enderror" name="languages" value="{{ old('languages')??$jobseeker->languages }}" >
                @error('languages')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Hobbies</label>
                <input type="text" placeholder="Hobbies" class="form-control @error('hobbies') is-invalid @enderror" name="hobbies" value="{{ old('hobbies')?? $jobseeker->hobbies }}" >
                @error('hobbies')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <div class="form-group">
                <label for="">Skills</label>
                <textarea class="form-control @error('skills') is-invalid @enderror" name="skills"  >{{ old('skills')?? $jobseeker->skills }}</textarea>
                  @error('skills')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>

              

            <button type="submite" id="save" class="btn primary-btn">Update Resume</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

