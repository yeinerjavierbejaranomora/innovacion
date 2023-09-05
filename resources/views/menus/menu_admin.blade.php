
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
        <div class="sidebar-brand-icon">
            <img src="/public/assets/images/LogoBlanco.png" width="40" alt="">
        </div>
        <div class="sidebar-brand-text mx-3"> Admin </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu  users-->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.moodle') }}">
            <i class="fa-solid fa-network-wired"></i>
            <span>Moodle</span></a>        
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.planeacion') }}">        
            <i class="fa-solid fa-pen"></i>
            <span>Planeación</span></a> 
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.mafi') }}">
            <i class="fa-solid fa-table"></i>
            <span>Admisiones</span></a>       
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-address-book"></i>
            <span>Gestión de usuarios. </span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('admin.users') }}">Usuarios</a>
                <a class="collapse-item" href="{{ route('admin.roles') }}">Roles</a>

            </div>
        </div>
    </li>

    <!--Nav Item - Menú desplegable "Gestión de Facultades"-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-graduation-cap"></i>
            <span>Configuración</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('admin.facultades') }}">Facultades</a>
                <a class="collapse-item" href="{{ route('facultad.programas') }}">Programas</a>
                <a class="collapse-item" href="{{ route('planeacion.view') }}">Planeación</a>
                <a class="collapse-item" href="{{ route('facultad.especializacion') }}">Especialización</a>
                <a class="collapse-item" href="{{ route('facultad.maestria') }}">Maestría</a>
                <a class="collapse-item" href="{{ route('facultad.continua') }}">Educación continua</a>
                <a class="collapse-item" href="{{ route('facultad.periodos') }}">Periodos</a>
                <a class="collapse-item" href="{{ route('facultad.reglas') }}">Reglas de negocio</a>
                <a class="collapse-item" href="{{ route('programasPeriodos.view') }}">Periodos - Programas</a>


            </div>
        </div>
    </li>

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


    