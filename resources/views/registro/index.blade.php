@extends('layout.plantilla')
@section('title', 'Registro')
@section('content')


    <div>
        <h3>Registro usuario</h3>
        <form action="{{ route('registro.saveregistro') }}" method="post">
            @csrf
            <div>
                <label for="">IDBanner</label>
                <input type="number" name="idbanner" id="idbanner">
                @error('idbanner')
                    <small>*{{  $message }}</small>
                @enderror
            </div>
            <div>
                <label for="">Documento</label>
                <input type="text" name="documento" id="documento">
                @error('documento')
                    <small>*{{  $message }}</small>
                @enderror
            </div>
            <div>
                <label for="">Nombre completo</label>
                <input type="text" name="nombre" id="nombre">
                @error('nombre')
                    <small>*{{  $message }}</small>
                @enderror
            </div>
            <div>
                <label for="">Correo electronico</label>
                <input type="text" name="correo" id="correo">
                @error('correo')
                    <small>*{{  $message }}</small>
                @enderror
            </div>
            {{-- <div>
                <label for="">Contraseña</label><input type="password">
            </div> --}}
            <div>
                <label for="">Rol</label>
                <select name="idrol" id="rol">
                    <option value="">Seleccione le rol</option>
                </select>
                @error('idrol')
                    <small>*{{  $message }}</small>
                @enderror
            </div>
            <div>
                <label for="">Facultad</label>
                <select name="idfacultad" id="facultades">
                    <option value="">Seleccione la facultad</option>
                </select>
                @error('idfacultad')
                    <small>*{{  $message }}</small>
                @enderror
            </div>
            <div>
                <label>Programas</label>
                <div id="programas"></div>
            </div>
            <input type="submit" value="Registrar">
        </form>
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
                success: function(data){
                    data.forEach(rol => {
                        $('#rol').append(`<option name="programa[]" value="${rol.id}">${rol.nombreRol}</option>`);
                    });
                }
            })
        }

        function facultades(){
            $.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url: "{{ route('registro.facultades') }}",
                method: 'post',
                success: function(data){
                    data.forEach(facultad => {
                        $('#facultades').append(`<option value="${facultad.id}">${facultad.nombre}</option>`);
                    });
                }
            });
        }

        $('#facultades').change(function(){
            facultades = $(this);
            if ($(this).val() != '') {
                var formData = new FormData();
                formData.append('idfacultad',facultades.val());
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
                    success: function(data){
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
@endsection
