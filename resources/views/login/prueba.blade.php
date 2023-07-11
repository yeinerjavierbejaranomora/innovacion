@extends('layout.plantillaFormularios')
@section('title', 'LoginPrueba')
@section('content')

<style>
	body {
		background-color: #4a4848;
		font-family: Montserrat;
	}

	.container {
		margin-top: 200px;
	}
	
</style>

<div class="container w-75 align-middle shadow" style="background-color:white; border-radius: 25px;">
	
		<div class="row">
			<div class="col text-center" style="background:#dfc14e;border-top-left-radius: 25px 25px; border-bottom-left-radius: 25px 25px; ">
				<div class="align-content-center">
					<img src="public/assets/images/Escudo.png" width="300" alt="">
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