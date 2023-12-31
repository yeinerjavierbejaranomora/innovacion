@extends('layout.plantillaFormularios')
@section('title', 'Cambio Contraseña')
@section('content')



<div class="container align-middle shadow-lg rounded">
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

            <h2 class="text-center mb-5" style="font-weight: 800;"> Recuperar contraseña </h2>

            <form action="{{Route('cambio.consultar')}}" method="POST" class="align-content-center">
                @csrf
                <div class="mb-5 col-10 mx-auto">
                    <input type="number" class="form-control custom-input" name="idbanner" id="idbanner" placeholder="ID Banner" required>
                    <span class="input-border"></span>
                </div>
                <div class="form-group mb-5 col-10 mx-auto ">
                    <input type="number" class="form-control custom-input" name="documento" placeholder="Documento de identidad" id="documento" required>
                    <span class="input-border"></span>
                </div>
                <div class="form-group mb-5 col-10 mx-auto ">
                    <input type="email" class="form-control custom-input" name="correo" placeholder="Correo electronco" id="correo" required>
                    <span class="input-border"></span>
                </div>

                <div class="form-group text-center">
                    <button type="submit" style="font-weight: 600;" class="btn btn-warning text-white" id="btn">Consultar</button>
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


<!-- 
<div class="limiter">
    <div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-02.jpg')}});">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form action="{{Route('cambio.consultar')}}" method="post" class="login100-form validate-form" id="miform">
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
                <br>
                
                <!-- *Div que muestra un error en caso de que exista* 
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

-->
<!--
    Sweet alert
    @if(\Session::get('error'))
    <script>
        function validacion() {
            $("#miform").submit(function(e) {
                Swal.fire({
                    icon: 'error',
                title: 'Oops...',
                text: 'Usuario no encontrado!',
                color: 'white',
            })
        });
    }
</script>
@endif
*/
-->
@endsection