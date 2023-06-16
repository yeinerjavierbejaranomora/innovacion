<!DOCTYPE html>
<html lang="en">

<head>
    <title>Prueba registro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('public/assets/images/icons/favicon.ico')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body>


    <div class="limiter">
        <div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-01.jpg')}});">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form action="" method="post" class="login100-form validate-form" id="miform">
                    @csrf
                    <span class="login100-form-title p-b-49">
                        Formulario de registro
                    </span>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="idBanner is required">
                        <span class="label-input100">ID Banner</span>
                        <input class="input100" type="number" name="idBanner" placeholder="ID Banner" id="idBanner">
                        <span class="focus-input100" data-symbol="&#xf205;"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate="CC Banner is required">
                    <span class="label-input100">Documento de identidad</span>
                        <input class="input100" type="text" name="CC" placeholder="Documento de identidad" id="CC">
                    </div>
                    <div>
                        <label for="">Nombre completo</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="">Correo electronico</label>
                        <input type="text">
                    </div>
                    {{-- <div>
                <label for="">Contraseña</label><input type="password">
            </div> --}}
                    <div>
                        <label for="">Rol</label>
                        <select name="rol" id="rol">
                            <option value="">Seleccione el rol</option>
                        </select>
                    </div>
                    <div>
                        <label for="">Facultad</label>
                        <select name="facultades" id="facultades">
                            <option value="">Seleccione la facultad</option>
                        </select>
                    </div>
                    <div id="programas">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        roles();
        facultades();

        function roles() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('registro.roles') }}",
                method: 'get',
                success: function(data) {
                    data.forEach(rol => {
                        $('#rol').append(`<option value="${rol.id}">${rol.nombreRol}</option>`);
                    });
                }
            })
        }

        function facultades() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('registro.facultades') }}",
                method: 'post',
                success: function(data) {
                    data.forEach(facultad => {
                        $('#facultades').append(`<option value="${facultad.id}">${facultad.nombre}</option>`);
                    });
                }
            });
        }

        $('#facultades').change(function() {
            facultades = $(this);
            if ($(this).val() != '') {
                var formData = new FormData();
                formData.append('idfacultad', facultades.val());
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('registro.programas') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        facultades.prop('disabled', true);
                    },
                    success: function(data) {
                        console.log(data);
                        facultades.prop('disabled', false)
                        $('#programas').empty();
                        data.forEach(programa => {
                            $('#programas').append(`<label><input type="checkbox" id="" value="${programa.id}"> ${programa.programa}</label><br>`);
                        });
                    }
                });
            }
        })
    </script>

    // Scripts para estilos
    <!--===============================================================================================-->
    <script src="{{ asset('public/assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('public/assets/vendor/animsition/js/animsition.min.js')}}"></script>
    <!--=============assets/==================================================================================-->
    <script src="{{ asset('public/assets/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{ asset('public/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('public/assets/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('public/assets/vendor/daterangepicker/moment.min.js')}}"></script>
    <script src="{{ asset('public/assets/vendor/vendor/daterangepicker/daterangepicker.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('public/assets/vendor/countdowntime/countdowntime.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('public/assets/js/main.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#miform").submit(function(event) {
                event.preventDefault();
                $.ajax({
                    dataType: "json",
                    url: "index.php?action=validar",
                    type: "POST",
                    data: {
                        usr: $("#mail").val(),
                        pass: $("#pass").val()
                    },
                    success: function(data) {
                        if (data.success == false) {
                            $("#mensaje").show();
                            $("#mensaje").html(data.msg);
                            $('.log-status').addClass('wrong-entry');
                            $('.alert').fadeIn(700);
                            setTimeout("$('.alert').fadeOut(1800);", 1500);
                        } else {
                            window.location = data.link;
                        }
                    },
                    error: function(response) {
                        $("#mensaje").show();
                        $("#mensaje").html(response.responseText);
                    }
                });
            });
            $('.form-control').keypress(function() {
                $('.log-status').removeClass('wrong-entry');
            });
        });
    </script>
</body>

</html>