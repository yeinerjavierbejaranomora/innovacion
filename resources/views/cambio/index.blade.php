@extends('layout.plantillaFormularios')
@section('title', 'Cambio Contraseña')
@section('content')


<div class="limiter">
    <div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-01.jpg')}});">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form action="" method="post" class="login100-form validate-form" id="miform">
                @csrf
                <span class="login100-form-title p-b-49">
                    Recuperar contraseña
                </span>

                <div class="wrap-input100 validate-input m-b-23" data-validate="idBanner es requerido">
                    <span class="label-input100">ID Banner</span>
                    <input class="input100" type="number" name="idbanner" placeholder="ID Banner" id="idbanner">
                    <span class="focus-input100" data-symbol="&#xf205;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="documento es requerido">
                    <span class="label-input100">Documento de identidad</span>
                    <input class="input100" type="text" name="documento" placeholder="Documento de identidad" id="documento">
                    <span class="focus-input100" data-symbol="&#xf20b;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="correo es requerido">
                    <span class="label-input100">Correo electronico</span>
                    <input class="input100" type="email" name="correo" placeholder="Correo electronco" id="correo">
                    <span class="focus-input100" data-symbol="&#xf15a;"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">
                            Consultar
                        </button>
                    </div>
                </div>

                <div class="txt1 text-center p-t-54 p-b-20">
                    <h4> Universidad Iberoamericana</h4>
                    <p>©2023 Todos los derechos reservados.</p>
                </div>
            </form>
        </div>
    </div>
</div>


<?php if (session('consultaFallida') == 'Usuario no encontrado') ?>
<script> alert('Usuario no encontrado en la base de datos') </script>

@endsection
