<div class="modal fade" id="apply-job-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"> Apply for Job </h4>
                <button type="button" class="shadow-none close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                @if ($jobseeker)
                <form action = "{{ route('jobseeker.apply', ['jobId' => $jobId]) }}">
                    <div class="form-group">
                        <div class="col-md-14">
                            <div class="alert alert-primary">Your detail will send to company</div>
                      </div>
                        <div class="mx-2 text-primary d-flex flex-row-reverse font-weight-bold text-center float-left">
                            <a href="javascript:void(0)" id="showCv">Preview CV</a>
                        </div>
                        <button href="submit" class="btn primary-btn float-right"></i>Apply</button>
                      </div>
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
        @include('modal.preview-modal')
    </div>
</div> 
