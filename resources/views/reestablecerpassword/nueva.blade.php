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
                <input type="hidden" name="id" value="{{ $id }}">
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

@if($errors->any())
<script>
    Swal.fire("Error", "{{ $errors->first() }}", "error");
</script>
@endif

@endsection

