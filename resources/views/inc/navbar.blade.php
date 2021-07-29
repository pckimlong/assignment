<nav class="navbar navbar-expand-md navbar-white bg-white border-bottom sticky-top" id="navbar">
  <div class="container">
  <a href="{{URL('/')}}" class="navbar-brand">
      JobPosting
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @auth('jobseeker')
        <li class="nav-item dropdown dropdown-left"> 
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::guard('jobseeker')->user()->jobseeker->fullname() }}</span> 
            <img class="img-profile rounded-circle" src="{{asset('images/user-profile.png')}}" width="40px"> 
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown"> 
            <a class="dropdown-item" href = "{{ route('jobseeker.overview') }}"> <i class="fas fa-user fa-sm "></i> Profile </a> 
            <a class="dropdown-item" href = ""> <i class="fas fa-key fa-sm "></i> Change Password </a> 
              <div class="dropdown-divider"></div> 
              <a class="dropdown-item" href="/logout/jobseeker"> 
                <i class="fas fa-sign-out-alt"></i> 
                Logout 
              </a>
          </div>
        </li>
        @endauth

        @if (!auth('jobseeker')->check() && !auth('company')->check())
        <a href="{{ route('login') }}" class="btn primary-btn">Sign up or Log in</a>
        @endif
        @if (auth('company')->check())
        <div class="col-sm-6">
            <a href="/logout/company" class="btn btn-outline-dark">Logout</a>
        </div>
        @endif
      </ul>
    </div>
  </div>
 
</nav>