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

    #buscarProgramas {
        background-color: #dfc14e;
        border-color: #dfc14e;
        width: 150px;
        padding: 10px 30px;
        border-radius: 10px;
    }

    #cardFacultades {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    #cardProgramas {
        min-height: 405.6px;
        max-height: 405.6px;
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
        min-height: 420px;
        max-height: 420px;
    }

    
</style>
<script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-core.min.js"></script>
<script src="https://cdn.anychart.com/releases/8.0.1/js/anychart-pie.min.js"></script>
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
            <div class="row justify-content-center" id="">
                <div class="col-4">
                    <div class="card shadow mb-4" id="cardFacultades">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Facultades</strong></h5>
                        </div>
                        <div class="card-body text-start" id="centrar" style="overflow: auto;">
                            <div class="facultades" name="facultades" id="facultades"></div>
                            <!-- <button type="button" class="btn btn-warning" id="buscarProgramas">Seleccionar</button> -->
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card shadow mb-4" id="cardProgramas">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Programas</strong></h5>
                        </div>
                        <div class="card-body text-star" style="overflow: auto;">
                            <div name="programas" id="programas"></div>
                        </div>
                    </div>
                </div>
                <div class=" col-4 text-center">
                    <div class="card shadow mb-5" id="chartEstudiantes">
                        <div class="card-header">
                            <h5><strong>Total estudiantes Banner</strong></h5>
                        </div>
                        <div class="card-body">
                            <canvas id="estudiantes"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5><strong>Total estudiantes con sello financiero</strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="activos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5><strong>Con Sello de Retención (ASP)</strong></h5>
                    </div>
                    <div class="card-body">
                                <canvas id="retencion"></canvas> 
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5><strong>Estudiantes primer ingreso con tipos de sellos</strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="primerIngreso"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5><strong>Tipos de estudiantes</strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="tipoEstudiante"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5><strong>Operadores</strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="operadores"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center">
                <div class="card shadow mb-4 graficos">
                    <div class="card-header">
                        <h5><strong>Programas con mayor cantidad de admitidos</strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="estudiantesProgramas"></canvas>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <script>
        /**
         * Llamado a todos los scripts
         */
        facultades();
        graficoEstudiantes();
        graficoEstudiantesActivos();
        graficoRetencion();
        graficoSelloPrimerIngreso();
        graficoTipoDeEstudiante();
        graficoOperadores();
        graficoProgramas()

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
                        $('div #facultades').append(`<label> <input type="checkbox" value="${facultad.nombre}"> ${facultad.nombre}</label><br>`);
                    });
                }
            });

        }

        /**
         * Método que trae los programas correspondientes a cada facultad según 
         * los checkbox marcados
         */
        $('body').on('change', '#facultades input[type="checkbox"]', function() {
            if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                $('#mensaje').hide();
                $('#programas').empty();
                var formData = new FormData();
                const valoresSeleccionados = [];
                var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                checkboxesSeleccionados.each(function() {
                    valoresSeleccionados.push($(this).val());
                    formData.append('idfacultad[]', $(this).val());
                });

                graficosporFacultad(valoresSeleccionados);

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
                        datos = jQuery.parseJSON(datos);

                        $.each(datos, function(key, value) {
                            $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.id}"> ${value.nombre}</label><br>`);
                        });
                    }
                })
            } else {
                $('#mensaje').show();
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
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        },
                    },
                    plugin: [ChartDataLabels]
                });
            });
        }

        /**
         * Método que genera el gráfico de sello financiero
         */
        var chartEstudiantesActivos;

        function graficoEstudiantesActivos() {
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
                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        },
                    },
                    plugin: [ChartDataLabels]
                });
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
                // create the chart
  var chartRetencion = anychart.pie();

// set the chart title
chartRetencion.title("Population by Race for the United States: 2010 Census");

// add the data
chartRetencion.data(data);

// display the chart in the container
chartRetencion.container('retencion');
chartRetencion.draw();

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

                                    font: {
                                        size: 12
                                    }
                                }
                            }
                        },
                    },
                    plugin: [ChartDataLabels]
                });
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
                    type: 'pie',
                    data: {
                        labels: labels.map(function(label, index) {
                            if (label.includes("ESTUDIANTE ")) {
                                label = label.replace(/ESTUDIANTE\S*/i, "");
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

                        plugins: {
                            labels: {
                                render: 'percentage',
                                size: '14',
                                fontStyle: 'bolder',
                                position: 'outside',
                                textMargin: 6
                            },
                            legend: {
                                position: 'right',
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
                // Crear el gráfico circular
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
                            backgroundColor: ['rgba(74, 72, 72, 1)']
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

            });
        }

        function graficosporFacultad(facultades) {
            console.log(facultades);
            if (chartProgramas && chartEstudiantes && chartEstudiantesActivos && chartRetencion && chartSelloPrimerIngreso &&
                chartTipoEstudiante && chartOperadores) {
                [chartEstudiantes, chartProgramas, chartEstudiantesActivos, chartRetencion, chartSelloPrimerIngreso, chartTipoEstudiante, chartOperadores].forEach(chart => chart.destroy());
            }

            graficoEstudiantesPorFacultades(facultades);
        }

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
                    console.log(data);

                    var labels = data.data.map(function(elemento) {
                        return elemento.estado;
                    });
                    console.log (labels);
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


    </script>

    <!-- incluimos el footer -->
    @include('layout.footer')
</div>