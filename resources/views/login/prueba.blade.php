@extends('layout.plantillaFormularios')
@section('title', 'LoginPrueba')
@section('content')

<style>

body {
  background-color: #4a4848;
  font-family: Montserrat;
}

.bg{
	background-image: url('public/assets/images/Escudo.png');
	background-position: center center;
}

</style>

<div class="container w-60 mt-5 rounded shadow" style="background-color:white;">
	<div class="row">
		<div class="col" style="background:#dfc14e;">
		<div class="align-content-center">
			<img src="public/assets/images/Escudo.png" width="300"alt="">
		</div>
		</div>
		<div class="col">
			<h2 class="fw-light"> Sistema de proyeccion Ibero</h2>
		
			<form action="#">
				<div class="mb-4">
					<label for="email" class="form-label"> Email</label>
					<input type="email" class= "form-control" name="email">
				</div>
				<div class="mb-4">
					<label for="password" class="form-label"> Contraseña</label>
					<input type="password" class= "form-control" name="password">
				</div>
				<div>
					<button type="submit" class="btn btn-warning text-white"> Iniciar sesión</button>
				</div>
				<div class="my-10">
					<span> <u><a href="#">Recuperar Contraseña</a></u></span>
				</div>
			</form>
		
		
		</div>
	</div>
</div>



</body>

@endsection
