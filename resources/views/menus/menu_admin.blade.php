


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

            <!-- Nav Item - Pages Collapse Menu  users-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-address-book"></i>
                    <span>Gestión de usuarios. </span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="{{ route('admin.users') }}">Usuarios</a>
                        <a class="collapse-item" href="cards.html">Roles</a>

                    </div>
                </div>
            </li>


             <!-- Nav Item - Facultades -->
             <li class="nav-item">
                <a class="nav-link" href="{{ route('facultad.index',['id'=>encrypt(auth()->user()->id)]) }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Facultades</span></a>
            </li>

               <!-- Nav Item - Facultades -->
               <li class="nav-item">
                <a class="nav-link" href="{{ route('cambio.cambio',['idbanner'=>encrypt(auth()->user()->id_banner)]) }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Cambio de contraseña</span></a>
            </li>


            <!-- Nav Item - Perfil -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.perfil',['id'=>encrypt(auth()->user()->id)]) }}">
                    <i class="fas fa-key"></i>
                    <span>Perfil</span></a>
            </li>





            <!-- Nav Item - salir de la app -->
            <li class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Salir</span></a>
            </li>


        </ul>
        <!-- End of Sidebar -->

