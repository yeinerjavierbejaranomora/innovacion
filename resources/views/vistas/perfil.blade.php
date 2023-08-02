<!-- en esta vista incluiremos todos los datos relacionados con el usuario -->
@include('layout.header')

@auth
    @switch(auth()->user()->id_rol)
        @case (1)
        @include('menus.menu_Decano')
            @break;     
        @case (2)
        @include('menus.menu_Director')
            @break;
        @case (3)
        @include('menus.menu_Coordinador')
            @break;  
        @case (4)
        @include('menus.menu_Lider')
            @break;  
        @case (5)
        @include('menus.menu_Docente')
            @break;  
        @case (6)
        @include('menus.menu_Estudiante')
            @break;  
        @case (9)
            @include('menus.menu_admin')
            @break;  
        @case (19)
            @include('menus.menu_rector') 
            @break;
        @case (20)
            @include('menus.menu_Vicerrector')  
            @break;         
    @endswitch
@endauth

<!--  creamos el contenido principal body -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- alertas -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <section style="background-color: #eee;">
                <div class="container py-5">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img src="https://e7.pngegg.com/pngimages/178/595/png-clipart-user-profile-computer-icons-login-user-avatars-monochrome-black.png" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3">{{ auth()->user()->nombre }}</h5>
                                    <p class="text-muted mb-1"> {{ $datos['rol'] }}</p>

                                    <p class="text-muted mb-1">{{ $datos['facultad'] }}</p>
                                    @if ($datos['programa'] != NULL)
                                    <p class="text-muted mb-1">Programas</p>
                                    @foreach($datos['programa'] as $programa)
                                    <p class="text-muted mb-1">{{ $programa }}</p>
                                    @endforeach
                                    <br>
                                    @endif
                                    <div class="d-flex justify-content-center mb-2">
                                        <!--Botón que permite actualizar los datos del Usuario-->
                                        <a href="{{ route('user.editar',['id'=>encrypt(auth()->user()->id)]) }}">
                                            <button type="button" class="btn btn-outline-primary ms-1">Actualizar datos</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!--Datos del Usuario-->
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 text-dark">
                                            <p class="mb-0">Id Banner</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ auth()->user()->id_banner }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 text-dark">
                                            <p class="mb-0">Documento de identidad</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{auth()->user()->documento }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 text-dark">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 text-dark">
                                            <p class="mb-0">Rol</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $datos['rol']}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    @unless(in_array($datos['rol'], ['Admin', 'Rector', 'Vicerrector']))
                                    <div class="row" >
                                        <div class="col-sm-3 text-dark">
                                            <p class="mb-0">Facultad</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$datos['facultad'] }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 text-dark">
                                            <p class="mb-0">Programas</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">
                                                <!--Validación para saber si el usuario tiene algún programa-->
                                                @if($datos['programa'])
                                                <!--Ciclo para recorrer el array de programas e imprimirlos en pantalla-->
                                                @foreach ($datos['programa'] as $key => $value)
                                                {{$value}} <br>
                                                @endforeach
                                                @endif
                                            </p>

                                        </div>
                                    </div>
                                    @endunless
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 text-dark">
                                            <p class="mb-0">Estado</p>
                                        </div>
                                        <!--Validación para verificar si el usuario se encuentra activo o no-->
                                        @if (auth()->user()->activo = 1)
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">Activo</p>
                                        </div>
                                        @else
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">Inactivo</p>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a class="" href="{{ route('cambio.cambio', ['idbanner' => encrypt(auth()->user()->id_banner)]) }}" role="button"><u>Cambiar Contraseña</u></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('layout.footer')
</div>