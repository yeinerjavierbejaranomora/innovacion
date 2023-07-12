@extends('layout.plantillaFormularios')
@section('title', 'Nueva Contrasena')
@section('content')

<style>
	#recuperar {
    background-color: #dfc14e;
    border-color: #dfc14e;
    width: 250px;
    padding: 10px 30px;
    border-radius: 10px;
}
</style>

<div class="container align-middle shadow-lg rounded" >
	<div class="row" style="background-color:white;border-radius: 35px; box-shadow: 0 0 10px rgba(0, 0, 0, 5);">
		<div class="col text-center" style="background:#dfc14e;border-top-left-radius: 35px 35px; border-bottom-left-radius: 35px 35px; ">
			<br><br>
			<div class="align-content-center">
				<img src="../public/assets/images/Escudo.png" width="350" alt="">
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

			<h2 class="text-center mb-5" style="font-weight: 800;"> Recuperar contraseña </h2>

			<form action="{{Route('cambio.actualizar')}}" method="POST" class="align-content-center">
			@csrf
				<div class="mb-5 col-10 mx-auto">
					<input type="password" class="form-control custom-input" name="nueva" id="nueva" placeholder="Contraseña nueva" required>
					<span class="input-border"></span>
				</div>
				<div class="form-group mb-5 col-10 mx-auto ">
					<input type="password" class="form-control custom-input" name="confirmar" id="confirmar" placeholder="Confirmar contraseña"  required>
					<span class="input-border"></span>
				</div>

				<div class="form-group text-center">
					<button type="submit" style="font-weight: 600;" class="btn btn-warning text-white" id="recuperar">Recuperar contraseña</button>
				</div>
                @if(\Session::get('Error'))
                <div class="alert alert-primary text-center" style="color: black;" role="alert">
                    {{\Session::get('Error')}}
                </div>
                @endif
				<br><br><br>
				
			</form>

		</div>
	</div>

</div>


@endsection

<!--
<div class="limiter">
    <div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-02.jpg')}});">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <!--Formulario para recuperar de contraseña
            <form action="{{Route('cambio.actualizar')}}" method="post" class="login100-form validate-form" id="miForm">
                @csrf
                <span class="login100-form-title p-b-49">
                    Recuperar contraseña
                </span>
                
                <div class="wrap-input100 validate-input m-b-23" data-validate="Contraseña nueva es requerida">
                    <span class="label-input100">Contraseña nueva</span>
                    <input class="input100" type="password" name="nueva" placeholder="Contraseña nueva" id="nueva">
                    <span class="focus-input100" data-symbol="&#xf183;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Confirmar es requerido">
                    <span class="label-input100">Confirmar contraseña</span>
                    <input class="input100" type="password" name="confirmar" placeholder="Confirmar contraseña" id="confirmar">
                    <span class="focus-input100" data-symbol="&#xf183;"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            Recuperar contraseña
                        </button>
                    </div>
                </div>

                @if(\Session::get('Error'))
                <div class="alert alert-primary text-center" style="color: black;" role="alert">
                    {{\Session::get('Error')}}
                </div>
                @endif
                
                <div class="txt1 text-center p-t-54 p-b-20">
                    <h4> Universidad Iberoamericana</h4>
                    <p>©2023 Todos los derechos reservados.</p>
                </div>
            </form>
        </div>
    </div>
</div>
-->
