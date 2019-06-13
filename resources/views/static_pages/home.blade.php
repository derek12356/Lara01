@extends('layouts.default')

@section('content')
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
@stop