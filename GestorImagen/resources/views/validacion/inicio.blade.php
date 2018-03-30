@extends('app')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
				
			<div class="panel panel-default">
			<h1><center>Iniciar Sesión</center></h1>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> El usuario o la contraseña son incorrectos<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if (Session::has('csrf'))
						<div class="alert alert-danger">
							<strong>Whoops!</strong> El usuario o la contraseña son incorrectos<br><br>
							{{Session::get('csrf')}}
						</div>
					@endif
					@if (Session::has('recuperada'))
						<div class="alert alert-success">
							<strong>MUY BIEN!</strong> <br><br>
							{{Session::get('recuperada')}}
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/validacion/inicio') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Correo</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Contraseña</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Recordarme
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Iniciar Sesión</button>

								<a class="btn btn-link" href="{{ url('/validacion/recuperar') }}">Olvidé mi contraseña?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<body background="{{ asset('/images/estrella2.jpg') }}">
@endsection
