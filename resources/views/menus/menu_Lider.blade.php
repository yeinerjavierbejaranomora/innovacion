
<style>
    .textoPequeño{
        font-size: 14px;
        text-transform: lowercase;
    }

    #accordionSidebar {
    width: 260px!important;
    }

    .activo{
    background-color: #dfc14e;
    }
</style>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" id="menuHome" href="{{ route('home.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="/public/assets/images/LogoBlanco.png" width="40" alt="">
        </div>
        <div class="sidebar-brand-text mx-3"> Líder </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item" id="menuAdmisiones">
        <a class="nav-link" href="{{ route('home.mafi') }}">
            <i class="fa-solid fa-table"></i>
            <span>Admisiones</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu  users-->
    <li class="nav-item" id="menuMoodle">
        <a class="nav-link" href="{{ route('home.moodle') }}">
            <i class="fa-solid fa-network-wired"></i>
            <span>Moodle</span></a>
    </li>

    <li class="nav-item" id="menuPlaneacion">
        <a class="nav-link" href="{{ route('home.planeacion') }}">
            <i class="fa-solid fa-pen"></i>
            <span>Planeación</span></a>
    </li>

    <li class="nav-item" id="menuAlertas">
        {{-- {{ auth()->user(); }} --}}
        @include('layout.alertas')
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


    