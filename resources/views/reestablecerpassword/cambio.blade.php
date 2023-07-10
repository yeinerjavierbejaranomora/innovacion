<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<!--  creamos el contenido principal body -->

@extends('layout.plantillaFormularios')
@section('title', 'Cambio Contraseña')
@section('content')

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
        <form action="{{ route('cambio.cambiosave') }}" method="post" class="validate-form" id="miForm">
            @csrf
            <span class="login100-form-title p-b-49">
                Cambio de contraseña
            </span>
            @if(count($errors)>0)
            <h4>{{$errors}}</h4>
            @endif
            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
            <div class="validate-input m-b-23" data-validate="Contraseña actual es requerida">
                <span for="password_actual">Contraseña actual</span>
                <p><input type="password" name="password_actual" placeholder="Contraseña actual" id="contraseña"></p>
                <span class="focus" data-symbol="&#xf183;"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-23" data-validate="Contraseña nueva es requerida">
                <span class="label-input100">Contraseña nueva</span>
                <input class="input100" type="password" name="password" placeholder="Contraseña nueva" id="nueva">
                <span class="focus-input100" data-symbol="&#xf183;"></span>
            </div>

            <div class="wrap-input100 validate-input m-b-23" data-validate="Confirmar es requerido">
                <span class="label-input100">Confirmar contraseña</span>
                <input class="input100" type="password" name="password_confirmacion" placeholder="Confirmar contraseña" id="confirmar">
                <span class="focus-input100" data-symbol="&#xf183;"></span>
            </div>

            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    {{-- <button type="submit" class="login100-form-btn" onclick="return validacion()">
                            Cambiar contraseña
                        </button> --}}
                    <button type="submit" class="login100-form-btn">
                        Cambiar contraseña
                    </button>
                </div>
            </div>

            <div class="txt1 text-center p-t-54 p-b-20">
                <h4> Universidad Iberoamericana</h4>
                <p>©2023 Todos los derechos reservados.</p>
            </div>
        </form>
    </div>
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
@endsection