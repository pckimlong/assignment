<div class="account-nav">
  <ul class="list-group">
    @auth('company')
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'overview' ? 'active': ''}}">
      <a href="{{route('company.overview')}}" class="account-nav-link">
        <i class="fas fa-chart-line"></i> Overview
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'info' ? 'active': ''}}">
      <a href="{{route('company.info')}}" class="account-nav-link">
        <i class="fas fa-info-circle"></i> Information
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'upload' ? 'active': ''}}">
      <a href="{{route('company.upload')}}" class="account-nav-link">
        <i class="fas fa-upload"></i> Upload a Job
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'post' && request()->segment(3) == 'create' ? 'active': ''}}">
      {{-- <a href="{{route('post.create')}}" class="account-nav-link"> --}}
        <i class="fas fa-list"></i> Jobs List
    </li> 
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'password' ? 'active': ''}}">
      <a href="{{route('company.change.password')}}" class="account-nav-link">
        <i class="fas fa-fingerprint"></i> Change Password
      </a>
    </li> 
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'home' ? 'active': ''}}">
      {{-- <a href="{{route('jobApplication.index')}}" class="account-nav-link"> --}}
        <i class="fas fa-bell"></i> Job Applications
    </li>
    @endauth


    @auth('jobseeker')
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'overview' ? 'active': ''}}">
      <a href="{{route('jobseeker.overview')}}" class="account-nav-link">
        <i class="fas fa-user-shield"></i> Account
      </a>
    </li>
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'cv' ? 'active': ''}}">
      <a href="{{route('jobseeker.cv')}}" class="account-nav-link">
        <i class="far fa-id-card"></i> CV
      </a>
    </li>
    
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'password' ? 'active': ''}}">
      <a href="{{route('jobseeker.change.password')}}" class="account-nav-link">
        <i class="fas fa-fingerprint"></i> Change Password
      </a>
    </li>    
    <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'saved-jobs' ? 'active': ''}}">
      <a href="{{route('jobseeker.saved-job')}}" class="account-nav-link">
        <i class="fas fa-stream"></i> My saved Jobs
      </a>
    </li>   
     <li class="list-group-item list-group-item-action {{ request()->segment(2) == 'deativate' ? 'active': ''}}">
      <a href="{{route('jobseeker.deativate')}}" class="account-nav-link">
        <i class="fas fa-folder-minus"></i> Deactivate Account
      </a>
    </li>   
    @endauth 
  </ul>
</div>