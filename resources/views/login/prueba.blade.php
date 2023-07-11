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
		<div class="col text-center mt-5" style="background:#dfc14e;border-top-left-radius: 25px 25px; border-bottom-left-radius: 25px 25px; ">
			<div class="align-content-center">
				<img src="public/assets/images/Escudo.png" width="300" alt="">
			</div>
		<br>
		<div class="text-center text-white mb-5">
			<h6> <strong>Universidad Iberoamericana</strong></h6>	
			<h6> </strong>©Todos los derechos reservados </strong></h6>
		</div>
		</div>
		<div class="col">
			<h2 class="fw-bold text-center mb-5 mt-5"> Sistema de proyeccion Ibero</h2>

			<form action="#">
				<div class="mb-5 col-10">
					
					<input type="email" class="form-control" name="email" placeholder="Usuario">
				</div>
				<div class="mb-5 col-10">
					
					<input type="password" class="form-control" name="password" placeholder="Contraseña">
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-warning fw-bold text-white"><strong>Iniciar sesión</strong></button>
				</div>
				<br><br><br>
				<div class="my-10 text-center mb-5">
					<span><u><a href="#"><strong>Recuperar Contraseña</strong></a></u></span>
				</div>
			</form>

		</div>
	</div>

</div>



</body>

@endsection