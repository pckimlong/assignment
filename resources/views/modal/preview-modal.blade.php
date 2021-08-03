<div class="modal fade" id="previewCvModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Resume Preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="wrapper mt-lg-6">

            <div class="sidebar-wrapper">
                <div class="profile-container">
                    <img class="profile" width = "180px" src="{{asset($jobseeker->avatar())}}" alt="" />
                    <h1 class="name">{{ $jobseeker->fullname() }}</h1>
                </div><!--//profile-container-->
                
                <div class="contact-container container-block">
                    <ul class="list-unstyled contact-list">
                      <li class="phone"><p> {{ $jobseeker->phone_number }}</p></li>
                        <li class="email"><p> {{ $jobseeker->login->email }}</p></li>
                        <li class="email"><p> {{ $jobseeker->current_address }}</p></li>
                    </ul>
                </div><!--//contact-container-->
                
                <div class="languages-container container-block">
                    <h2 class="container-block-title">Languages</h2>
                    <ul class="list-unstyled interests-list">
                        @foreach ($jobseeker->getLanguages() as $language)
                          <li>{{ $language }}</li>  
                        @endforeach
                    </ul>
                </div><!--//interests-->
                
                <div class="interests-container container-block">
                    <h2 class="container-block-title">Hobbies</h2>
                    <ul class="list-unstyled interests-list">
                      @foreach ($jobseeker->getHobbies() as $hobby)
                        <li>{{ $hobby }}</li>
                      @endforeach
                    </ul>
                </div><!--//interests-->
                
            </div><!--//sidebar-wrapper-->
            
            <div class="main-wrapper">
                
                <section class="section summary-section">
                    <h2 class="section-title"><span class="icon-holder"><i class="fas fa-user"></i></span>Personal Information</h2>
                    <div class="summary">
                    <table class="table table-borderless table-condensed">
                      <tbody>
                        <tr>
                          <td width="33%">Gender</td>
                          <td width="3%">:</td>
                          <td width="64%"><p> {{ $jobseeker->gender = 'M' ? 'Male' : 'Female' }}</p></td>
                        </tr>
                        <tr>
                          <td width="33%">Date of Birth</td>
                          <td width="3%">:</td>
                          <td width="64%"><p> {{ $jobseeker->birthdate }}</p></td>
                        </tr>
                        <tr>
                          <td width="33%">Marital Status</td>
                          <td width="3%">:</td>
                          <td width="64%"><p> {{ $jobseeker->marital_status }}</p></td>
                        </tr>
                        <tr>
                          <td width="33%">Nationality</td>
                          <td width="3%">:</td>
                          <td width="64%"><p> {{ $jobseeker->nationality }}</p></td>
                        </tr>
                      </tbody>
                    </table>
                    </div><!--//summary-->
                </section><!--//section-->
                
                <section class="section experiences-section">
                    <h2 class="section-title"><span class="icon-holder"><i class="fas fa-briefcase"></i></span>Experiences</h2>
                    @foreach ($jobseeker->experiences as $experience)
                    <div class="item">
                      <div class="meta">
                          <div class="upper-row">
                              <h3 class="job-title">{{ $experience->job_name ?? '' }}</h3>
                              <div class="time">{{ $experience->startYear() }} - {{ $experience->endYear() }}</div>
                          </div><!--//upper-row-->
                          <div class="company">{{ $experience->company ?? '' }}</div>
                      </div><!--//meta-->
                      <div class="details">
                          <p> {{ $experience->description ?? '' }}</p>  
                      </div><!--//details-->
                  </div>
                    @endforeach<!--//item--><!--//item-->
                    
                </section>
                
                <section class="section experiences-section">
                  <h2 class="section-title"><span class="icon-holder"><i class="fas fa-graduation-cap"></i></span>Education</h2>
                  @foreach ($jobseeker->educations as $education)
                  <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                            <h3 class="job-title">{{ $education->certification?? '' }} in {{ $education-> major ?? '' }}</h3>
                            <div class="time">{{ $education->startYear() }} - {{ $education->endYear() }}</div>
                        </div><!--//upper-row-->
                        <div class="company">{{ $education->school_name ?? '' }}</div>
                    </div><!--//meta-->
                    <div class="details">
                        <p> {{ $education->description ?? '' }}</p>  
                    </div><!--//details-->
                </div>
                  @endforeach<!--//item--><!--//item-->
                  
              </section><!--//section-->
                
                <section class="skills-section section">
                    <h2 class="section-title"><span class="icon-holder"><i class="fas fa-rocket"></i></span>Skills &amp; Proficiency</h2>
                    <div class="skillset">  
                      @foreach ($jobseeker->getSkills() as $skill)
                        <div class="item">
                          <h3 class="level-title">{{ $skill }}</h3>
                        </div>
                      @endforeach                                     
                        </div><!--//item--><!--//item-->
                    </div>  
                </section><!--//skills-section-->
                
            </div><!--//main-body-->
        </div>

        </div>
      </div>
    </div>
  </div>


  @push('css')
  <style>
 .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td {
    padding: 1px;
  }
 
 .wrapper {
   background: #185a91;
   max-width: 1000px;
   margin: 0 auto;
   position: relative;
   box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
 }
 
 .sidebar-wrapper {
   background: #185a91;
   position: absolute;
   right: 0;
   width: 260px;
   height: 100%;
   min-height: 800px;
   color: #fff;
 }
 .sidebar-wrapper a {
   color: #fff;
 }
 .sidebar-wrapper .profile-container {
   padding: 30px;
   background: rgba(0, 0, 0, 0.2);
   text-align: center;
   color: #fff;
 }
 .sidebar-wrapper .name {
   font-size: 28px;
   font-weight: 900;
   margin-top: 0;
   margin-bottom: 10px;
 }
 .sidebar-wrapper .tagline {
   color: rgba(255, 255, 255, 0.6);
   font-size: 16px;
   font-weight: 400;
   margin-top: 0;
   margin-bottom: 0;
 }
 .sidebar-wrapper .profile {
   margin-bottom: 15px;
 }
 .sidebar-wrapper .contact-list .svg-inline--fa {
   margin-right: 5px;
   font-size: 18px;
   vertical-align: middle;
 }
 .sidebar-wrapper .contact-list li {
   margin-bottom: 15px;
 }
 .sidebar-wrapper .contact-list li:last-child {
   margin-bottom: 0;
 }
 .sidebar-wrapper .contact-list .email .svg-inline--fa {
   font-size: 18px;
   text-transform: uppercase;
 }
 .sidebar-wrapper .container-block {
   padding: 30px;
 }
 .sidebar-wrapper .container-block-title {
   text-transform: uppercase;
   font-size: 16px;
   font-weight: 700;
   margin-top: 0;
   margin-bottom: 15px;
 }
 .sidebar-wrapper .degree {
   font-size: 14px;
   margin-top: 0;
   margin-bottom: 5px;
 }
 .sidebar-wrapper .education-container .item {
   margin-bottom: 15px;
 }
 .sidebar-wrapper .education-container .item:last-child {
   margin-bottom: 0;
 }
 .sidebar-wrapper .education-container .meta {
   color: rgba(255, 255, 255, 0.6);
   font-weight: 500;
   margin-bottom: 0px;
   margin-top: 0;
   font-size: 14px;
 }
 .sidebar-wrapper .education-container .time {
   color: rgba(255, 255, 255, 0.6);
   font-weight: 500;
   margin-bottom: 0px;
 }
 .sidebar-wrapper .languages-container .lang-desc {
   color: rgba(255, 255, 255, 0.6);
 }
 .sidebar-wrapper .languages-list {
   margin-bottom: 0;
 }
 .sidebar-wrapper .languages-list li {
   margin-bottom: 10px;
 }
 .sidebar-wrapper .languages-list li:last-child {
   margin-bottom: 0;
 }
 .sidebar-wrapper .interests-list {
   margin-bottom: 0;
 }
 .sidebar-wrapper .interests-list li {
   margin-bottom: 10px;
 }
 .sidebar-wrapper .interests-list li:last-child {
   margin-bottom: 0;
 }
 
 .main-wrapper {
   background: #fff;
   padding: 60px;
   padding-right: 300px;
 }
 .main-wrapper .section-title {
   text-transform: uppercase;
   font-size: 20px;
   font-weight: 500;
   color: #2d7788;
   position: relative;
   margin-top: 0;
   margin-bottom: 20px;
 }
 .main-wrapper .section-title .icon-holder {
   width: 30px;
   height: 30px;
   margin-right: 8px;
   display: inline-block;
   color: #fff;
   border-radius: 50%;
   -moz-background-clip: padding;
   -webkit-background-clip: padding-box;
   background-clip: padding-box;
   background: #2d7788;
   text-align: center;
   font-size: 16px;
   position: relative;
   top: -8px;
 }
 .main-wrapper .section-title .icon-holder .svg-inline--fa {
   font-size: 14px;
   margin-top: 6px;
 }
 .main-wrapper .section {
   margin-bottom: 60px;
 }
 .main-wrapper .experiences-section .item {
   margin-bottom: 30px;
 }
 .main-wrapper .upper-row {
   position: relative;
   overflow: hidden;
   margin-bottom: 2px;
 }
 .main-wrapper .job-title {
   color: #3F4650;
   font-size: 16px;
   margin-top: 0;
   margin-bottom: 0;
   font-weight: 500;
 }
 .main-wrapper .time {
   position: absolute;
   right: 0;
   top: 0;
   color: #97AAC3;
 }
 .main-wrapper .detail {
   position: absolute;
   right: 0;
   top: 0;
 }
 .main-wrapper .company {
   margin-bottom: 10px;
   color: #97AAC3;
 }
 .main-wrapper .project-title {
   font-size: 16px;
   font-weight: 400;
   margin-top: 0;
   margin-bottom: 5px;
 }
 .main-wrapper .projects-section .intro {
   margin-bottom: 30px;
 }
 .main-wrapper .projects-section .item {
   margin-bottom: 15px;
 }
 
 .skillset .item {
   margin-bottom: 15px;
   overflow: hidden;
 }
 .skillset .level-title {
   font-size: 14px;
   margin-top: 0;
   margin-bottom: 12px;
 }
 .skillset .level-bar {
   height: 12px;
   background: #f5f5f5;
   border-radius: 2px;
   -moz-background-clip: padding;
   -webkit-background-clip: padding-box;
   background-clip: padding-box;
 }
 .skillset .theme-progress-bar {
   background: #68bacd;
 }
 
 .footer {
   padding: 30px;
   padding-top: 60px;
 }
 .footer .copyright {
   line-height: 1.6;
   color: #545E6C;
   font-size: 13px;
 }
 .footer .fa-heart {
   color: #fb866a;
 }
 
 @media (max-width: 767.98px) {
   .sidebar-wrapper {
     position: static;
     width: inherit;
   }
 
   .main-wrapper {
     padding: 30px;
   }
 
   .main-wrapper .time {
     position: static;
     display: block;
     margin-top: 5px;
   }
   .main-wrapper .detail {
     position: static;
     display: block;
     margin-top: 5px;
   }
 
   .main-wrapper .upper-row {
     margin-bottom: 0;
   }
 }
 @media (min-width: 992px) {
   .skillset .level-title {
     display: inline-block;
     float: left;
     width: 30%;
     margin-bottom: 0;
   }
 }
</style>
  @endpush