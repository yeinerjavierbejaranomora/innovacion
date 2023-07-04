<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
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


            <div class="input-group">

                <div class="input-group-append">
                    <h3> Bienvenido {{auth()->user()->nombre}}</h3>
                </div>
            </div>




        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Programas facultad de {{$datos['facultad']}}</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>
            <!-- Content Row -->
            <div class="row" id="facultades">
                @foreach($datos['programas'] as $key => $value)
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <h6> Programa de {{$value->programa}}</h6>
                                    </div>
                                    <input id="mostrar" type="button" class="btn btn-warning text-dark" onclick="mostrarEstudiantes()">
                                    Estudiantes $4,000
                                    </input>
                                </div>

                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Datatable-->
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table">
                                <table id="example" class="display" style="width:100%">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // * Datatable para mostrar los estudiantes de cada programa *
                function mostrarEstudiantes() {
                    var xmlhttp = new XMLHttpRequest();
                    var url = "{{ route('facultad.getperiodos') }}";
                    xmlhttp.open("GET", url, true);
                    xmlhttp.send();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var data = JSON.parse(this.responseText);
                            var table = $('#example').DataTable({
                                "data": data.data,
                                "columns": [{
                                        data: 'ibbanner',
                                        title: 'Id Banner'
                                    },
                                    {
                                        data: 'primer_apellido',
                                        title: 'Primer apellido'
                                    },
                                    {
                                        data: 'programa',
                                        title: 'Codigo de programa'
                                    },
                                    {
                                        data: 'estado',
                                        title: 'Estado'
                                    },
                                    {
                                        data: 'tipoestudiante',
                                        title: 'Tipo estudiante'
                                    },
                                    {
                                        data: 'sello',
                                        title: 'Sello'
                                    },
                                    {
                                        data: 'autorizado_asistir',
                                        title: 'Autorizado'
                                    },
                                    {
                                        data: 'created_at',
                                        title: 'Fecha de creación'
                                    },
                                    {
                                        data: 'updated_at',
                                        title: 'Última actulización'
                                    },
                                ],
                                "language": {
                                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                                },
                                //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                            });
                            console.log(table);
                        }
                    }
                })
            </script>
            @include('layout.footer')