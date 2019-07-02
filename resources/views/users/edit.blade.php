@extends('layouts.default')
@section('title', 'Update User Info')

@section('content')
  <p class="alert alert-success" style="display: none;">
    
  </p>
<div class="offset-md-2 col-md-8">
  <div class="card ">
    <div class="card-header">
      <h5>Update User Info</h5>
    </div>
      <div class="card-body">

        @include('shared._errors')

        <div class="gravatar_edit d-flex justify-content-center">
          <a href="http://gravatar.com/emails" target="_blank">
            <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar"/>
          </a>
        </div>

        <form method="POST" action="{{ route('users.update', $user->id )}}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            <div class="form-group">
              <label for="name">Name: </label>
              <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="form-group">
              <label for="email">Email: </label>
              <input type="text" name="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>

            <div class="form-group">
              <label for="password">Password: </label>
              <input type="password" name="password" class="form-control" value="{{ old('password') }}">
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm Password: </label>
              <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
            </div>
            <p>Private account: </p>
            <label class="switch mb-3">
              <input id="private_switch" type="checkbox" {{ $user->is_public ? '' : 'checked'}}>
              <span class="slider round"></span>
            </label><br>
            <button type="submit" class="btn btn-primary">Update</button>
            <input type="hidden" class="user_id" value="{{$user->id}}">
        </form>
    </div>
  </div>
</div>


<script>
    $('#private_switch').on('click',function(){
      let isChecked = $('#private_switch').is(':checked') ? 0 : 1;
      let user_id = $('.user_id').val();
      $.ajax({
        headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: "/users/private_switch/" + user_id,
        type: 'POST',
        data: { 
          'isChecked': isChecked,
        },
        success:function(data){

          let status = isChecked ? 'public.' : 'private.';
          $('.alert').show(300).delay(3000).hide(300);
          $('.alert').text('You have changed the account status to ' + status)
        }
      });
    });
</script>

@endsection