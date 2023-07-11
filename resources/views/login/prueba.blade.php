@extends('layout.plantillaFormularios')
@section('title', 'LoginPrueba')
@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

<style>
	body {
		background-color: #4a4848;
		font-family: "Montserrat", sans-serif;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.form-control {
		font-size: 20px;
	}

	.form-control::placeholder {
		font-weight: bold;
		font-size: 20px;
	}

	#btn {
		background-color: #dfc14e;
		border-color: #dfc14e;
		width: 150px;
		padding: 10px 30px;
		border-radius: 10px;
	}

	#btn ::hover {
		background-color: #d0ab4b;
	}
</style>

<div class="container align-middle shadow align-items-center" style="background-color:white; border-radius: 25px;">
	<div class="row">
		<div class="col text-center" style="background:#dfc14e;border-top-left-radius: 25px 25px; border-bottom-left-radius: 25px 25px; ">
			<br><br>
			<div class="align-content-center">
				<img src="public/assets/images/Escudo.png" width="300" alt="">
			</div>
			<br>
			<div class="text-center text-white mb-5">
				<h6 style="font-weight: 300;">Universidad Iberoamericana</h6>
				<h6 style="font-weight: 300;">©2023 Todos los derechos reservados</h6>
			</div>
		</div>
		<div class="col">
			<br><br>
			<h2 class="text-center mb-5" style="font-weight: 500;"> Sistema de <br> Proyección Ibero</h2>

			<form action="#" class="align-content-center">
				<div class="mb-5 col-10 mx-auto">
					<input type="email" class="form-control" name="email" placeholder="Usuario">
				</div>
				<div class="mb-5 col-10 mx-auto">
					<input type="password" class="form-control" name="password" placeholder="Contraseña">
				</div>
				<div class="text-center">
					<button type="submit" style="font-weight: 600;" class="btn btn-warning text-white" id="btn">Login</button>
				</div>
				<br><br><br>
				<div class="my-10 text-center mb-5">
					<span ><u><a href="#" style="font-weight: 600;">¿Olvidaste tu Contraseña?</a></u></span>
				</div>
			</form>

		</div>
	</div>

</div>



</body>

@endsection