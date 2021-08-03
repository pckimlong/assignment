@extends('layouts.job')
@section('content')

<form action="{{route('job.search')}}"  method="GET">

<div class="card search-bar mt-2 mb-2 px-0 py-5">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        
          <div class="row m-1">
            <div class="col-md-12 input-group">
              <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Search By Job Title"
                value = "{{ old('q')?? $q }}"
              />
              <span class="input-group-append">
                <button class="btn btn-success pt-1" type = "submit">
                  <span class="icon-search"></span> Search Jobs
                </button>
              </span>
            </div>
          </div>
      </div>     
    </div>
</div>
  
<div class="row">


    <div class="col-sm-12 col-md-5 col-xl-4">
        <div class="card p-0 m-0">
          <div class="card-body p-3">
            <div class="d-flex align-items-center small mb-0">
              <i class="fas fa-search mr-1"></i>
              <strong>Refine Your Job Search</strong>
            </div>
            <a
              href="#"
              class="job-filter d-md-none d-none"
              data-toggle="collapse"
              data-target="#accordion"
              aria-expanded="true"
              aria-controls="accordion"
            >
              <i class="icon icon-list"></i> Filter
            </a>
          </div>
        </div>
        <div id="accordion">
          <div class="card border-top-0">
            <div class="card-body p-3" id="jobCategories">
              <div class="pb-0">
                <div class="card-title mb-1">Job Industry</div>
                <div class="card-body p-0">
                  <div class="form-group">
                    <select
                     onchange="this.form.submit()"
                      name="industry_id"
                      class="form-control"
                      placeholder="Filter by Job Category"
                    >
                      <option  selected value = 0>
                        -- select an option --
                      </option>
                      @foreach ($industries as $industry)
                        <option value="{{$industry->id}}" {{ $industry->id == $industry_id ? 'selected' : '' }}>{{$industry->name}}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-3" />
              <div class="pb-0">
                <div class="card-title mb-1">Job Level</div>
                <div class="card-body p-0">
                  <div class="form-group">
                    <select
                      name="job_level"
                      class="form-control"
                      onchange="this.form.submit()"
                    >
                      <option  selected value>
                        -- select an option --
                      </option>
                    @foreach (Config::get('constants.job_level') as $levelL)
                      <option value="{{ $levelL }}" {{ $levelL == $job_level ? 'selected' : '' }}>{{ $levelL }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-3" />
              <div class="pb-0">
                <div class="card-title mb-1">Qualification</div>
                <div class="card-body p-0">
                  <div class="form-group">
                    <select
                      name="qualification"
                      class="form-control"
                      onchange="this.form.submit()"
                    >
                    @foreach (Config::get('constants.qualification') as $qualificationL)
                      <option value="{{ $qualificationL }}" {{ $qualificationL == $qualification ? 'selected' : '' }}>{{ $qualificationL }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-3"/>
              <div class="pb-0">
                <div class="card-title mb-1">
                    Term
                </div>
                <div class="card-body p-0">
                  <div class="form-group">
                    <select
                      name="term"
                      class="form-control"
                      onchange="this.form.submit()"
                    >
                      <option  selected value>
                        -- select an option --
                      </option>
                    @foreach (Config::get('constants.term') as $terml)
                      <option value="{{ $terml }}" {{ $terml == $term ? 'selected' : '' }}>{{ $terml }}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-7 col-xl-8">
    @if ($posts->count()>0)
        <div class="card">
            <div class="search-result">


                <div class=" mt-md-0 mt-3">
                    <div class="card-body row p-3">
                        <div class="col-6">
                            <h1 class="h6" id="job-count">
                                Showing {{ $posts->firstItem() }} - {{ $posts->lastItem() }} job of {{ $posts->total() }}
                            </h1>
                        </div>
                        <div class="col-6">
                            <ul class="nav nav-inline float-right">
                                <li class="nav-item mr-3">
                                  <a href="#" class="text-secondary">
                                    <span class="icon-calendar"></span>
                                    Posted: <span > All time </span>
                                  </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                @foreach ($posts as $post)
                    <div class="posts">
                        <div class="card mb-3 ml-2 mr-2 hover-shadow">
                            <div class="card-body">
                                <div class="col-sm-12 col-md-12 col-12 col-lg-12">
                                    <div class="row align-items-center text-center text-lg-left">
                                        <div class="px-1 py-1 mx-auto">
                                            <img src="{{asset($post->company->logo)}}" width="100px" class=" img-fluid p-2">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 pl-0 pl-md-2 pb-2">
                                            <h5 class="secondary-link font-weight-bold">
                                                <a href="{{route('post.show',['job'=>$post->id])}}" target="_blank">
                                                    {{ $post->job_title }}
                                                </a>
                                            </h5>
                                            <h6 class = "mt-2">
                                                <a href="{{route('company',['id'=>$post->company->id])}}" target="_blank">
                                                    {{ $post->company->company_name }}
                                                </a>
                                            </h6>
                                            <div class="small my-1">
                                                <span>Address: </span>
                                                <span>{{ $post->job_location }}</span>
                                            </div>
                                            <div class="small">
                                                <span class="text-muted">Key Skills:</span>
                                                <span class="text-info">
                                                    {{ $post->skills }}
                                                </span>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer py-2">
                                <div class="row">
                                    <div class="d-inline px-2">
                                        <span class="text-muted">
                                            <i class="fas fa-clock"></i> Apply Before:
                                            {{ date('d-m-Y',$post->deadlineTimestamp()) }} |
                                        </span>
                                    </div>
                                    <div class="d-inline">
                                        <span class="text-muted">
                                            {{ $post->term }} | 
                                        </span>
                                    </div>
                                    @if (is_null($post->min_salary) || is_null($post->max_salary))
                                        <div class="d-inline">
                                            <span class="text-muted px-2">
                                                Negotiable 
                                            </span>
                                        </div>
                                    @else
                                        <div class="d-inline px-2">
                                            <span class="text-muted">
                                                {{$post->min_salary}}$-{{ $post->max_salary }}$
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
        <div class="my-4 text-center small">
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
          </div>
    @else
        <p class="card-header">No Results</p>
        <div class="card-body bg-white text-center">
            <div class="card-text">
                <img src="images/search-not-found.png" alt="search-not-found-clip"/>
                <h4> No Jobs found <br />
                    <span class="text-muted font-size-12px">Please search for another keyword.</span>
                </h4>
            </div>
        </div>
    @endif
    </div>

</div>
</form>
@endsection

@push('css')
    <style scoped>
        .search-bar {
        background-color: #f5fdff;
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
@endpush