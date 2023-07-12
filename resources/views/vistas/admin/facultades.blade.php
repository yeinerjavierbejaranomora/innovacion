<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<!--  creamos el contenido principal body -->

<style>
    .button:hover {
        background-color: #dfc14e;
        transition: 0.7s;
    }

    .activo {
        background-color: #dfc14e;
    }

    .activo i {
        color: #4a4a48 !important;
    }

    .inactivo {
        background-color: #4a4a48;
        border-radius: 30px;
        color: white;
    }

    .inactivo i {
        color: #dfc14e !important;
    }
</style>

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

            @if(count($datos['programas']) === 0)
            <h3 class="text-center">NO HAY DATOS POR MOSTRAR</h3>
            @endif

            <!-- Content Row -->
            <div class="row" id="facultades">
                @foreach($datos['programas'] as $key => $value)
                @foreach($estudiantes as $key => $est)
                @if($value->codprograma == $key)
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4 inactivo">
                    <button id="mostrar" name="mostrar" type="input" value="{{ $value->id }}" class="mostrar btn button">
                    <div class="card shadow h-100 py-2 text-white">
                        <div class=" card-body">
                            <div class="row text-center">
                                <div class="col mx-auto">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <h6> Programa de {{$value->programa}}</h6>
                                        </div>
                                        <!-- <button id="mostrar" name="mostrar" type="input" value="{{ $value->id }}" class="mostrar btn btn-warning text-dark"> -->
                                        <div class=" mb-0 font-weight-bold text-gray-800">
                                            <p>Estudiantes inscritos {{$est}}</p>
                                        </div>
                                        <!-- </button> -->


                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </button>
                    </div>
                    @endif
                @endforeach
                @endforeach
            </div>

            <!--Nav Datos de la Facultad-->
            <div class="row" id="nav" name="nav" style="display: none;">
                <nav class="nav nav-pills nav-justified">
                    <a class="nav-link active" href="#estudiantes">Estudiantes</a>
                    <a class="nav-link" href="#malla">Malla Curricular</a>
                    <a class="nav-link" href="#proyecciones">Proyecciones</a>
                </nav>
            </div>

            <br>

            <!-- Datatable Estudiantes-->
            <div class="row" id="est" style="display: none;">

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

            <!-- Datatable Malla Curricular-->
            <div class="row" id="mall" style="display: none;">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table">
                                <table id="malla" class="display" style="width:100%">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        /** Función para mostrar el Nav solo al dar click en el botón 
         * Además de cargar la dataTable dependiendo el nav
         */
        $(document).ready(function() {
            var id = null;
            $(document).on("click", ".mostrar", function() {
                if ($.fn.DataTable.isDataTable("#mall table")) {
                    console.log('entra');
                    $("#mall table").DataTable().destroy();
                    $("#malla").empty();
                }
                /** Mostrar nav y dataTable */
                $("#nav").show();
                $("#est").show();
                /** Eliminar el parametro active de malla en el nav */
                $("#nav a[href='#malla']").removeClass("active");
                $("#nav a[href='#estudiantes']").addClass("active");
                /** Obtener id */
                id = $(this).val();
                /** Llamado a la función para cargar dataTable */
                estudiantes(id);

            })

            $("#nav a[href='#malla']").click(function() {
                if ($.fn.DataTable.isDataTable("#est table")) {
                    $("#est table").DataTable().destroy();
                    $("#estudiantes").empty();
                }
                $("#est").hide();
                $("#mall").show();
                $("#nav a[href='#estudiantes']").removeClass("active");
                $(this).addClass("active");


                if (!$.fn.DataTable.isDataTable("#mall table")) {
                    malla(id);
                }
                return false;
            });

            $("#nav a[href='#estudiantes']").click(function() {
                if ($.fn.DataTable.isDataTable("#mall table")) {
                    $("#mall table").DataTable().destroy();
                    $("#malla").empty();
                }
                $("#est").show();
                $("#mall").hide();
                $("#nav a[href='#malla']").removeClass("active");
                $(this).addClass("active");


                if (!$.fn.DataTable.isDataTable("#est table")) {
                    estudiantes(id);
                }
                return false;
            });
            /** DataTabla estudiantes */
        });

        function estudiantes(id) {
            var titleAdded = false;
            var xmlhttp = new XMLHttpRequest();
            var url = "/home/facultades/estudiantes/" + id + "";
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);

                    var table = $('#example').DataTable({
                        /** Recargar dataTable */
                        "bDestroy": true,
                        "data": data.data,
                        "columns": [{
                                data: 'homologante',
                                title: 'ID Banner'
                            },
                            {
                                data: 'nombre',
                                title: 'Primer apellido'
                            },
                            {
                                data: 'programa',
                                title: 'Codigo de programa'
                            },
                            {
                                data: 'bolsa',
                                visible: false,
                                title: 'bolsa'
                            },
                            {
                                data: 'operador',
                                title: 'Operador'
                            },
                            {
                                data: 'nodo',
                                visible: false,
                                title: 'nodo'
                            },
                            {
                                data: 'tipo_estudiante',
                                title: 'Tipo estudiante'
                            },
                            {
                                data: 'materias_faltantes',
                                visible: false,
                                title: 'materias faltantes'
                            },
                            {
                                data: 'programado_ciclo1',
                                visible: false,
                                title: 'Programado ciclo 1'
                            },
                            {
                                data: 'programado_ciclo2',
                                visible: false,
                                title: 'Programado ciclo 2'
                            },
                            {
                                data: 'programado_extra',
                                visible: false,
                                title: 'Programado extra'
                            },
                            {
                                data: 'tiene_historial',
                                visible: false,
                                title: 'Tiene historial'
                            },
                            {
                                data: 'programaActivo',
                                visible: false,
                                title: 'Programa activo'
                            },
                            {
                                data: 'observacion',
                                visible: false,
                                title: 'Observación'
                            },
                            {
                                data: 'marca_ingreso',
                                visible: false,
                                title: 'Marca ingreso'
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
                        "drawCallback": function() {
                            if (!titleAdded) {
                                $('.dataTables_wrapper .dataTables_length').before('<h4 class="text-center">Estudiantes inscritos</h4>');
                                titleAdded = true;
                            }
                        }
                    });
                    console.log(table);
                }

            }
        }

        /**dataTable Malla Curricular */
        function malla(id) {
            var titleAdded = false;
            var xmlhttp = new XMLHttpRequest();
            var url = "/home/getmalla/" + id + "";
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    var mallaTable = $('#malla').DataTable({
                        "bDestroy": true,
                        "data": data.data,
                        "order": [
                            [1, 'asc'],
                            [3, 'asc']
                        ],
                        "columns": [{
                                data: 'codprograma',
                                title: 'Codigo de programa'
                            },
                            {
                                data: 'semestre',
                                title: 'Semestre'
                            },
                            {
                                data: 'ciclo',
                                title: 'Ciclo'
                            },
                            {
                                data: 'orden',
                                title: 'Orden'
                            },
                            {
                                data: 'curso',
                                title: 'Curso'
                            },
                            {
                                data: 'codigoCurso',
                                title: 'Codigo curso'
                            },
                            {
                                data: 'creditos',
                                title: 'Numero de créditos'
                            },
                            {
                                data: 'prerequisito',
                                title: 'Pre-requisitos'
                            },
                        ],
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                        },
                        "drawCallback": function() {
                            if (!titleAdded) {
                                $('.dataTables_wrapper .dataTables_length').before('<h4 class="text-center">Malla Curricular</h4>');
                                titleAdded = true;
                            }
                        }
                    });
                }
            }
        }
    </script>
    @include('layout.footer')
</div>