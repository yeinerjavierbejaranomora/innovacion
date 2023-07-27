<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->

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
                                    <h5 class="my-3">{{auth()->user()->nombre}}</h5>
                                    <p class="text-muted mb-1">{{ $datos['rol'] }}</p>
                                    @if($datos['facultad'] != NULL)
                                    <p class="text-muted mb-4">{{ $datos['facultad'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <form action="{{ route('cambio.cambiosave') }}" method="post" id="miForm">
                                    @csrf
                                    <div class="card-body">
                                        <div>
                                            <h3 class="text-center">
                                                Cambio de contraseña
                                            </h3>
                                        </div>
                                        <hr>
                                        @if(count($errors)>0)
                                        <h4>{{$errors}}</h4>
                                        @endif
                                        <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Contraseña actual</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><input class="form-control" type="password" name="password_actual" placeholder="Contraseña actual" id="contraseña" required></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Contraseña nueva</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><input class="form-control" type="password" name="password" placeholder="Contraseña nueva" id="nueva" required></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Confirmar contraseña</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p> <input class="form-control" type="password" name="password_confirmacion" placeholder="Confirmar contraseña" id="confirmar" required></p>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- <button type="submit" class="form-btn" onclick="return validacion()">
                            Cambiar contraseña
                        </button> --}}
                                        <div class="d-flex justify-content-center mb-2">
                                            <button type="submit" class="btn btn-secondary">
                                                Cambiar contraseña
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>



    <script>
        // * Función para enviar alerta al usuario *
        function validacion() {

            // * Validación para verificar que todos los campos contengan información *
            if ($('#contraseña').val() && $('#nueva').val() && $('#confirmar').val()) {
                $("#miForm").submit(function(e) {
                    e.preventDefault();
                    // * Sweet alert *
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¡No podrás deshacer este cambio!",
                        icon: 'warning',
                        color: 'white',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, cambiar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            color: 'white'
                            Swal.fire(
                                'Cambio exitoso',
                                'Tu contraseña fue cambiada.',
                                'success'
                            )
                        }
                    })
                });
            }
        }
    </script>
    @include('layout.footer')
</div>