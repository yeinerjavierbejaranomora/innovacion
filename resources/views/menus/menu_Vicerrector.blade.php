

<style>
    .textoPequeño{
        font-size: 14px;
        text-transform: lowercase;
    }

    #accordionSidebar {
    width: 260px!important;
}
</style>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> {{ auth()->user()->nombre_rol}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Control</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!--Nav Item - Menú desplegable "Perfil"-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-key"></i>
            <span>Perfil</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('user.perfil',['id'=>encrypt(auth()->user()->id)]) }}">Ver perfil</a>
                <a class="collapse-item" href="{{ route('cambio.cambio',['idbanner'=>encrypt(auth()->user()->id_banner)]) }}">Cambiar contraseña</a>

            </div>
        </div>
    </li>

    <!-- Nav Item - salir de la app -->
    <li class="nav-item">
        <a class="nav-link" href="/logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Salir</span></a>
    </li>
</ul>

<!-- End of Sidebar -->


    