@extends('layout.plantilla')
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

                <div class="wrap-input100 validate-input m-b-23" data-validate="idBanner is required">
                    <span class="label-input100">ID Banner</span>
                    <input class="input100" type="number" name="idbanner" placeholder="ID Banner" id="idbanner">
                    <span class="focus-input100" data-symbol="&#xf205;"></span>
                    @error('idbanner')
                    <small>*{{ $message }}</small>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="documento is required">
                    <span class="label-input100">Documento de identidad</span>
                    <input class="input100" type="text" name="documento" placeholder="Documento de identidad" id="documento">
                    <span class="focus-input100" data-symbol="&#xf20b;"></span>
                    @error('documento')
                    <small>*{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Nombre completo</label>
                    <input type="text" name="nombre" id="nombre">
                    @error('nombre')
                    <small>*{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Correo electronico</label>
                    <input type="text" name="correo" id="correo">
                    @error('correo')
                    <small>*{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div>
                <label for="">Contraseña</label><input type="password">
            </div> --}}
                <div>
                    <label for="">Rol</label>
                    <select name="idrol" id="rol">
                        <option value="">Seleccione el rol</option>
                    </select>
                    @error('idrol')
                    <small>*{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for="">Facultad</label>
                    <select name="idfacultad" id="facultades">
                        <option value="">Seleccione la facultad</option>
                    </select>
                </div>
                <div>
                    <label>Programas</label>
                    <div id="programas"></div>
                </div>
                <input type="submit" value="Registrar">
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
        }
    })
</script>
@endsection