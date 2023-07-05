@extends('layout.plantillaFormularios')
@section('title', 'Login')
@section('content')
	<div class="limiter">
		<div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-02.jpg')}});">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" id="miform" action="{{ route('login.login') }}" method="POST">
					@csrf
                    <span class="login100-form-title p-b-49">
						Sistema de Proyección Ibero
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Usuario es requerido">
						<span class="label-input100">Correo</span>
						<input class="input100" type="text" name="email" placeholder="Ingresa tu usuario" id="mail">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-23" data-validate="Contraseña es requerida">
						<span class="label-input100">Contraseña</span>
						<br>
						<input class="input100" type="password" name="password" placeholder="Ingresa tu contraseña" id="pass">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
					
					<br>
					<div class="justify-content-center text-center">
						<a href="{{ route('cambio.index') }}" class="link-primary">¿Olvidaste tu contraseña?</a>
					</div>

					<div class="txt1 text-center p-t-54 p-b-20">
						<h4> Universidad Iberoamericana</h4>
                  		<p>©2023 Todos los derechos reservados.</p>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

</body>

@endsection
