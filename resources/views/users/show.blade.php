@extends('layouts.default')
@section('title',$user->name)

@section('content')

<div class="row">
    <div class="offset-md-2 col-md-8">
        <section class="user_info">
          @include('shared._user_info')
          <hr>
        </section>

	    @if (Auth::check())
	      @include('users._follow_form')
	    @endif
		@can('view', $user)
        <section>
	        @if($posts->count()>0)
	          <ul class="list-unstyled">
	          	 @foreach ($posts as $post)
	          	   @include('posts._post')
	          	 @endforeach
	          </ul>
	          <div class="mt-5">
	          	{!! $posts->render() !!}
	          </div>
	        @else
	        	<p>No data.</p>
	        @endif
	    </section>
	    @else
	    <div class="alert alert-secondary" role="alert">
  			This account is private.
		</div>
	    @endcan
    </div>
</div>

@endsection