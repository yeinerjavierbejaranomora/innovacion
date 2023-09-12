
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
        alert(id_rol);
        $.get("{{ route('alertas.notificaciones') }}",{},function(data){
            var total = data;
            if (total > 99) {
                $('#notificacionesCount').append('+99');
            } else {
                $('#notificacionesCount').append(`${total}`);
            }
        })
    }
</script>
        <a  class="nav-link" href="{{ route('alertas.inicio') }}">
            <i class="fa-solid fa-bell"></i>
            <span>Alertas Tempranas<br>(Programación-Planeación)</span>
            <span id="notificacionesCount" class="notificaciones-count"></span>
        </a>
    </li>
