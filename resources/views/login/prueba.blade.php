@extends('layout.plantillaFormularios')
@section('title', 'LoginPrueba')
@section('content')

<style>
	body {
		background-color: #4a4848;
		font-family: Montserrat;
		display: flex;
		justify-content: center;
		align-items: center;
	}
</style>

<div class="container align-middle shadow align-items-center" style="background-color:white; border-radius: 25px;">
	<div class="row">
		<div class="col text-center" style="background:#dfc14e;border-top-left-radius: 25px 25px; border-bottom-left-radius: 25px 25px; ">
			<div class="align-content-center">
				<img src="public/assets/images/Escudo.png" width="300" alt="">
			</div>
		<br>
		<div class="text-center text-white">
			<h6> Universidad Iberoamericana</h6>	
			<h6> Todos los derechos reservados </h6>
		</div>
		</div>
		<div class="col">
			<h2 class="fw-light text-center"> Sistema de proyeccion Ibero</h2>

			<form action="#">
				<div class="mb-4">
					<label for="email" class="form-label"> Email</label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="mb-4">
					<label for="password" class="form-label"> Contraseña</label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-warning fw-bold text-white"><strong>Iniciar sesión</strong></button>
				</div>
				<br>
				<br>
				<div class="my-10 text-center">
					<span> <u><a href="#">Recuperar Contraseña</a></u></span>
				</div>
			</form>

		</div>
	</div>

</div>



</body>

@endsection