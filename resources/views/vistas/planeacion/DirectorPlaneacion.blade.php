@include('layout.header')

@include('menus.menu_Director')
<!--  creamos el contenido principal body -->

<style>
    #facultades {
        font-size: 14px;
    }

    #programas {
        font-size: 14px;
    }

    #generarReporte {
        width: 250px;
        height: 45px;
        font-size: 20px;
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

    #cardProgramas,
    #cardPeriodos {
        min-height: 250px;
        max-height: 250px;
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


    .graficos {
        min-height: 460px;
        max-height: 460px;
    }

    .graficosBarra {
        min-height: 600px;
        max-height: 600px;
    }

    #tiposEstudiantesTotal,
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
                <h1 class="h3 mb-0 text-gray-800"> <strong>Informe Programas</strong></h1>
            </div>
            <br>
            <div class="text-center" id="mensaje">
                <h3>A continuación podrás visualizar los datos de tus Programas:

                    @foreach ($programas as $programa)
                    {{$programa->codprograma}} -
                    @endforeach
                </h3>
            </div>
            <br>

            <!-- Checkbox Facultades -->
            <div class="row justify-content-center" ">
            <div class=" col-6 text-star">
                <div class="card shadow mb-5" id="cardPeriodos">
                    <div class="card-header text-center">
                        <h5><strong>Seleccionar Periodos</strong></h5>
                    </div>
                    <div class="card-body text-start" id="centrar" style="overflow: auto;">
                        <div name="periodos" id="periodos">
                        </div>
                    </div>
                    <div class="card-footer text-center" style="height: 55px;">
                        <button type="button" id="deshacerPeriodos" class="btn deshacer">Deshacer Todos</button>
                        <button type="button" id="seleccionarPeriodos" class="btn deshacer">Seleccionar Todos</button>
                    </div>
                </div>
            </div>
            <div class=" col-6 text-start" id="colCardProgramas">
                <div class="card shadow mb-5" id="cardProgramas">
                    <div class="card-header text-center">
                        <h5><strong>Seleccionar Programas</strong></h5>
                    </div>
                    <div class="card-body text-star" style="overflow: auto;">
                        <div name="programas" id="programas">
                            @foreach ($programas as $programa)
                            <label class="idProgramas"> <input type="checkbox" value="{{$programa->codprograma}}" checked> {{$programa->programa}}</label><br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center justify-content-center">
            <button class="btn" type="button" id="generarReporte">
                Generar Reporte
            </button>
        </div>

        <div class="row justify-content-start mt-5">
            <div class="col-6 text-center" id="colSelloFinanciero">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 id="tituloEstadoFinanciero"><strong>Estado Financiero</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="activos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colRetencion">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 id="tituloRetencion"><strong>Estado Financiero - Retención</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="retencion"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colPrimerIngreso">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 id="tituloEstudiantesNuevos"><strong>Estudiantes nuevos - Estado Financiero</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="primerIngreso"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colTipoEstudiantes">
                <div class="card shadow mb-6 graficosBarra">
                    <div class="card-header">
                        <h5 id="tituloTipos"><strong>Tipos de estudiantes</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="tipoEstudiante"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalTiposEstudiantes" class="btn" data-toggle="modal" data-target="#modalTiposEstudiantes"> Ver más </a>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colOperadores">
                <div class="card shadow mb-6 graficosBarra">
                    <div class="card-header">
                        <h5 id="tituloOperadores"><strong>Operadores</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="operadores"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalOperador" class="btn" data-toggle="modal" data-target="#modalOperadoresTotal"> Ver más </a>
                    </div>
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

        var tabla = <?php echo json_encode($tabla); ?>;
        console.log(tabla);
        programasUsuario();
        Contador();
        vistaEntrada();

        var periodosSeleccionados = [];
        periodos();
        invocarGraficos();
        getPeriodos();

        var totalSeleccionado;
        var totalPeriodos;

        var programasSeleccionados = [];

        var programasSelect;

        // Deshabilitar los checkboxes cuando comienza una solicitud AJAX
        $(document).ajaxStart(function() {
            $('div #programas input[type="checkbox"]').prop('disabled', true);
            $('#generarReporte').prop("disabled", true);
        });

        // Volver a habilitar los checkboxes cuando finaliza una solicitud AJAX
        $(document).ajaxStop(function() {
            $('div #programas input[type="checkbox"]').prop('disabled', false);
            $('#generarReporte').prop("disabled", false);
        });

        function programasUsuario() {
            <?php
            $datos = array();
            foreach ($programas as $programa) {
                $datos[] = $programa->codprograma;
            }
            ?>;
            programasSeleccionados = <?php echo json_encode($datos); ?>;
            programasSelect = programasSeleccionados;
        }

        /**
         * Método que trae los periodos activos
         */
        function periodos() {
            var datos = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('periodos.activos') }}",
                method: 'post',
                async: false,
                success: function(data) {
                    data.forEach(periodo => {
                        periodosSeleccionados.push(periodo.periodos);
                        $('div #periodos').append(`<label"> <input type="checkbox" value="${periodo.periodos}" checked> ${periodo.periodos}</label><br>`);
                    });
                }
            });
            console.log(periodosSeleccionados);
        }

        function vistaEntrada() {
            var key = Object.keys(programasSelect);
            var cantidadProgramas = key.length;
            var valorPrograma = programasSelect[key[0]];

            if (cantidadProgramas === 1) {
                $('#colCardProgramas').hide();
                var textoNuevo = "<h3>A continuación podrás visualizar los datos de tu Programa: " + valorPrograma + " </h3>";
                $("#mensaje").html(textoNuevo);
            }

        }

        function getPeriodos() {
            periodosSeleccionados = [];
            var checkboxesSeleccionados = $('#periodos input[type="checkbox"]:checked');
            checkboxesSeleccionados.each(function() {
                periodosSeleccionados.push($(this).val());
            });
            return periodosSeleccionados;
        }

        /**
         * Método que trae los gráficos de la vista
         */
        function invocarGraficos() {
            grafioSelloFinanciero();
            graficoRetencion();
            graficoSelloPrimerIngreso();
            graficoTiposDeEstudiantes();
            graficoOperadores();
        }

        $('#deshacerPeriodos').on('click', function(e) {
            $('#periodos input[type="checkbox"]').prop('checked', false);
        });

        $('#seleccionarPeriodos').on('click', function(e) {
            $('#periodos input[type="checkbox"]').prop('checked', true);
        });

        /**
         * Método que oculta todos los divs de los gráficos, antes de generar algún reporte
         */
        function ocultarDivs() {
            $('#colEstudiantes, #colSelloFinanciero, #colRetencion, #colPrimerIngreso, #colTipoEstudiantes, #colOperadores, #colProgramas').addClass('hidden');
        }

        /**
         * Método que cuenta la cantidad de programas de la facultad correspondiente
         */
        function Contador() {
            totalSeleccionado = $('#programas input[type="checkbox"]').length;
            totalPeriodos = $('#periodos input[type="checkbox"]').length;
        }

        function limpiarTitulos() {
            var elementosTitulos = $('#tituloEstudiantes, #tituloEstadoFinanciero, #tituloRetencion, #tituloEstudiantesNuevos, #tituloTipos, #tituloOperadores').find("strong");
            var parteEliminar = ': ';
            elementosTitulos.each(function() {
                var contenidoActual = $(this).text();
                var contenidoLimpio = contenidoActual.replace(new RegExp(parteEliminar + '.*'), '');
                $(this).text(contenidoLimpio);
            });
            var parteTituloEliminar = 'Periodo: ';
            var titulosPeriodos = $('.tituloPeriodo').find("strong");
            titulosPeriodos.each(function() {
                var contenidoActual = $(this).text();
                var contenidoLimpio = contenidoActual.replace(new RegExp(parteTituloEliminar + '.*'), '');
                $(this).text(contenidoLimpio);
            });
        }


        function estadoUsuario() {
            limpiarTitulos();
            var periodos = getPeriodos();
            $("#mensaje").empty();
            var periodosArray = Object.values(periodos);
            var periodosFormateados = periodosArray.map(function(periodo) {
                return periodo.replace(/2023/, '').trim();
            }).join(' - ');

            if (programasSeleccionados.length > 1) {
                var programasArray = Object.values(programasSeleccionados);
                var programasFormateados = programasArray.join(' - ');
                var textoNuevo = "<h4><strong>Informe programas: " + programasFormateados + "</strong></h4>";
                $('#tituloEstudiantes strong, #tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong').append(': ' + programasFormateados);
            } else {
                var textoNuevo = "<h4><strong>Informe programa " + programasSeleccionados + "</strong></h4>";
                $('#tituloEstudiantes strong, #tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong').append(': ' + programasSeleccionados);
            }
            $('.tituloPeriodo strong').append('Periodo: ' + periodosFormateados);
            $("#mensaje").show();
            $("#mensaje").html(textoNuevo);
        }

        /**
         * Método para destruir todos los gráficos
         */
        function destruirGraficos() {
            [chartEstudiantesActivos, chartRetencion, chartSelloPrimerIngreso, chartTipoEstudiante, chartOperadores].forEach(chart => chart.destroy());
        }

        /**
         * Controlador del botón mostrarTodos
         */

        function alerta() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes seleccionar al menos un programa',
                confirmButtonColor: '#dfc14e',
            })
        }

        function alertaPeriodo() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes seleccionar al menos un periodo',
                confirmButtonColor: '#dfc14e',
            })
        }

        /**
         * Controlador botón generarReporte
         */

        $('#generarReporte').on('click', function(e) {
            e.preventDefault();
            var periodosSeleccionados = getPeriodos();
            Contador();
            if(periodosSeleccionados.length > 0){
            if ($('#programas input[type="checkbox"]:checked').length > 0) {
                if ($('#programas input[type="checkbox"]:checked').length == totalSeleccionado && periodosSeleccionados.length == totalPeriodos) {
                    location.reload();
                }
                var checkboxesProgramas = $('#programas input[type="checkbox"]:checked');
                programasSeleccionados = [];
                checkboxesProgramas.each(function() {
                    programasSeleccionados.push($(this).val());
                });
                console.log(programasSeleccionados);
                estadoUsuario();
                graficosporPrograma();
            } else {
                programasSeleccionados = [];
                $("#mensaje").empty();
                destruirGraficos();
                ocultarDivs();
                alerta();
            }
            }
         else{
            programasSeleccionados = [];
            periodosSeleccionados = [];
            $("#mensaje").empty();
            destruirGraficos();
            ocultarDivs();
            alertaPeriodo();
            }
        });

        function graficosporPrograma() {
            if (chartEstudiantesActivos || chartRetencion || chartSelloPrimerIngreso ||
                chartTipoEstudiante || chartOperadores) {
                destruirGraficos();
            }
            $(".facultadtitulos").hide();
            $(".programastitulos").show();
            $("#ocultarGraficoProgramas").hide();

            invocarGraficos();
        }

        /**
         * Método que genera el gráfico de sello financiero de algún programa en específico
         */
        var chartEstudiantesActivos;

        function grafioSelloFinanciero() {
            var url = "{{ route('estudiantes.sello.programa',['tabla' => ' ']) }}" + tabla;
            var data = {
                programa: programasSeleccionados,
                periodos: periodosSeleccionados
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
        var chartRetencion;

        function graficoRetencion() {

            var url = "{{ route('estudiantes.retencion.programa',['tabla' => ' ']) }}" + tabla;
            var data = {
                programa: programasSeleccionados,
                periodos: periodosSeleccionados
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
        var chartSelloPrimerIngreso;

        function graficoSelloPrimerIngreso() {

            var url = "{{ route('estudiantes.primerIngreso.programa',['tabla' => ' ']) }}" + tabla;
            var data = {
                programa: programasSeleccionados,
                periodos: periodosSeleccionados
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
        var chartTipoEstudiante;

        function graficoTiposDeEstudiantes() {

            var url = "{{ route('estudiantes.tipo.programa',['tabla' => ' ']) }}" + tabla;
            var data = {
                programa: programasSeleccionados,
                periodos: periodosSeleccionados
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
                        return elemento.tipo_estudiante;
                    });

                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    var maxValor = Math.max(...valores);
                    var maxValorAux = Math.ceil(maxValor / 1000) * 1000;
                    var yMax;
                    if (maxValor < 50) {
                        yMax = 100;
                    } else if (maxValor < 100) {
                        yMax = 120;
                    } else if (maxValor < 500) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 100;
                    } else if (maxValor < 1000) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 200;
                    } else {
                        var maxValorAux = 1000 * Math.ceil(maxValor / 1000);
                        yMax = (maxValorAux - maxValor) < 600 ? maxValorAux + 1000 : maxValorAux;
                    }
                    // Crear el gráfico circular
                    var ctx = document.getElementById('tipoEstudiante').getContext('2d');
                    chartTipoEstudiante = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels.map(function(label, index) {
                                label = label.toUpperCase();
                                return label;
                            }),
                            datasets: [{
                                label: 'Tipos de estudiantes',
                                data: valores,
                                backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)', 'rgba(56,101,120,1)'],
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                }
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    max: yMax,
                                    beginAtZero: true
                                }
                            },
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: 'black',
                                    font: {
                                        weight: 'semibold'
                                    },
                                    formatter: Math.round
                                },
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
                        plugins: [ChartDataLabels]
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
        var chartOperadores;

        function graficoOperadores() {
            url = "{{ route('estudiantes.operador.programa',['tabla' => ' ']) }}" + tabla;
            data = {
                programa: programasSeleccionados,
                periodos: periodosSeleccionados
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
                    var maxValor = Math.max(...valores);
                    var maxValorAux = Math.ceil(maxValor / 1000) * 1000;
                    var yMax;
                    if (maxValor < 50) {
                        yMax = 100;
                    } else if (maxValor < 100) {
                        yMax = 120;
                    } else if (maxValor < 500) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 100;
                    } else if (maxValor < 1000) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 200;
                    } else {
                        var maxValorAux = 1000 * Math.ceil(maxValor / 1000);
                        yMax = (maxValorAux - maxValor) < 600 ? maxValorAux + 1000 : maxValorAux;
                    }
                    var ctx = document.getElementById('operadores').getContext('2d');
                    chartOperadores = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label == '') {
                                    label = 'IBERO';
                                }
                                return label;
                            }),
                            datasets: [{
                                label: 'Operadores con mayor cantidad de estudiantes',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                    'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                ],
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                }
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    max: yMax,
                                    beginAtZero: true
                                }
                            },
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: 'black',
                                    font: {
                                        weight: 'semibold'
                                    },
                                    formatter: Math.round
                                },
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
                        plugins: [ChartDataLabels]
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


        $('#botonModalTiposEstudiantes').on("click", function(e) {
            e.preventDefault();
            if (chartTiposEstudiantesTotal) {
                chartTiposEstudiantesTotal.destroy();
            }
            tiposEstudiantesTotal();
        });

        var chartTiposEstudiantesTotal

        function tiposEstudiantesTotal() {
            var data;
            var url = "{{ route('tiposEstudiantes.programa.estudiantes',['tabla' => ' ']) }}" + tabla;
            if (programasSeleccionados.length > 0) {
                data = {
                    programa: programasSeleccionados,
                    periodos: periodosSeleccionados
                }
            } else {
                data = {
                    programa: programasSelect,
                    periodos: periodosSeleccionados
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
                        return elemento.tipo_estudiante;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    var maxValor = Math.max(...valores);
                    var maxValorAux = Math.ceil(maxValor / 1000) * 1000;
                    var yMax;
                    if (maxValor < 50) {
                        yMax = 100;
                    } else if (maxValor < 100) {
                        yMax = 120;
                    } else if (maxValor < 500) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 100;
                    } else if (maxValor < 1000) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 200;
                    } else {
                        var maxValorAux = 1000 * Math.ceil(maxValor / 1000);
                        yMax = (maxValorAux - maxValor) < 600 ? maxValorAux + 1000 : maxValorAux;
                    }
                    // Crear el gráfico de barras
                    var ctx = document.getElementById('tiposEstudiantesTotal').getContext('2d');
                    chartTiposEstudiantesTotal = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels.map(function(label, index) {
                                return label;
                            }),
                            datasets: [{
                                label: 'Tipos de esudiantes',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                    'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                ],
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                }
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    max: yMax,
                                    beginAtZero: true
                                }
                            },
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: 'black',
                                    font: {
                                        weight: 'light',
                                        size: 8
                                    },
                                    formatter: Math.round
                                },
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
                        plugins: [ChartDataLabels]
                    });
                }
            });

        }
        /**
         * Método que trae todos los operadores de la Facultad
         */
        var chartOperadoresTotal;

        function graficoOperadoresTotal() {
            var data;
            var url = "{{ route('operadores.programa.estudiantes',['tabla' => ' ']) }}" + tabla;
            if (programasSeleccionados.length > 0) {
                data = {
                    programa: programasSeleccionados,
                    periodos: periodosSeleccionados
                }
            } else {
                data = {
                    programa: programasSelect,
                    periodos: periodosSeleccionados
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
                    try {
                        data = jQuery.parseJSON(data);
                    } catch {
                        data = data;
                    }
                    var labels = data.data.map(function(elemento) {
                        return elemento.operador;
                    });
                    var valores = data.data.map(function(elemento) {
                        return elemento.TOTAL;
                    });
                    var maxValor = Math.max(...valores);
                    var maxValorAux = Math.ceil(maxValor / 1000) * 1000;
                    var yMax;
                    if (maxValor < 50) {
                        yMax = 100;
                    } else if (maxValor < 100) {
                        yMax = 120;
                    } else if (maxValor < 500) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 100;
                    } else if (maxValor < 1000) {
                        yMax = 100 * Math.ceil(maxValor / 100) + 200;
                    } else {
                        var maxValorAux = 1000 * Math.ceil(maxValor / 1000);
                        yMax = (maxValorAux - maxValor) < 600 ? maxValorAux + 1000 : maxValorAux;
                    }
                    // Crear el gráfico de barras
                    var ctx = document.getElementById('operadoresTotal').getContext('2d');
                    chartOperadoresTotal = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels.map(function(label, index) {
                                if (label == '') {
                                    label = 'IBERO';
                                }
                                return label;
                            }),
                            datasets: [{
                                label: 'Operadores ordenados de forma descendente',
                                data: valores,
                                backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                    'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                ],
                                datalabels: {
                                    anchor: 'end',
                                    align: 'top',
                                }
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    max: yMax,
                                    beginAtZero: true
                                }
                            },
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: 'black',
                                    font: {
                                        weight: 'light',
                                        size: 8
                                    },
                                    formatter: Math.round
                                },
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
                        plugins: [ChartDataLabels]
                    });
                }
            });

        }
    });
</script>

<!-- incluimos el footer -->
@include('layout.footer')
</div>