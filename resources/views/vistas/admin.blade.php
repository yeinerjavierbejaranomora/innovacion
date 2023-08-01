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

    #generarReporte {
        margin-left: 260px;
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

    #botonModalTiposEstudiantes,
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

    #tiposEstudiantesTotal,
    #operadoresTotal,
    #programasTotal {
        height: 600px !important;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
                <h1 class="h3 mb-0 text-gray-800"> <strong>Informe de Facultades</strong></h1>
            </div>
            <br>
            <div class="text-center" id="mensaje">
                <h3>Por defecto se muestran los datos de todas las facultades,
                    si quieres ver datos en especifico, selecciona alguna facultad.
                </h3>
            </div>
            <br>

            <!-- Checkbox Facultades -->
            <div class="row justify-content-start" id="">
                <div class="col-4 text-star">
                    <div class="card shadow mb-5" id="cardFacultades">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Facultades</strong></h5>
                        </div>
                        <div class="card-body text-start" id="centrar" style="overflow: auto;">
                            <div class="facultades" name="facultades" id="facultades">
                                <div>
                                    <label> <input type="checkbox" value="" id="mostrarTodos" checked> Ver Todo</label>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card-footer">
                            <!-- <div class="text-end">
                                <button type="button" id="verProgramas" class="btn btn-warning ocultarFacultades" style="display:none;" data-dismiss="modal">Ver programas</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-4 text-start">
                    <div class="card shadow mb-5" id="cardProgramas">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Programas</strong></h5>
                        </div>
                        <div class="card-body text-star" style="overflow: auto;">
                            <div name="programas" id="programas"></div>
                        </div>
                    </div>
                </div>
                <div class=" col-4 text-center" id="colEstudiantes">
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

            <div class="row">
                <button class="btn" type="button" id="generarReporte">
                    Generar Reporte
                </button>
            </div>

        </div>

        <div class="row justify-content-start mt-5">
            <div class="col-6 text-center" id="colSelloFinanciero">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Estado Financiero</strong></h5>
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
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalTiposEstudiantes" class="btn" data-toggle="modal" data-target="#modalTiposEstudiantes"> Ver más </a>
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

        <!-- Modal Todos los Tipos de estudiantes -->
        <div class="modal fade" id="modalTiposEstudiantes" tabindex="-1" role="dialog" aria-labelledby="modalTiposEstudiantes" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="height:1000px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Tipos de estudiantes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <canvas id="tiposEstudiantesTotal"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        $(document).ready(function() {

            // Deshabilitar los checkboxes cuando comienza una solicitud AJAX
            $(document).ajaxStart(function() {
                $('div #facultades input[type="checkbox"]').prop('disabled', true);
                $('div #programas input[type="checkbox"]').prop('disabled', true);
            });

            // Volver a habilitar los checkboxes cuando finaliza una solicitud AJAX
            $(document).ajaxStop(function() {
                $('div #facultades input[type="checkbox"]').prop('disabled', false);
                $('div #programas input[type="checkbox"]').prop('disabled', false);
            });

            llamadoFunciones();
            facultades();
            /**
             * Llamado a todos los scripts
             */
            function llamadoFunciones() {
                graficoEstudiantes();
                graficoSelloFinanciero();
                graficoRetencion();
                graficoSelloPrimerIngreso();
                graficoTipoDeEstudiante();
                graficoOperadores();
                graficoProgramas();
            }

            function estadoUsuarioPrograma() {
                $("#mensaje").empty();
                if (programasSeleccionados.length > 1) {
                    var programasArray = Object.values(programasSeleccionados);
                    var programasFormateados = programasArray.join(' - ');
                    var textoNuevo = "<h3>Informe programas: " + programasFormateados + " </h3>";
                } else {
                    var textoNuevo = "<h3>Informe programa " + programasSeleccionados + " </h3>";
                }
                $("#mensaje").html(textoNuevo);
            }

            function estadoUsuarioFacultad() {

                $("#mensaje").empty();
                if (facultadesSeleccionadas.length > 1) {
                    var facultadesArray = Object.values(facultadesSeleccionadas);
                    var facultadesFormateadas = facultadesArray.join(' - ');
                    var textoNuevo = "<h3>Informe facultades: " + facultadesFormateadas + " </h3>";
                } else {
                    var textoNuevo = "<h3>Informe facultad " + facultadesSeleccionadas + " </h3>";
                }
                $("#mensaje").show();
                $("#mensaje").html(textoNuevo);
            }

            /**
             * Método que trae las facultades y genera los checkbox en la vista
             */
            function facultades() {
                datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('registro.facultades') }}",
                    method: 'post',
                    success: function(data) {
                        data.forEach(facultad => {
                            $('div #facultades').append(`<label class="ocultarFacultades" style="display: none;"> <input type="checkbox" value="${facultad.nombre}"> ${facultad.nombre}</label><br>`);
                        });
                    }
                });

            }

            var totalSeleccionado

            function Contador() {
                totalSeleccionado = $('#programas input[type="checkbox"]').length;
                totalSeleccionado -= 1;
            }
            /**
             * Método para destruir todos los gráficos
             */
            function destruirGraficos() {
                [chartEstudiantes, chartProgramas, chartEstudiantesActivos, chartRetencion, chartSelloPrimerIngreso, chartTipoEstudiante, chartOperadores].forEach(chart => chart.destroy());
            }

            /**
             * Método que oculta todos los divs de los gráficos, antes de generar algún reporte
             */
            function ocultarDivs() {
                $('#colEstudiantes, #colSelloFinanciero, #colRetencion, #colPrimerIngreso, #colTipoEstudiantes, #colOperadores, #colProgramas').addClass('hidden');
            }

            /**
             * Método que trae la información de toda la Ibero 
             * */
            function informacionGeneral() {
                $('#mensaje').show();
                $('.facultadtitulos').hide();
                $('.titulos').show();
                $('.vacio').hide();
                destruirGraficos();
                llamadoFunciones();
            }

            /**
             * Método que controla el boton de "Ver todo", al ser seleccionado recarga la página 
             * o en caso contrario, muestra las facultades y limpia la página de la data anterior
             * */
            $('body').on('change', '#mostrarTodos', function() {
                if ($('#mostrarTodos').prop('checked')) {
                    location.reload();
                } else {
                    $('.ocultarFacultades').show();
                    destruirGraficos();
                    ocultarDivs();
                }
            });

            var programasSeleccionados = [];
            var facultadesSeleccionadas = [];
            $('#generarReporte').on('click', function(e) {
                e.preventDefault();
                Contador();
                if ($('#programas input[type="checkbox"]:checked').length > 0) {
                    var checkboxesProgramas = $('#programas input[type="checkbox"]:checked');
                    programasSeleccionados = [];
                    checkboxesProgramas.each(function() {
                        programasSeleccionados.push($(this).val());
                    });
                    estadoUsuarioPrograma();
                    graficosporPrograma(programasSeleccionados);
                } else {
                    if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                        if ($('#facultades input[type="checkbox"]:checked').length == totalSeleccionado) {
                            informacionGeneral();
                        } else {
                            $('#mensaje').hide();
                            var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                            programasSeleccionados = [];
                            facultadesSeleccionadas = [];
                            checkboxesSeleccionados.each(function() {
                                facultadesSeleccionadas.push($(this).val());
                            });
                            var long = $('#facultades input[type="checkbox"]:checked').length;
                            if ($('#mostrarTodos').prop('checked')) {
                                location.reload();
                            }
                            estadoUsuarioFacultad();
                            graficosporFacultad(facultadesSeleccionadas);
                        }
                    } else {
                        /** Alerta */

                        programasSeleccionados = [];
                        facultadesSeleccionadas = [];
                        destruirGraficos();
                        ocultarDivs();
                        alerta();
                    }
                }
            });

            function alerta() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar al menos una facultad',
                    confirmButtonColor: '#dfc14e',
                })
            }


            $('body').on('change', '#facultades input[type="checkbox"]', function() {
                if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                    $('#programas').empty();
                    var formData = new FormData();
                    var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                    checkboxesSeleccionados.each(function() {
                        formData.append('idfacultad[]', $(this).val());
                    });

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

                            $.each(datos, function(key, value) {
                                $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}"> ${value.nombre}</label><br>`);
                            });
                        }
                    })
                } else {
                    $('#programas').empty();
                }
            });

            /**
             * Método que muestra el total de estudiantes activos e inactivos
             */
            var chartEstudiantes;

            function graficoEstudiantes() {
                var url = '/home/estudiantes';
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.estado;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('estudiantes').getContext('2d');
                    chartEstudiantes = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map(function(label, index) {
                                label = label.toUpperCase();
                                return label + 'S: ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)']
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    formatter: function(value, context) {
                                        return value;
                                    },
                                },
                                labels: {
                                    render: 'percenteaje',
                                    size: '14',
                                    fontStyle: 'bolder',
                                    position: 'outside',
                                    textMargin: 6
                                },
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                    if (chartEstudiantes.data.labels.length == 0 && chartEstudiantes.data.datasets[0].data.length == 0) {
                        $('#colEstudiantes').addClass('hidden');
                    } else {
                        $('#colEstudiantes').removeClass('hidden');
                    }
                });
            }

            /**
             * Método que genera el gráfico de sello financiero
             */
            var chartEstudiantesActivos;

            function graficoSelloFinanciero() {
                var url = '/home/estudiantesActivos';
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.sello;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('activos').getContext('2d');
                    chartEstudiantesActivos = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label == 'NO EXISTE') {
                                    label = 'SIN SELLO';
                                }
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(56,101,120,1)']
                            }]
                        },
                        options: {
                            responsive: true,
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
                                    position: 'right',
                                    align: 'left',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                    if (chartEstudiantesActivos.data.labels.length == 0 && chartEstudiantesActivos.data.datasets[0].data.length == 0) {
                        $('#colSelloFinanciero').addClass('hidden');
                    } else {
                        $('#colSelloFinanciero').removeClass('hidden');
                    }
                });
            }

            /**
             * Método que genera el gráfico de estudiantes con retención (ASP)
             */
            var chartRetencion;

            function graficoRetencion() {
                var url = '/home/retencionActivos';
                $.getJSON(url, function(data) {

                    var total = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });

                    total = total.reduce((a, b) => a + b, 0);


                    var labels = data.data.map(function(elemento) {

                        return elemento.autorizado_asistir;
                    });
                    var valores = data.data.map(function(elemento) {

                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('retencion').getContext('2d');
                    chartRetencion = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label == '') {
                                    label = 'NO AUTORIZADO A PLATAFORMA'
                                }
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                    'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                ]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            layout: {
                                padding: {
                                    left: 25,
                                    right: 20,
                                },
                            },
                            plugins: {
                                labels: {
                                    render: 'percenteaje',
                                    size: '14',
                                    fontStyle: 'bolder',
                                    display: 'auto',
                                    position: 'outside',
                                    textMargin: 6
                                },
                                legend: {
                                    position: 'right',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        content: 'Total: ' + total,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                    if (chartRetencion.data.labels.length == 0 && chartRetencion.data.datasets[0].data.length == 0) {
                        $('#colRetencion').addClass('hidden');
                    } else {
                        $('#colRetencion').removeClass('hidden');
                    }
                });
            }

            /**
             * Método que genera el gráfico de estudiantes de primer ingreso
             */
            var chartSelloPrimerIngreso;

            function graficoSelloPrimerIngreso() {
                var url = '/home/estudiantesPrimerIngreso';
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.sello;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('primerIngreso').getContext('2d');
                    chartSelloPrimerIngreso = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label == 'NO EXISTE') {
                                    label = 'SIN SELLO';
                                }
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Gráfico Circular',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(56,101,120,1)']
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            layout: {
                                padding: {
                                    left: 20,
                                },
                            },
                            plugins: {
                                labels: {
                                    render: 'percenteaje',
                                    size: '14',
                                    fontStyle: 'bolder',
                                    position: 'outside',
                                    textMargin: 6
                                },
                                legend: {
                                    position: 'right',
                                    labels: {
                                        usePointStyle: true,
                                        padding: 20,
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                    if (chartSelloPrimerIngreso.data.labels.length == 0 && chartSelloPrimerIngreso.data.datasets[0].data.length == 0) {
                        $('#colPrimerIngreso').addClass('hidden');
                    } else {
                        $('#colPrimerIngreso').removeClass('hidden');
                    }
                });

            }

            /**
             * Método que genera el gráfico con todos los tipos de estudiantes 
             */
            var chartTipoEstudiante;

            function graficoTipoDeEstudiante() {
                var url = '/home/tipoEstudiantes';
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.tipoestudiante;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('tipoEstudiante').getContext('2d');
                    chartTipoEstudiante = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label.includes("ESTUDIANTE ")) {
                                    label = label.replace(/ESTUDIANTE\S*/i, "");
                                }
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Tipos de estudiantes',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                    'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                ]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                    if (chartTipoEstudiante.data.labels.length == 0 && chartTipoEstudiante.data.datasets[0].data.length == 0) {
                        $('#colTipoEstudiantes').addClass('hidden');
                    } else {
                        $('#colTipoEstudiantes').removeClass('hidden');
                    }
                });
            }

            /**
             * Método que genera el gráfico con los 5 operadores que mas estudiantes traen 
             */
            var chartOperadores;

            function graficoOperadores() {
                var url = '/home/operadores';
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.operador;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico de barras
                    var ctx = document.getElementById('operadores').getContext('2d');
                    chartOperadores = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label == '') {
                                    label = 'IBERO';
                                }
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Operadores con mayor cantidad de estudiantes',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                    'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                ]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {

                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                    if (chartOperadores.data.labels.length == 0 && chartOperadores.data.datasets[0].data.length == 0) {
                        $('#colOperadores').addClass('hidden');
                    } else {
                        $('#vacioOperadores').removeClass('hidden');
                    }
                });
            }

            /**
             * Método que genera el gráfico con los 5 programas que tienen mas estudiantes inscritos 
             */

            var chartProgramas;

            function graficoProgramas() {
                var url = '/home/estudiantesProgramas';
                $.getJSON(url, function(data) {
                    var labels = data.data.map(function(elemento) {
                        return elemento.codprograma;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    // Crear el gráfico circular
                    var ctx = document.getElementById('estudiantesProgramas').getContext('2d');
                    chartProgramas = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label == '') {
                                    label = 'IBERO';
                                }
                                return label + ': ' + valores[index];
                            }),
                            datasets: [{
                                label: 'Programas con mayor cantidad de estudiantes',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                    'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                ]
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            responsive: true,

                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {

                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                        },
                        plugin: [ChartDataLabels]
                    });
                    if (chartProgramas.data.labels.length == 0 && chartProgramas.data.datasets[0].data.length == 0) {
                        $('#colProgramas').addClass('hidden');
                    } else {
                        $('#colProgramas').removeClass('hidden');
                    }
                });
            }

            /**
             * Método que vacía el contenido de todos los gráficos una vez el usuario desea visualizar unicamente los de alguna facultad
             */

            function graficosporFacultad(facultades) {
                if (chartProgramas || chartEstudiantes || chartEstudiantesActivos || chartRetencion || chartSelloPrimerIngreso ||
                    chartTipoEstudiante || chartOperadores) {
                    destruirGraficos();
                    $(".programastitulos").hide();
                    $(".titulos").hide();
                    $(".facultadtitulos").show();
                    $("#ocultarGraficoProgramas").show();

                    graficoEstudiantesPorFacultades(facultades);
                    graficoSelloFinancieroPorFacultad(facultades);
                    graficoRetencionPorFacultad(facultades);
                    graficoSelloPrimerIngresoPorFacultad(facultades);
                    graficoTiposDeEstudiantesFacultad(facultades);
                    graficoOperadoresFacultad(facultades);
                    graficoProgramasFacultad(facultades);
                }
            }

            /** 
             * Método que muestra los estudiantes activos e inactivos de alguna facultad en específico
             */

            function graficoEstudiantesPorFacultades(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.activos.facultad') }}",
                    data: {
                        idfacultad: facultades
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.estado;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('estudiantes').getContext('2d');
                        chartEstudiantes = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    label = label.toUpperCase();
                                    return label + 'S: ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }

                                },

                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartEstudiantes.data.labels.length == 0 && chartEstudiantes.data.datasets[0].data.length == 0) {
                            $('#colEstudiantes').addClass('hidden');
                        } else {
                            $('#colEstudiantes').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico de sello financiero de alguna facultad en específico
             */
            function graficoSelloFinancieroPorFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.sello.facultad') }}",
                    data: {
                        idfacultad: facultades
                    },

                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.sello;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('activos').getContext('2d');
                        chartEstudiantesActivos = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == 'NO EXISTE') {
                                        label = 'SIN SELLO';
                                    }
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartEstudiantesActivos.data.labels.length == 0 && chartEstudiantesActivos.data.datasets[0].data.length == 0) {
                            $('#colSelloFinanciero').addClass('hidden');
                        } else {
                            $('#colSelloFinanciero').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico ASP de alguna facultad en específico
             */
            function graficoRetencionPorFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.retencion.facultad') }}",
                    data: {
                        idfacultad: facultades
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.autorizado_asistir;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('retencion').getContext('2d');
                        chartRetencion = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == '') {
                                        label = 'NO AUTORIZADO A PLATAFORMA'
                                    }
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartRetencion.data.labels.length == 0 && chartRetencion.data.datasets[0].data.length == 0) {
                            $('#colRetencion').addClass('hidden');
                        } else {
                            $('#colRetencion').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico del sello financiero de los estudiantes de primer ingreso de alguna facultad en específico
             */
            function graficoSelloPrimerIngresoPorFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.primerIngreso.facultad') }}",
                    data: {
                        idfacultad: facultades
                    },

                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.sello;
                        });

                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('primerIngreso').getContext('2d');
                        chartSelloPrimerIngreso = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == 'NO EXISTE') {
                                        label = 'SIN SELLO';
                                    }
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },

                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartSelloPrimerIngreso.data.labels.length == 0 && chartSelloPrimerIngreso.data.datasets[0].data.length == 0) {
                            $('#colPrimerIngreso').addClass('hidden');
                        } else {
                            $('#colPrimerIngreso').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico con los tipos de estudiante por facultad
             */
            function graficoTiposDeEstudiantesFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.tipo.facultad') }}",
                    data: {
                        idfacultad: facultades
                    },

                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.tipoestudiante;
                        });

                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('tipoEstudiante').getContext('2d');
                        chartTipoEstudiante = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Tipos de estudiantes',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartTipoEstudiante.data.labels.length == 0 && chartTipoEstudiante.data.datasets[0].data.length == 0) {
                            $('#colTipoEstudiantes').addClass('hidden');
                        } else {
                            $('#colTipoEstudiantes').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico de los 5 operadores que mas estudiantes traen por facultad
             */
            function graficoOperadoresFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.operador.facultad') }}",
                    data: {
                        idfacultad: facultades
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.operador;
                        });

                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        var ctx = document.getElementById('operadores').getContext('2d');
                        chartOperadores = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == '') {
                                        label = 'IBERO';
                                    }
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Operadores con mayor cantidad de estudiantes',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                    ]
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {

                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartOperadores.data.labels.length == 0 && chartOperadores.data.datasets[0].data.length == 0) {
                            $('#colOperadores').addClass('hidden');
                        } else {
                            $('#colOperadores').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico de los 5 programas con mas estudiantes inscritos por facultad
             */
            function graficoProgramasFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('programas.estudiantes.facultad') }}",
                    data: {
                        idfacultad: facultades
                    },
                    beforeSend: function() {
                        // Deshabilitar los checkboxes antes de la solicitud AJAX
                        $('div #facultades input[type="checkbox"]').prop('disabled', true);
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.codprograma;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        var ctx = document.getElementById('estudiantesProgramas').getContext('2d');
                        chartProgramas = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Operadores con mayor cantidad de estudiantes',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                    ]
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {

                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartProgramas.data.labels.length == 0 && chartProgramas.data.datasets[0].data.length == 0) {
                            $('#colProgramas').addClass('hidden');
                        } else {
                            $('#colProgramas').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que limpia la data de los gráficos y después invoca todos los gráficos por los 
             * programas que seleccione el usuario
             */
            function graficosporPrograma(programas) {
                if (chartProgramas || chartEstudiantes || chartEstudiantesActivos || chartRetencion || chartSelloPrimerIngreso ||
                    chartTipoEstudiante || chartOperadores) {
                    destruirGraficos();

                    $(".facultadtitulos").hide();
                    $(".titulos").hide();
                    $(".vacio").hide();
                    $(".programastitulos").show();
                    $("#ocultarGraficoProgramas").hide();

                    graficoEstudiantesPorPrograma(programas);
                    grafioSelloFinancieroPorPrograma(programas);
                    graficoRetencionPorPrograma(programas);
                    graficoSelloPrimerIngresoPorPrograma(programas);
                    graficoTiposDeEstudiantesPrograma(programas);
                    graficoOperadoresPrograma(programas);
                }
            }

            /** 
             * Método que muestra los estudiantes activos e inactivos de algún programa en específico
             */
            function graficoEstudiantesPorPrograma(programas) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.activos.programa') }}",
                    data: {
                        programa: programas
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.estado;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('estudiantes').getContext('2d');
                        chartEstudiantes = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    label = label.toUpperCase();
                                    return label + 'S: ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartEstudiantes.data.labels.length == 0 && chartEstudiantes.data.datasets[0].data.length == 0) {
                            $('#colEstudiantes').addClass('hidden');
                        } else {
                            $('#colEstudiantes').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico de sello financiero de algún programa en específico
             */
            function grafioSelloFinancieroPorPrograma(programas) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.sello.programa') }}",
                    data: {
                        programa: programas
                    },

                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.sello;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('activos').getContext('2d');
                        chartEstudiantesActivos = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == 'NO EXISTE') {
                                        label = 'SIN SELLO';
                                    }
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartEstudiantesActivos.data.labels.length == 0 && chartEstudiantesActivos.data.datasets[0].data.length == 0) {
                            $('#colSelloFinanciero').addClass('hidden');
                        } else {
                            $('#colSelloFinanciero').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico ASP de algún programa en específico
             */
            function graficoRetencionPorPrograma(programas) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.retencion.programa') }}",
                    data: {
                        programa: programas
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.autorizado_asistir;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('retencion').getContext('2d');
                        chartRetencion = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == '') {
                                        label = 'NO AUTORIZADO A PLATAFORMA'
                                    }
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartRetencion.data.labels.length == 0 && chartRetencion.data.datasets[0].data.length == 0) {
                            $('#colRetencion').addClass('hidden');
                        } else {
                            $('#colRetencion').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico del sello financiero de los estudiantes de primer ingreso de algún programa en específico
             */
            function graficoSelloPrimerIngresoPorPrograma(programas) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.primerIngreso.programa') }}",
                    data: {
                        programa: programas
                    },

                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.sello;
                        });

                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('primerIngreso').getContext('2d');
                        chartSelloPrimerIngreso = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == 'NO EXISTE') {
                                        label = 'SIN SELLO';
                                    }
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: function(value, context) {
                                            return value;
                                        },
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'outside',
                                        textMargin: 6
                                    },
                                    legend: {
                                        position: 'right',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20,
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },

                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartSelloPrimerIngreso.data.labels.length == 0 && chartSelloPrimerIngreso.data.datasets[0].data.length == 0) {
                            $('#colPrimerIngreso').addClass('hidden');
                        } else {
                            $('#colPrimerIngreso').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico con los tipos de estudiante por programa
             */
            function graficoTiposDeEstudiantesPrograma(programas) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.tipo.programa') }}",
                    data: {
                        programa: programas
                    },

                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.tipoestudiante;
                        });

                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('tipoEstudiante').getContext('2d');
                        chartTipoEstudiante = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    label = label.toUpperCase();
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Tipos de estudiantes',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)']
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartTipoEstudiante.data.labels.length == 0 && chartTipoEstudiante.data.datasets[0].data.length == 0) {
                            $('#colTipoEstudiantes').addClass('hidden');
                        } else {
                            $('#colTipoEstudiantes').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico de los 5 operadores que mas estudiantes traen por facultad
             */
            function graficoOperadoresPrograma(programas) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.operador.programa') }}",
                    data: {
                        programa: programas
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.operador;
                        });

                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        var ctx = document.getElementById('operadores').getContext('2d');
                        chartOperadores = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == '') {
                                        label = 'IBERO';
                                    }
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Operadores con mayor cantidad de estudiantes',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                    ]
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {

                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                        if (chartOperadores.data.labels.length == 0 && chartOperadores.data.datasets[0].data.length == 0) {
                            $('#colOperadores').addClass('hidden');
                        } else {
                            $('#colOperadores').removeClass('hidden');
                        }
                    }
                });
            }


            $('#botonModalOperador').on("click", function(e) {
                e.preventDefault();
                if (chartOperadoresTotal) {
                    chartOperadoresTotal.destroy();
                }
                graficoOperadoresTotal();
            });

            $('#botonModalProgramas').on("click", function(e) {
                e.preventDefault();
                if (chartProgramasTotal) {
                    chartProgramasTotal.destroy();
                }
                graficoProgramasTotal();
            });

            $('#botonModalTiposEstudiantes').on("click", function(e) {
                e.preventDefault();
                if (chartTiposEstudiantesTotal) {
                    chartTiposEstudiantesTotal.destroy();
                }
                tiposEstudiantesTotal();
            });

            var chartTiposEstudiantesTotal

            function tiposEstudiantesTotal() {
                if (programasSeleccionados.length > 0) {
                    var url = "{{ route('tiposEstudiantes.programa.estudiantes') }}";
                    var data = {
                        programa: programasSeleccionados
                    }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        var url = "{{ route('tiposEstudiantes.facultad.estudiantes') }}";
                        var data = {
                            idfacultad: facultadesSeleccionadas
                        }
                    } else {
                        var url = "{{ route('tiposEstudiantes.total.estudiantes') }}";
                        data = '';
                    }
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.tipoestudiante;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico de barras
                        var ctx = document.getElementById('tiposEstudiantesTotal').getContext('2d');
                        chartTiposEstudiantesTotal = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Tipos de esudiantes',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                    ]
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {

                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                    }
                });

            }

            /**
             * Método que trae todos los operadores de la Ibero
             */
            var chartOperadoresTotal;

            function graficoOperadoresTotal() {
                if (programasSeleccionados.length > 0) {
                    var url = "{{ route('operadores.programa.estudiantes') }}";
                    var data = {
                        programa: programasSeleccionados
                    }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        var url = "{{ route('operadores.facultad.estudiantes') }}";
                        var data = {
                            idfacultad: facultadesSeleccionadas
                        }
                    } else {
                        var url = "{{ route('operadoresTotal.estudiantes') }}";
                        data = '';
                    }
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.operador;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico de barras
                        var ctx = document.getElementById('operadoresTotal').getContext('2d');
                        chartOperadoresTotal = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == '') {
                                        label = 'IBERO';
                                    }
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Operadores ordenados de forma descendente',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                    ]
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {

                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                    }
                });

            }

            /**
             * Método que trae todos los programas de la Ibero
             */
            var chartProgramasTotal;

            function graficoProgramasTotal() {
                if (facultadesSeleccionadas.length > 0) {
                    var url = "{{ route('FacultadTotal.estudiantes') }}";
                    var data = {
                        idfacultad: facultadesSeleccionadas
                    }
                } else {
                    var url = "{{ route('programasTotal.estudiantes') }}";
                    data = '';
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var labels = data.data.map(function(elemento) {
                            return elemento.codprograma;
                        });
                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        // Crear el gráfico circular
                        var ctx = document.getElementById('programasTotal').getContext('2d');
                        chartProgramasTotal = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    label: 'Programas',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                    ]
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,

                                plugins: {
                                    legend: {
                                        position: 'bottom',
                                        labels: {

                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                },
                            },
                            plugin: [ChartDataLabels]
                        });
                    }
                });
            }

        });
    </script>



    <!-- incluimos el footer -->
    @include('layout.footer')
</div>