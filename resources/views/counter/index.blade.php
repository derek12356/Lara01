@extends('layouts.default')
@section('title','API test')
@section('content')
	<p class="p-5">The website has been viewed: {{ $counts->counts }} times. <br>Last visited: {{ $counts->updated }}</p>
@endsection