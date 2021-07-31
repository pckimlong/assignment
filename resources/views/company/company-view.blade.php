@extends('layouts.post')

@section('content')
<section class="show-page pt-4 mb-5">
  <div class="container">
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

            {{-- company information --}}
            <div class = "py-2">
            <div class="px-3 py-1">
              <span>
                <i class ="fas fa-map-marker-alt icon-cog text-muted"></i>
              </span>
              <span>{{ $company->province->province }}</span>
            </div>
            <div class="px-3 py-1">
              <span>
                <i class ="fas fa-map-marker-alt icon-cog text-muted"></i>
              </span>
              <span>{{ $company->address }}</span>
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




</style>
@endpush

@push('js')

@endpush