<div class="modal fade" id="applyJob_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Resume</h5>
          <button type="button" class="close shadow-none" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @if ($jobseeker)
            <form action = "{{ route('jobseeker.apply', ['jobId' => $jobId]) }}">
                {{-- <div class="form-group">
                      <div class="col-md-14">
                        <div class="row">
                          <div class="alert alert-primary">Your detail will send to company</div>
                          <button href="submit" class="btn primary-btn float-right"></i>Apply</button>
                        </div>
                    </div>
                  </div> --}}
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-10">
                        <div class="alert alert-primary">Your resume data will send to company</div>
                      </div>
                      <div class="col-md-2 mt-1">
                        <button href="submit" class="btn primary-btn float-right"></i>Apply Now</button>
                      </div>
                    </div>
                  </div>
                  @include('modal.cv-body', ['jobseeker'=>$jobseeker])
                </form>
                @else
                <div class="row px-3">
                    <div class="">
                        <a href="{{ route('login') }}" class="text-primary">You need to login first</i></a>
                    </div>
                </div>
            @endif
        </div>
      </div>
    </div>
  </div>

