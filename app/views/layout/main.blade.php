<!doctype html>
<html lang="en">
<head>
    {{HTML::style('../vendor/bower_components/bootstrap/dist/css/bootstrap.css')}}
    {{HTML::style('../vendor/bower_components/font-awesome/css/font-awesome.css')}}



    <meta charset="UTF-8">
    <title>У тебя все получиться!</title>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			@if(Session::has('global') )
			    <span class="{{Session::get('class')}}">{{Session::get('global')}}</span>
			@endif
			    @include('layout.navigation')
			    @yield('content')
		 </div>
	</div>
</div>
</body>
{{HTML::script('../vendor/bower_components/jquery/dist/jquery.js')}}
{{HTML::script('../vendor/bower_components/bootstrap/dist/js/bootstrap.js')}}
</html>
