
<style>
    .notificaciones-count {
    background-color: red;
    color: white;
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 50%;
    position: absolute;
    vertical-align: middle;
    right: 0;
}
</style>
<script>
    numeroAlertas();
    function numeroAlertas(){
        id_rol = '{{ auth()->user()->id_rol }}';
        // alert(id_rol);
        if (id_rol == 9 || id_rol == 19 || id_rol == 20) {
            $.get("{{ route('alertas.notificaciones') }}",{},function(data){
                console.log(data);
                var total = data;
                if (total > 99) {
                    $('#notificacionesCount').append('+99');
                } else {
                    $('#notificacionesCount').append(`${total}`);
                }
            })
        }

        if(id_rol == 1){
            var id_facultad = '{{ auth()->user()->id_facultad }}';
            $.get("{{ route('alertas.notificacionesfacultad') }}",{
                id_facultad:id_facultad
            },function(data){
                console.log(data);
                var total = data;
                if (total > 99) {
                    $('#notificacionesCount').append('+99');
                } else {
                    $('#notificacionesCount').append(`${total}`);
                }
            })
        }

        if (id_rol == 2 || id_rol == 3 || id_rol == 4) {
            var id_programa = '{{ auth()->user()->programa }}';
            $.get("{{ route('alertas.notificacionesprograma') }}",{
                id_programa:id_programa
            },function(data){
                console.log(data);
                var total = data;
                if (total > 99) {
                    $('#notificacionesCount').append('+99');
                } else {
                    $('#notificacionesCount').append(`${total}`);
                }
            })
        }
    }
</script>

@switch(auth()->user()->id_rol)
    @case(9)
        <a  class="nav-link" href="{{ route('alertas.inicio') }}">
            <i class="fa-solid fa-bell"></i>
            <span>Alertas Tempranas<br>(Programación-Planeación)</span>
            <span id="notificacionesCount" class="notificaciones-count"></span>
        </a>
        @break
    $@default
        
@endswitch
        
