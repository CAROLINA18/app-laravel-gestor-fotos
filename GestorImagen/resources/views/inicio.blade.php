@extends('app')

@section('content')
@if (Session::has('error'))
	<div class="alert alert-danger">
	<strong>Whoops!</strong> El usuario o la contraseña son incorrectos<br><br>
	{{Session::get('error')}}
	</div>
@endif

<body background ="{{ asset('/images/flor2.jpg') }}">

					<div class="texto-bienvenido">

					Bienvenid@ {{Auth::user()->nombre}}</div>
					
	
@endsection
