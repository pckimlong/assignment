@extends('layouts.company-account')

@section('content')
<div class="account-layout border">
    <div class="account-hdr border bg-primary text-white shadow">
      Jobs list
    </div>
    <div class="account-bdy p-3">
      <div class="my-2">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead class="bg-light small">
              <tr>
                <th>Status</th>
                <th>Job Position</th>
                <th>Hire Amount</th>
                <th>Candidates</th>
                <th>Deadline</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                @if($posts->count() >0)
                <tr>
                  @if ($post->is_active)
                  <td >Active</td>
                  @else
                  <td class = 'text-muted'>Closed</td>
                  @endif
                  <td class = "{{ ($post->is_active)? '': 'text-muted' }}" ><a href="{{route('post.show',['job'=>$post])}}">{{$post->job_title}}</a></td>
                  <td class = "{{ ($post->is_active)? '': 'text-muted' }}" >{{$post->hire_amount}}</td>
                  <td class = "{{ ($post->is_active)? '': 'text-muted' }}" >{{$post->activities()->count()}}</td>
                  <td class = "{{ ($post->is_active)? '': 'text-muted' }}" >{{date('d/m/Y',$post->deadlineTimestamp())}}, {{date('d',$post->remainingDays()) }} days</td>
                  <td>
                    {{-- <a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a> --}}
                    <a data-id ="{{ $post->id }}" id="editPost" data-toggle="modal" data-target='#editJobModal' class="edit btn btn-primary btn-sm" data-toggle="modal">Edit</a>
                    <a data-postid ="{{ $post->id }}" class="edit btn btn-danger btn-sm deleteJob" data-toggle="modal">Delete</a>
                  </td>
                </tr>
                @else
                <tr>
                  <td>You have no jobs saved.</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-center mt-4 custom-pagination">
          {{ $posts->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this post?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-danger"> This will permenently delete from database!</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <form action="{{route('company.job.deleteJob')}}" method="POST" class="d-inline-block">
            <input type="hidden", name="jobpost_id" id="app_id">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Yes sure! delete it!</button>
          </form>
          
        </div>
      </div>
    </div>
  </div>
@include('modal.edit-job')
@endSection

@push('js')
  <script>
     $(document).on('click', '.deleteJob', function() {
        var postid = $(this).attr('data-postid');
        $('#app_id').val(postid);
        $('#deletePostModal').modal('show');
    });
  </script>
@endpush

@push('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>

$(document).ready(function () {

$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

$('#editPost').click(function (event) {
    event.preventDefault();
    var id = $(this).data('id');
    
    console.log(id)
    $.get('/company/post/' + id, function (data) {
      
      if(data.data.is_active)
        document.getElementById('is_active').checked = true;
      else
        document.getElementById('is_active').checked = false;
        //variable
        $('#id').val(id);
        $('#job_title').val(data.data.job_title);
        $('#company_id').val(data.data.company_id);
        $('#deadline').val(data.data.deadline);
        $('#job_level').val(data.data.job_level);
        $('#term').val(data.data.term);
        $('#job_location').val(data.data.job_location);
        $('#min_age').val(data.data.min_age);
        $('#max_age').val(data.data.max_age);
        $('#sex').val(data.data.sex);
        $('#languages').val(data.data.languages);
        $('#min_salary').val(data.data.min_salary);
        $('#max_salary').val(data.data.max_salary);
        $('#hire_amount').val(data.data.hire_amount);
        $('#skills').val(data.data.skills);
        $('#qualification').val(data.data.qualification);
        $('#year_of_experience').val(data.data.year_of_experience);
        $('#specifications').val(data.data.specifications);
     })
  });
}); 
</script>
@endpush