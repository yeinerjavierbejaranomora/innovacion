@extends('layout.plantillaFormularios')
@section('title', 'Login')
@section('content')

<div class="container align-middle shadow-lg rounded" >
	<div class="row" style="background-color:white;border-radius: 35px; box-shadow: 0 0 10px rgba(0, 0, 0, 5);">
		<div class="col text-center" style="background:#dfc14e;border-top-left-radius: 35px 35px; border-bottom-left-radius: 35px 35px; ">
			<br><br>
			<div class="align-content-center">
				<img src="public/assets/images/Escudo.png" width="350" alt="">
			</div>
			<br>
			<br>
			<br>
			<div class="text-center text-white mb-5">
				<h6 style="font-weight: 300;">Universidad Iberoamericana</h6>
				<h6 style="font-weight: 300;">©2023 Todos los derechos reservados</h6>
			</div>
		</div>
		<div class="col" id="colmder" style="border-top-right-radius: 35px 35px; border-bottom-right-radius: 35px 35px;">
			<br>
			<div class="rectangle"></div>
			<br>

			<h2 class="text-center mb-5" style="font-weight: 800;"> Sistema de <br> Proyección Ibero</h2>

			<form action="{{ route('login.login') }}" method="POST" class="align-content-center">
			@csrf
				<div class="mb-5 col-10 mx-auto">
					<input type="email" class="form-control custom-input" name="email" placeholder="Usuario" required>
					<span class="input-border"></span>
				</div>
				<div class="form-group mb-5 col-10 mx-auto ">
					<input type="password" class="form-control custom-input" name="password" placeholder="Contraseña" required>
					<span class="input-border"></span>
				</div>
				<div class="form-group text-center">
					<button type="submit" style="font-weight: 600;" class="btn btn-warning text-white" id="btn">Login</button>
				</div>
				<br><br><br>
				<div class="my-10 text-center mb-5">
					<span><u><a href="{{ route('cambio.index') }}" style="font-weight: 600;">¿Olvidaste tu Contraseña?</a></u></span>
				</div>
			</form>

		</div>
	</div>

</div>

<div id="dropDownSelect1"></div>


</body>

@endsection