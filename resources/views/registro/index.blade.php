@extends('layout.plantilla')
@section('title', 'Registro')
@section('content')
    <div>
        <h3>Registro usuario</h3>
        <form action="" method="post">
            @csrf
            <div>
                <label for="">IDBanner</label>
                <input type="number" name="" id="">
            </div>
            <div>
                <label for="">Documento</label>
                <input type="text">
            </div>
            <div>
                <label for="">Nombre completo</label>
                <input type="text">
            </div>
            <div>
                <label for="">Correo electronico</label>
                <input type="text">
            </div>
            <div>
                <label for="">Contraseña</label><input type="password">
            </div>
            <div>
                <label for="">Confirmar contraseña</label>
                <input type="password">
            </div>
            <div>
                <label for="">Rol</label>
                <select name="rol" id="rol">
                    <option value="">Seleccione le rol</option>
                </select>
            </div>
            <div>
                <label for="">Facultad</label>
                <select name="facultades" id="facultades">
                    <option value="">Seleccione la facultad</option>
                </select>
            </div>
            <div>
                <label for="">Programas</label>
            </div>
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
                method: 'post',
                success: function(data){
                    data.forEach(rol => {
                        $('#rol').append(`<option value="${rol.id}">${rol.nombreRol}</option>`);
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
    </script>
@endsection
