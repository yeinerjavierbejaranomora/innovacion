<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<!--  creamos el contenido principal body -->
<style>
    #facultades {
        font-size: 18px;
    }

    #buscarProgramas {
        background-color: #dfc14e;
        border-color: #dfc14e;
        width: 150px;
        padding: 10px 30px;
        border-radius: 10px;
    }

    #cardFacultades {
        max-height: 280.22px;
    }

    #cardProgramas {
        min-height: 280.22px;
        max-height: 280.22px;
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
            <div class="row justify-content-center" id="">
                <div class="col-4">
                    <div class="card shadow mb-4" id="cardFacultades">
                        <div class="card-header text-center">
                            <h4><strong>Seleccionar Facultades</strong></h4>
                        </div>
                        <div class="card-body text-start" style="overflow: auto;">
                            <div class="facultades" name="facultades" id="facultades"></div>
                            <!-- <button type="button" class="btn btn-warning" id="buscarProgramas">Seleccionar</button> -->
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card shadow mb-4" id="cardProgramas">
                        <div class="card-header text-center">
                            <h4><strong>Seleccionar Programas</strong></h4>
                        </div>
                        <div class="card-body text-star" style="overflow: auto;">
                            <div name="programas" id="programas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-start" id="graficos">
            <div class=" col-4 text-center">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4><strong>Total estudiantes Banner</strong></h4>
                    </div>
                    <div class="card-body">
                        <canvas id="estudiantes"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4><strong>Activos - Sello Financiero</strong></h4>
                    </div>
                    <div class="card-body">
                        <canvas id="activos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4><strong>Activos con Retención</strong></h4>
                    </div>
                    <div class="card-body">
                        <canvas id="retencion"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        facultades();
        graficoEstudiantes();
        graficoEstudiantesActivos();
        graficoRetencionActivos()

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

        $('body').on('change', '#facultades input[type="checkbox"]', function() {
            if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                $('#mensaje').hide();
                $('#programas').empty();
                var formData = new FormData();
                var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                valoresSeleccionados = []
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
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels.map(function(label, index) {
                            return label + 's: ' + valores[index];
                        }),
                        datasets: [{
                            label: 'Gráfico Circular',
                            data: valores,
                            backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 1)']
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
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels.map(function(label, index) {
                            return label + ': ' + valores[index];
                        }),
                        datasets: [{
                            label: 'Gráfico Circular',
                            data: valores,
                            backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75)']
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

        function graficoRetencionActivos() {
            var url = '/home/retencionActivos';
            $.getJSON(url, function(data) {
                var labels = data.data.map(function(elemento) {
                    return elemento.sello;
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
                            backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75)']
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

    </script>

    <!-- incluimos el footer -->
    @include('layout.footer')
</div>