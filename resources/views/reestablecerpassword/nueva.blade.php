@extends('layout.plantillaFormularios')
@section('title', 'Nueva Contrasena')
@section('content')


<div class="limiter">
    <div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-01.jpg')}});">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <!--Formulario para recuperar de contraseña-->
            <form action="{{Route('cambio.actualizar')}}" method="post" class="login100-form validate-form" id="miForm">
                @csrf
                <span class="login100-form-title p-b-49">
                    Recuperar contraseña
                </span>
                <input type="hidden" name="id" value="{{ $id }}">
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

                @if(\Session::get('error'))
                <div class="alert alert-primary text-center" style="color: black;" role="alert">
                    {{\Session::get('error')}}
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


@endsection