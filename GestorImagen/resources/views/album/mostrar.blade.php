@extends('app')

@section('content')
@if (Session::has('creado'))
	<div class="alert alert-success">
	<p>El album ha sido creado</p>
	</div>
@endif
@if (Session::has('actualizado'))
	<div class="alert alert-success">
	<p>El album ha sido creado</p>
	</div>
@endif
@if (Session::has('eliminado'))
	<div class="alert alert-danger">
	<p>El album ha sido eliminado</p>
	</div>
@endif

<center><a href="/validado/albums/crear-album" class="btn btn-primary" role="button">Crear Álbum</a></center><br>
@if(sizeof($album) > 0)
	@foreach($album as $albums)
		<div class="column">
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">

		      <div class="caption">
		      	
		        <h3><center>{{$albums->nombre}}</center></h3>
		        <img src="{{ asset('/images/album.jpg') }}" width="400">
		        <h4>{{$albums->descripcion}}</h4>
		        <div class="btn-group">
		        <a href="/validado/fotos?id={{$albums->id}}" class="btn btn-primary" role="button">Ver fotos</a>&nbsp;&nbsp;
		        <a href="/validado/albums/actualizar-album/{{$albums->id}}" class="btn btn-primary" role="button">Editar Album</a>&nbsp;&nbsp;
		      	 <form action="/validado/albums/eliminar-album" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" required>
					<input type="hidden" name="id" value="{{$albums->id}}" required>
					<input class="btn btn-danger" role="button" type="submit" value="Eliminar"/>
				</form>
			</div>
		      </div>
		    </div>
		  </div>
		</div>
	@endforeach
@else
<div class="alert alert-danger">
	<p>Al parecer no tiene álbumes. Crea uno.</p>
</div>
@endif
@endsection
