@extends('layouts.company-account')

@section('content')
  <div class="account-layout border">
    <div class="account-hdr bg-primary text-white border">
      Company information
    </div>
    <div class="account-bdy p-3">
     <form action="{{route('company.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="pb-3">
          <div class="py-2">
            <img src="{{asset($company->logo)}}" width="200px" alt="">
          </div>

          <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile01" name="logo"
              aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Choose logo...</label>
            @error('logo')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>

        <div class="form-group">
          <div class="py-2">
            <p>Company name</p>
          </div>
          <input type="text" placeholder="Company name" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name')??$company->company_name }}" >
            @error('company_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <label for="">Industry</label>
          <select class="form-control" name="industry_id" value="{{ old('industry_id')??$company->industry_id }}"  >
            @foreach ($industries as $industry)
              <option value="{{$industry->id}}" {{ $industry->id == $company->industry_id ? 'selected' : '' }}>{{$industry->name}}</option>
            @endforeach
          </select>
        </div>

        

        <div class="form-group">
          <div class="py-2">
            <p>Website</p>
          </div>
          <input type="text" placeholder="Company Website" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website')??$company->website }}" >
            @error('website')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <div class="py-2">
            <p>Email</p>
          </div>
          <input type="text" placeholder="Company Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email')??$company->email }}" >
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <div class="py-2">
            <p>Contact person</p>
          </div>
          <input type="text" placeholder="Contact Person" class="form-control @error('contact_person_name') is-invalid @enderror" name="contact_person_name" value="{{ old('contact_person_name')??$company->contact_person_name }}" >
            @error('contact_person_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <div class="py-2">
            <p>Telephone</p>
          </div>
          <input type="text" placeholder="Phone number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone')??$company->phone }}">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <div class="py-2">
            <p>Address</p>
          </div>
          <input type="text" placeholder="Company Address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address')??$company->address }}" >
            @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
          <label for="">Province/City</label>
          <select class="form-control" name="province_id" value="{{ old('province_id')??$company->province_id }}">
            @foreach ($provinces as $province)
              <option value="{{$province->id}}" {{ $industry->id == $company->province_id ? 'selected' : '' }}>{{$province->province}}</option>
            @endforeach
          </select>
        </div>
   
        <div class="pt-2">
          <p class="mt-3 alert alert-primary">Provide a description about your company</p>
        </div>
        <div class="form-group">
          <textarea class="form-control @error('description') is-invalid @enderror" name="description" >{{ old('description')??$company->description }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
   
        <div class="line-divider"></div>
        <div class="mt-3">
          <button type="submit" class="btn primary-btn">Update company</button>
          {{-- <a href="{{route('account.authorSection')}}" class="btn primary-outline-btn">Cancel</a> --}}
        </div>
      </form>
    </div>
  </div>
@endSection
