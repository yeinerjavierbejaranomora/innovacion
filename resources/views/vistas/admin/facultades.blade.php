<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<!--  creamos el contenido principal body -->

<style>
    #facultades {
        font-size: 14px;
    }

    #programas {
        font-size: 14px;
    }

    .btn {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 200px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
    }

    #botonModalProgramas,
    #botonModalOperador {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 100px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
    }

    #cardFacultades {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    #cardProgramas {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    .card {
        margin-bottom: 3%;
    }

    .hidden {
        display: none;
    }

    #chartEstudiantes {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    #centrar {
        display: flex;
        align-items: center;
    }

    .graficos {
        min-height: 460px;
        max-height: 460px;
    }

    #operadoresTotal,
    #programasTotal {
        height: 600px !important;
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
            <div class="text-center">
                <h1 class="h3 mb-0 text-gray-800"> <strong>Informe Facultad de {{$nombre}}</strong></h1>
            </div>
            <br>
            <div class="text-center" id="mensaje">
                <h4>Aquí puedes visualizar el informe completo de {{$nombre}}, por defecto visualizas toda la
                    información de la facultad, si quieres ver algunos programas en específico, seleccionalos.
                </h4>
            </div>
            <br>

            <!-- Checkbox Facultades -->
            <div class="row justify-content-start" id="">
                <div class="col-6 text-start">
                    <div class="card shadow mb-5" id="cardProgramas">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Programas</strong></h5>
                        </div>
                        <div class="card-body text-star" style="overflow: auto;">
                            <div name="programas" id="programas"></div>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn" type="button" id="generarReporte">
                                Generar Reporte
                            </button>
                        </div>
                    </div>

                </div>
                <div class=" col-6 text-center" id="colEstudiantes">
                    <div class="card shadow mb-5" id="chartEstudiantes">
                        <div class="card-header">
                            <h5 class="titulos"><strong>Total estudiantes Banner</strong></h5>
                            <h5 class="facultadtitulos" style="display: none;"><strong>Estudiantes por Facultad</strong></h5>
                            <h5 class="programastitulos" style="display: none;"><strong>Estudiantes por Programa</strong></h5>
                        </div>
                        <div class="card-body">
                            <div id="vacioTotalEstudiantes" class="text-center vacio" style="display: none;">
                                <h5>No hay datos por mostrar</h5>
                            </div>
                            <canvas id="estudiantes"></canvas>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row justify-content-start mt-5">
            <div class="col-6 text-center" id="colSelloFinanciero">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Total estudiantes con sello financiero</strong></h5>
                        <h5 class="facultadtitulos" style="display: none;"><strong>Sello finaciero por Facultad</strong></h5>
                        <h5 class="programastitulos" style="display: none;"><strong>Sello finaciero por Programa</strong></h5>
                    </div>
                    <div class="card-body">
                        <div id="vacioTotalSello" class="text-center vacio" style="display: none;">
                            <h5>No hay datos por mostrar</h5>
                        </div>
                        <canvas id="activos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colRetencion">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Con Sello de Retención (ASP)</strong></h5>
                        <h5 class="facultadtitulos" style="display: none;"><strong>Con Sello de Retención (ASP) por Facultad</strong></h5>
                        <h5 class="programastitulos" style="display: none;"><strong>Con Sello de Retención (ASP) por Programa</strong></h5>
                    </div>
                    <div class="card-body">
                        <div id="vacioRetencion" class="text-center vacio" style="display: none;">
                            <h5>No hay datos por mostrar</h5>
                        </div>
                        <canvas id="retencion"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colPrimerIngreso">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Estudiantes primer ingreso con tipos de sellos</strong></h5>
                        <h5 class="facultadtitulos" style="display: none;"><strong>Estudiantes primer ingreso con tipos de sellos por Facultad</strong></h5>
                        <h5 class="programastitulos" style="display: none;"><strong>Estudiantes primer ingreso con tipos de sellos por Programa</strong></h5>
                    </div>
                    <div class="card-body">
                        <div id="vacioPrimerIngreso" class="text-center vacio" style="display: none;">
                            <h5>No hay datos por mostrar</h5>
                        </div>
                        <canvas id="primerIngreso"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colTipoEstudiantes">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Tipos de estudiantes</strong></h5>
                        <h5 class="facultadtitulos" style="display: none;"><strong>Tipos de estudiantes por Facultad</strong></h5>
                        <h5 class="programastitulos" style="display: none;"><strong>Tipos de estudiantes por Programa</strong></h5>
                    </div>
                    <div class="card-body">
                        <div id="vacioTipoEstudiante" class="text-center vacio" style="display: none;">
                            <h5>No hay datos por mostrar</h5>
                        </div>
                        <canvas id="tipoEstudiante"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colOperadores">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Operadores</strong></h5>
                        <h5 class="facultadtitulos" style="display: none;"><strong>Operadores por Facultad</strong></h5>
                        <h5 class="programastitulos" style="display: none;"><strong>Operadores por Programa</strong></h5>
                    </div>
                    <div class="card-body">
                        <div id="vacioOperadores" class="text-center vacio" style="display: none;">
                            <h5>No hay datos por mostrar</h5>
                        </div>
                        <canvas id="operadores"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalOperador" class="btn" data-toggle="modal" data-target="#modalOperadoresTotal"> Ver más </a>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colProgramas">
                <div class="card shadow mb-4 graficos" id="ocultarGraficoProgramas">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Programas con mayor cantidad de admitidos</strong></h5>
                        <h5 class="facultadtitulos" style="display: none;"><strong>Programas con mayor cantidad de admitidos por Facultad</strong></h5>
                    </div>
                    <div class="card-body">
                        <div id="vacioProgramas" class="text-center vacio" style="display: none;">
                            <h5>No hay datos por mostrar</h5>
                        </div>
                        <canvas id="estudiantesProgramas"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalProgramas" class="btn" data-toggle="modal" data-target="#modalProgramasTotal"> Ver más </a>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <!-- Modal Todos los Operadores de la Ibero -->
        <div class="modal fade" id="modalOperadoresTotal" tabindex="-1" role="dialog" aria-labelledby="modalOperadoresTotal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Operadores</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <canvas id="operadoresTotal"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Todos los Programas de la Ibero -->
        <div class="modal fade" id="modalProgramasTotal" tabindex="-1" role="dialog" aria-labelledby="modalProgramasTotal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="height:1000px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Programas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <canvas id="programasTotal"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function traerProgramas();
        function traerProgramas() {
            var formData = new FormData();
            formData =('idfacultad[]', "<?=$nombre?>");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('traer.programas') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(datos) {
                    try {
                        datos = jQuery.parseJSON(datos);
                    } catch {
                        datos = datos;
                    }
                    console.log(datos);
                    $.each(datos, function(key, value) {
                        $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}"> ${value.nombre}</label><br>`);
                    });
                }
            })
        }
    </script>

    <!-- incluimos el footer -->
    @include('layout.footer')
