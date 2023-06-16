@extends('layout.plantillaFormularios')
@section('title', 'Registro')
@section('content')


<div class="limiter">
    <div class="container-login100" style="background-image: url({{asset('public/assets/images/bg-01.jpg')}});">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form action="{{ route('registro.saveregistro') }}" method="post" class="login100-form validate-form" id="miform">
                @csrf
                <span class="login100-form-title p-b-49">
                    Formulario de registro
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

                <div class="wrap-input100 validate-input m-b-23" data-validate="nombre es requerido">
                    <span class="label-input100">Nombre completo</span>
                    <input class="input100" type="text" name="nombre" placeholder="Nombre completo" id="nombre">
                    <span class="focus-input100" data-symbol="&#xf20e;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="correo es requerido">
                    <span class="label-input100">Correo electronico</span>
                    <input class="input100" type="text" name="correo" placeholder="Correo electronco" id="correo">
                    <span class="focus-input100" data-symbol="&#xf15a;"></span>
                </div>

                {{-- <div>
                <label for="">Contraseña</label><input type="password">
            </div> --}}

                <div class="wrap-input100 validate-input m-b-23" data-validate="rol es requerido">
                    <span class="label-input100">Rol</span>
                    <select class="input100" name="idrol" id="rol">
                        <option value="">Seleccione el rol</option>
                    </select>
                    <span class="focus-input100" data-symbol="&#xf2f1;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="facultades es requerido">
                    <span class="label-input100">Facultad</span>
                    <select class="input100" name="idfacultad" id="facultades">
                        <option value="">Seleccione la facultad</option>
                    </select>
                    <span class="focus-input100" data-symbol="&#xf2f1;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="programas es requerido">
                <span class="label-input100">Programas</span>
                <br>
                    <div id="programas"></div>
                </div>
                <br>
                
                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn">
								Registrar
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
                    $('#rol').append(`<option  value="${rol.id}">${rol.nombreRol}</option>`);
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
                        $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${programa.id}"> ${programa.programa}</label><br>`);
                    });
                }
            });
        } else {
            $('#programas').empty();
        }
    })

</script>
@endsection