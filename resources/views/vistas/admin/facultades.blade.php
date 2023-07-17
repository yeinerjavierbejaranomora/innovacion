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
        background-color: #dfc14e !important;
        border-radius: 30px !important;
        color: white;
        cursor: pointer;
    }

    .activo i {
        color: #4a4a48 !important;
    }

    .inactivo {
        background-color: #edeff2 !important;
        border-radius: 30px !important;
        color: black;
        cursor: pointer;
        border-color: black;
    }

    .inactivo:hover {
        background-color: #dfc14e !important;
        border-radius: 30px !important;
        color: white;
        cursor: pointer;
    }

    .inactivo i {
        color: #dfc14e !important;
    }

    .inactivo:hover i {
        color: #4a4a48 !important;
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
            <div class="text-center mb-4">
                <h1 class="h3 mb-0 text-gray-800 text-center" style="font-weight: 100;">Programas facultad de {{$datos['facultad']}}</h1>
                <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
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
                    <div class="card shadow h-100 py-2 inactivo mostrar programas" data-valor="{{ $value->id }}">
                        <div class=" card-body ">
                            <div class="row text-center">
                                <div class="col mx-auto">
                                    <div class="text-xs font-weight-bold">
                                        <h5> PROGRAMA DE {{$value->programa}}</h5>
                                    </div>
                                    <!-- <button id="mostrar" name="mostrar" type="input" value="{{ $value->id }}" class="mostrar btn btn-warning text-dark"> -->
                                    <div class=" mb-0 font-weight-bold">
                                        <p>Estudiantes inscritos {{$est}}</p>
                                    </div>
                                    <!-- </button> -->

                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endif
                @endforeach
                @endforeach
            </div>

            <div class="row justify-content-start">
                <div class="col-6 text-center">
                    <div class="card shadow mb-6">
                        <div class="card-header">
                            <h5>Sello financiero</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!--Nav Datos de la Facultad-->
            <nav class="nav nav-pills nav-justified align-content-middle d-flex align-items-center justify-content-center" id="nav" name="nav" style="display: none !important;">
                <a class="nav-link my-auto" href="#estudiantes">
                    <h4>Estudiantes</h4>
                </a>
                <a class="nav-link my-auto" href="#malla">
                    <h4>Malla Curricular</h4>
                </a>
                <a class="nav-link my-auto" href="#planeacion">
                    <h4>Planeacion</h4>
                </a>
            </nav>

            <br>

            <!-- DataTable Estudiantes-->
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

            <!-- DataTable Malla Curricular-->
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

            <!-- DataTable Planeación-->
            <div class="row" id="plan" style="display: none;">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table">
                                <table id="planeacion" class="display" style="width:100%">
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

            grafico();

            function grafico() {
                var idFacultad = '<?php echo $idFacultad; ?>';
                var url = '/home/facultades/datos/' + idFacultad;
                $.getJSON(url, function(data) {
                    console.log(data);
                    var labels = data.data.map(function(elemento) {
                        return elemento.sello;
                    });

                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });

                    // Crear el gráfico circular
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(255, 0, 0, 0.5)', 'rgba(0, 255, 0, 0.5)']
                            }]
                        },
                        options: {
                            
                            widht: 500,
                            height: 500,
                            legend: {
                                labels: {
                                    fontSize: 20 // Establecer el tamaño de la fuente para los labels
                                }
                            }
                        }
                    });
                });
            }
            var id = null;
            $(document).on("click", ".mostrar", function() {
                $(".programas").removeClass("activo");
                $(".programas").addClass("inactivo");
                $(this).removeClass("inactivo");
                $(this).addClass("activo");
                id = $(this).data('valor');
                console.log(id);
                if ($.fn.DataTable.isDataTable("#mall table")) {
                    $("#mall table").DataTable().destroy();
                    $("#malla").empty();
                }
                if ($.fn.DataTable.isDataTable("#plan table")) {
                    $("#plan table").DataTable().destroy();
                    $("#planeacion").empty();
                }
                if ($.fn.DataTable.isDataTable("#est table")) {
                    $("#est table").DataTable().destroy();
                    $("#example").empty();
                }

                /** Mostrar nav y dataTable */
                $("#nav").show();
                $("#est").show();
                /** Eliminar el parametro active de malla y planeacion en el nav */
                $("#nav a[href='#malla']").removeClass("active");
                $("#nav a[href='#planeacion']").removeClass("active");
                $("#nav a[href='#estudiantes']").addClass("active");
                /** Obtener id */
                /** Llamado a la función para cargar dataTable */
                estudiantes(id);
            })

            $("#nav a[href='#malla']").click(function() {

                if ($.fn.DataTable.isDataTable("#est table")) {
                    $("#est table").DataTable().destroy();
                    $("#example").empty();
                }
                if ($.fn.DataTable.isDataTable("#plan table")) {
                    $("#plan table").DataTable().destroy();
                    $("#planeacion").empty();
                }

                $("#est").hide();
                $("#plan").hide();
                $("#mall").show();
                $("#nav a[href='#estudiantes']").removeClass("active");
                $("#nav a[href='#planeacion']").removeClass("active");
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
                if ($.fn.DataTable.isDataTable("#plan table")) {
                    $("#plan table").DataTable().destroy();
                    $("#planeacion").empty();
                }
                $("#mall").hide();
                $("#plan").hide();
                $("#est").show();
                $("#nav a[href='#malla']").removeClass("active");
                $("#nav a[href='#planeacion']").removeClass("active");
                $(this).addClass("active");

                if (!$.fn.DataTable.isDataTable("#est table")) {
                    estudiantes(id);
                }
                return false;
            });

            $("#nav a[href='#planeacion']").click(function() {

                if ($.fn.DataTable.isDataTable("#mall table")) {
                    $("#mall table").DataTable().destroy();
                    $("#malla").empty();
                }
                if ($.fn.DataTable.isDataTable("#est table")) {
                    $("#est table").DataTable().destroy();
                    $("#example").empty();
                }
                $("#mall").hide();
                $("#est").hide();
                $("#plan").show();
                $("#nav a[href='#malla']").removeClass("active");
                $("#nav a[href='#estudiantes']").removeClass("active");
                $(this).addClass("active");


                if (!$.fn.DataTable.isDataTable("#plan table")) {
                    planeacion(id);
                }
                return false;
            });

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

        function planeacion(id) {
            var titleAdded = false;
            var xmlhttp = new XMLHttpRequest();
            var url = "/home/facultades/planeacion/" + id + "";
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    var table = $('#planeacion').DataTable({
                        "data": data.data,
                        "order": [
                            [2, 'asc'],
                            [3, 'asc']
                        ],
                        "columns": [{
                                data: 'codBanner',
                                title: 'Codigo Banner'
                            },
                            {
                                data: 'codMateria',
                                title: 'Codigo Materia'
                            },
                            {
                                data: 'orden',
                                title: 'Orden'
                            },
                            {
                                data: 'semestre',
                                title: 'Semestre'
                            },
                            {
                                data: 'programada',
                                title: 'Programada'
                            },
                            {
                                data: 'codprograma',
                                title: 'Codigo programa'
                            },
                            {
                                data: 'fecha_registro',
                                title: 'Fecha de registro'
                            },
                        ],

                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                        },
                        "drawCallback": function() {
                            if (!titleAdded) {
                                $('.dataTables_wrapper .dataTables_length').before('<h4 class="text-center">Planeación</h4>');
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