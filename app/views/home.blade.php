@extends('layout.main')

@section('content')

@if(Auth::check())
	<p>Hello user {{Auth::user()->username}}</p>
@else
	<p> You are not login in</p>
@endif

<h3>Это Домашняя страница!</h3>
@stop