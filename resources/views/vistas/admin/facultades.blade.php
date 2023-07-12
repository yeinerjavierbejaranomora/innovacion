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
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <button id="mostrar" name="mostrar" type="input" value="{{ $value->id }}" class="mostrar btn text-dark button">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            <h6> Programa de {{$value->programa}}</h6>
                                        </div>
                                        <!-- <button id="mostrar" name="mostrar" type="input" value="{{ $value->id }}" class="mostrar btn btn-warning text-dark"> -->
                                        <div class=" mb-0 font-weight-bold text-gray-800">
                                            <p>Estudiantes inscritos {{$est}}</p>
                                        </div>
                                        <!-- </button> -->
                                    </div>

                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endforeach
            </div>

            <!-- Datatable-->
            <div class="row" <?php echo (count($datos['programas']) === 0) ? ' hidden' : '' ?>>

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
        </div>
    </div>
    @include('layout.footer')
</div>
<script>
    // * Datatable para mostrar los estudiantes de cada programa *
    $(document).ready(function() {
        $(document).on("click", ".mostrar", function() {

            var id = $(this).val();
            buscar(id);
        })

        function buscar(id) {

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
                                "visible": false,
                                title: 'bolsa'
                            },
                            {
                                data: 'operador',
                                title: 'Operador'
                            },
                            {
                                data: 'nodo',
                                "visible": false,
                                title: 'nodo'
                            },
                            {
                                data: 'tipo_estudiante',
                                title: 'Tipo estudiante'
                            },
                            {
                                data: 'materias_faltantes',
                                "visible": false,
                                title: 'materias faltantes'
                            },
                            {
                                data: 'programado_ciclo1',
                                "visible": false,
                                title: 'Programado ciclo 1'
                            },
                            {
                                data: 'programado_ciclo2',
                                "visible": false,
                                title: 'Programado ciclo 2'
                            },
                            {
                                data: 'programado_extra',
                                "visible": false,
                                title: 'Programado extra'
                            },
                            {
                                data: 'tiene_historial',
                                "visible": false,
                                title: 'Tiene historial'
                            },
                            {
                                data: 'programaActivo',
                                "visible": false,
                                title: 'Programa activo'
                            },
                            {
                                data: 'observacion',
                                "visible": false,
                                title: 'Observación'
                            },
                            {
                                data: 'marca_ingreso',
                                "visible": false,
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
                            $('.dataTables_wrapper .dataTables_length').before('<h4>Título del DataTable</h4>');
                        }
                    });
                    console.log(table);
                }

            }
        }
    });
</script>