</div>







<!-- <script>
        /** Función para mostrar el Nav solo al dar click en el botón 
         * Además de cargar la dataTable dependiendo el nav
         */
        $(document).ready(function() {
            var idFacultad = '';

            graficoActivos();
            graficoRetencion();
            graficoPrimerIngreso();

            function graficoActivos() {
                var url = '/home/facultades/activos/' + idFacultad;
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.sello;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('activos').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map(function(label, index) {
                                return label + 's: ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)']
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                labels: {
                                    render: 'percenteaje',
                                    size: '14',
                                    fontStyle: 'bolder',
                                    position: 'outside',
                                    textMargin: 6
                                },
                                legend: {
                                    labels: {
                                        font: {
                                            size: 14
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                });
            }

            function graficoRetencion() {
                var url = '/home/facultades/retencion/' + idFacultad;
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.autorizado_asistir;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('retencion').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map(function(label, index) {
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)']
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                labels: {
                                    render: 'percenteaje',
                                    size: '14',
                                    fontStyle: 'bolder',
                                    position: 'outside',
                                    textMargin: 6
                                },
                                legend: {
                                    labels: {
                                        // This more specific font property overrides the global property
                                        font: {
                                            size: 14
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                });
            }

            function graficoPrimerIngreso() {
                var url = '/home/facultades/primerIngreso/' + idFacultad;
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.sello;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('primerIngreso').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map(function(label, index) {
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)']
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                labels: {
                                    render: 'percenteaje',
                                    size: '14',
                                    fontStyle: 'bolder',
                                    position: 'outside',
                                    textMargin: 6
                                },
                                legend: {
                                    labels: {
                                        // This more specific font property overrides the global property
                                        font: {
                                            size: 14
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
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
    </script> -->