@extends('layouts.default')

@section('content')
  @if(Auth::check())

<div class="row">
  <div class="col-md-8">
    <section>
      @include('shared._post_form')
    </section>
    <h4>Posts List</h4>
    <hr>
    @include('shared._feed')
  </div>
  <aside class="col-md-4">
     @include('shared._user_info', ['user' => Auth::user()])
  </aside>
</div>

  @else

  <div class="jumbotron">
    <h1>Hello Laravel</h1>
    <p class="lead">
      This is home page
    </p>
    <p>
      Starts from here
    </p>
    <p>
      <a class="btn btn-lg btn-success" href="{{ route('signup' )}}" role="button">Register Now</a>
    </p>
  </div>

  @endif
@endsection