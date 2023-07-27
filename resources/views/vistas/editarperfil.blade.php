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
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
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
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
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
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
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
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
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
                                    <h5 class="my-3">{{ $datos['user']->nombre }}</h5>
                                    <p class="text-muted mb-1">{{ $datos['rol'] }}</p>
                                    <p class="text-muted mb-4">{{ $datos['facultad'] }}</p>

                                </div>
                            </div>
                        </div>
                        <!--Datos del Usuario-->
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <form action="{{ route('user.actualizar', ['id' => encrypt($datos['user']->id)]) }}"
                                    method="POST" id="miForm">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Id Banner</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"> <input type="number"
                                                        class="form-control" name="id_banner"
                                                        value="{{ $datos['user']->id_banner }}"
                                                        {{ auth()->user()->id_rol != 9 ? 'disabled' : '' }}></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Documento de identidad</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><input type="number" class="form-control"
                                                        name="documento" value="{{ $datos['user']->documento }}"
                                                        {{ auth()->user()->id_rol != 9 ? 'disabled' : '' }}>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Nombre Completo</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"> <input type="text"
                                                        class="form-control" name="nombre"
                                                        value="{{ $datos['user']->nombre }}"></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Email</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><input type="email" class="form-control"
                                                        name="email" value="{{ $datos['user']->email }}"
                                                        {{ auth()->user()->id_rol != 9 ? 'disabled' : '' }}></p>
                                            </div>
                                        </div>
                                        <hr>
                                        @if ($roles != '')
                                            <div class="row">
                                                <div class="col-sm-3 text-dark">
                                                    <p class="mb-0">Rol</p>
                                                </div>
                                                <div class="col mb-3">
                                                    <select class="form-select" name="id_rol" id="rol"
                                                        {{ auth()->user()->id_rol != 9 ? 'disabled' : '' }}>
                                                        @foreach ($roles as $rol)
                                                            <option
                                                                {{ $rol->id == $datos['user']->id_rol ? 'selected' : '' }}
                                                                value="{{ $rol->id }}">{{ $rol->nombreRol }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <hr>
                                        @if ($facultades != '' || ($facultades = null))
                                            <div class="row">
                                                <div class="col-sm-3 text-dark">
                                                    <p class="mb-0">Facultad</p>
                                                </div>
                                                <select class="form-select" name="facultades" id="facultades" {{ auth()->user()->id_rol != 9 ? 'style="display:none;"' : '' }}>
                                                    @if ($datos['user']->id_facultad == '')
                                                        <option value="" selected>Seleccione una facultad</option>
                                                        @foreach ($facultades as $facultad)
                                                            <option value="{{ $facultad->id }}">
                                                                {{ $facultad->nombre }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="" selected >Seleccione una facultad</option>
                                                        @foreach ($facultades as $facultad)
                                                            <option
                                                                {{ $facultad->id == $datos['user']->id_facultad ? 'selected="selected"' : '' }}
                                                                value="{{ $facultad->id }}">{{ $facultad->nombre }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        @endif
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 text-dark">
                                                <p class="mb-0">Programas</p>
                                            </div>
                                            <div class="col-sm-7 form-check">
                                                <div id="programas" name="programas"></div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center mb-2">
                                            <button type="submit" class="btn btn-outline-primary ms-1">Finalizar
                                                Actualización</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @include('layout.footer')
</div>

<script>
    $('#facultades').each(function() {
        programas = "{{ $datos['user']->programa }}";
        programasSeparados = programas.split(";").map(Number);

        id_facultad = $(this);

        if ($('#facultades').val() != '') {
            $.post('{{ route('registro.programas') }}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                idfacultad: id_facultad.val(),
            }, function(data) {
                /*id_facultades=[];
                console.log(data);
                data.forEach(programa => {
                    id_facultades.push(parseInt(programa.id));
                    //console.log(id_facultades);
                    //console.log(programasSeparados.includes(programa.id));

                    //$('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${programa.id}"> ${programa.programa}</label><br>`);
                });*/
                for (let i = 0; i < data.length; i++) {
                    if (programasSeparados.includes(data[i]['id'])) {
                        $('#programas').append(
                            `<label><input type="checkbox" checked id="" name="programa[]" value="${data[i]['id']}"> ${data[i]['programa']}</label><br>`
                        );
                    } else {
                        $('#programas').append(
                            `<label><input type="checkbox" id="" name="programa[]" value="${data[i]['id']}"> ${data[i]['programa']}</label><br>`
                        );
                    }
                }

            })
        } else {
            $('#programas').empty();
        }
    });

    $('#facultades').change(function() {
        programas = "{{ $datos['user']->programa }}";
        programasSeparados = programas.split(";").map(Number);
        id_facultad = $(this);


        if ($('#facultades').val() != '') {
            $.post('{{ route('registro.programas') }}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                idfacultad: id_facultad.val(),
            }, function(data) {
                $('#programas').empty();
                $('#facultades').remove('option');
                for (let i = 0; i < data.length; i++) {
                    if (programasSeparados.includes(data[i]['id'])) {
                        $('#programas').append(
                            `<label><input type="checkbox" checked id="" name="programa[]" value="${data[i]['id']}"> ${data[i]['programa']}</label><br>`
                        );
                    } else {
                        $('#programas').append(
                            `<label><input type="checkbox" id="" name="programa[]" value="${data[i]['id']}"> ${data[i]['programa']}</label><br>`
                        );
                    }
                }
                5

            })
        } else {
            $('#programas').empty();
        }
    })
</script>
