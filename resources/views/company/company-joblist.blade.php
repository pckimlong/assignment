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
                  <td><form action="" method="POST">
                    @csrf
                    @method("delete")
                    <button type="submit" href="#" class="btn secondary-outline-btn">Unsave</button>
                  </form></td>
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
      </div>
    </div>
  </div>
@endSection