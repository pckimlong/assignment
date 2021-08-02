@extends('layouts.job')
@section('content')

<div class="card search-bar mt-2 mb-2 px-0 py-4">
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
                <button class="btn btn-success pt-1" @click="searchByTitle">
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
              >By Organisation
            </router-link>
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
                <div class="card-title mb-1">Job Categories</div>
                <div class="card-body p-0">
                  <div class="form-group">
                    <select
                      name="job_category"
                      class="form-control"
                      placeholder="Filter by Job Category"
                      @change="filterCategory($event)"
                    >
                      <option disabled selected value>
                        -- select an option --
                      </option>
                      <option
                        v-for="category in categories"
                        :value="category.id"
                        :key="category.id"
                      >
                        {{-- {{ category.category_name }} --}}
                      </option>
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
                      name="job_category"
                      class="form-control"
                      placeholder="Filter by Job Category"
                      @change="filterJobLevel($event)"
                    >
                      <option disabled selected value>
                        -- select an option --
                      </option>
                      <option value="Senior level">Senior level</option>
                      <option value="Mid level">Mid level</option>
                      <option value="Top level">Top level</option>
                      <option value="Entry level">Entry level</option>
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-3" />
              <div class="pb-0">
                <div class="card-title mb-1">Eductation</div>
                <div class="card-body p-0">
                  <div class="form-group">
                    <select
                      name="job_category"
                      class="form-control"
                      placeholder="Filter by Job Category"
                      @change="filterEducation($event)"
                    >
                      <option disabled selected value>
                        -- select an option --
                      </option>
                      <option value="Bachelors">Bachelors</option>
                      <option value="High School">High School</option>
                      <option value="Master">Master</option>
                      <option value="SEE Mid School">SEE Mid School</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-3"/>
              <div class="pb-0">
                <div class="card-title mb-1">
                    Employment Type
                </div>
                <div class="card-body p-0">
                  <div class="form-group">
                    <select
                      name="job_category"
                      class="form-control"
                      placeholder="Filter by Job Category"
                      @change="filterEmploymentType($event)"
                    >
                      <option disabled selected value>
                        -- select an option --
                      </option>
                      <option value="Full Time">Full Time</option>
                      <option value="Part Time">Part Time</option>
                      <option value="Freelance">Freelance</option>
                      <option value="Internship">Internship</option>
                      <option value="Trainneship">Trainneship</option>
                      <option value="Volunter">Volunter</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="col-sm-12 col-md-7 col-xl-8">
    @if ($posts)
        <div class="card">
            <div class="search-result">


                <div class=" mt-md-0 mt-3">
                    <div class="card-body row p-3">
                        <div class="col-6">
                            <h1 class="h6" id="job-count">
                                Showing 1 - 20 job of 200
                            </h1>
                        </div>
                        <div class="col-6">
                            <ul class="nav nav-inline float-right">
                                <li class="nav-item mr-3">
                                  <a href="#" class="text-secondary">
                                    <span class="icon-calendar"></span>
                                    Posted: <span id="date_val"> All time </span>
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
                                                <a href="{{route('post.show',['job'=>$post->id])}}">
                                                    {{ $post->job_title }}
                                                </a>
                                            </h5>
                                            <h6 class = "mt-2">
                                                <a href="{{route('company',['id'=>$post->company->id])}}">
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
                                        <div class="d-inline">
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
            <div class="d-block py-2 text-muted">
              10 Total Jobs found with matching search
            </div>
            <div class="d-flex justify-content-center">
              <pagination
                class="custom-pagination"
                :data="posts"
                @pagination-change-page="getJobs"
              ></pagination>
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
@endsection

@push('css')
    <style scoped>
        .search-bar {
        background-color: #f5fdff;
        }
    </style>
@endpush