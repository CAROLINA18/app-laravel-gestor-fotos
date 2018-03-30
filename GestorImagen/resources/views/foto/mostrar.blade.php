@extends('app')

@section('content')
@if (Session::has('creado'))
	<div class="alert alert-success">
	<p>La foto ha sido creada</p>
	</div>
@endif
@if (Session::has('editada'))
	<div class="alert alert-success">
	<p>La foto ha sido editada</p>
	</div>
@endif
@if (Session::has('eliminada'))
	<div class="alert alert-danger">
	<p>La foto ha sido eliminada</p>
	</div>
@endif

<center><a href="/validado/fotos/crear-foto?id={{$id}}" class="btn btn-primary" role="button">Crear Foto</a></center>
<br>
@if(sizeof($foto) > 0)
	@foreach($foto as $foto)
		<div class="column">
		  <div class="col-sm-6 col-md-4">
		    <div class="thumbnail">
		    	<center><h3>{{$foto->nombre}}</h3></center>
		    	<img src="{{$foto->ruta}}"  height="400">
		      <div class="caption">
		        
		        <h4>{{$foto->descripcion}}</h4>
		      </div>
		       <div class="btn-group"><a href="/validado/fotos/actualizar-foto/{{$foto->id}}" class="btn btn-primary" role="button">Editar Foto</a>
		    &nbsp;&nbsp;<form action="/validado/fotos/eliminar-foto" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}" required>
					<input type="hidden" name="id" value="{{$foto->id}}" required>
					<input class="btn btn-danger" role="button" type="submit" value="Eliminar"/>
				</form>
		    </div></div>
		  </div>
		</div>
	@endforeach
@else
<div class="alert alert-danger">
	<p>Al parecer no tiene Fotos. Crea una.</p>
</div>
@endif

@endsection
