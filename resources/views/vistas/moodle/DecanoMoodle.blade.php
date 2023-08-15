@include('layout.header')

@include('menus.menu_Decano')
<!--  creamos el contenido principal body -->
<style>
    #facultades {
        font-size: 14px;
    }

    #programas {
        font-size: 14px;
    }

    .center-chart {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
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

    #btn-table {
        width: 60px;
    }

    #generarReporte {
        width: 250px;
        height: 45px;
        font-size: 20px;
    }

    .deshacer {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 140px;
        height: 30px;
        border-radius: 10px;
        font-weight: 800;
        place-items: center;
        font-size: 12px;
    }

    .botonModal {
        display: flex;
        justify-content: center;
        align-items: center;
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
    #cardPeriodos,
    #cardFacultades {
        min-height: 250px;
        max-height: 250px;
    }

    .card {
        margin-bottom: 3%;
    }

    .hidden {
        display: none;
    }


    .graficos {
        min-height: 460px;
        max-height: 460px;
    }

    .graficosBarra {
        min-height: 600px;
        max-height: 600px;
    }

    .graficosRiesgo {
        min-height: 450px;
        max-height: 450px;
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
                <div class="input-group-append text-gray-800">
                    <h3><strong> Bienvenido {{auth()->user()->nombre}}! - Informe de Facultades Moodle </strong></h3>
                </div>
            </div>


        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->

            <br>
            <div class="text-center" id="mensaje">
                <h3>A continuación podrás visualizar los datos de tus Facultades:
                    @foreach ($facultades as $facultad)
                    {{$facultad}} -
                    @endforeach
                </h3>

            </div>
            <br>

            <!-- Checkbox Periodos -->
            <div class="row justify-content-start">
                <div class="col-4 text-star">
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

                <div class="col-4 text-star">
                    <div class="card shadow mb-5" id="cardFacultades">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Facultades</strong></h5>
                        </div>
                        <div class="card-body text-start" id="centrar" style="overflow: auto;">
                            <div class="facultades" name="facultades" id="facultades">
                                @foreach ($facultades as $facultad)
                                <label class="idFacultad"> <input data-facultad="{{$facultad}}" type="checkbox" value="{{$facultad}}" checked> {{$facultad}} </label><br>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-footer text-center" style="height: 55px;">
                            <button type="button" id="deshacerFacultades" class="btn deshacer">Deshacer Todas</button>
                            <button type="button" id="seleccionarFacultades" class="btn deshacer">Seleccionar Todas</button>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-start">
                    <div class="card shadow mb-5" id="cardProgramas">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Programas</strong></h5>
                        </div>
                        <div class="card-body text-start" style="overflow: auto;">
                            <div name="programas" id="programas"></div>
                        </div>
                        <div class="card-footer text-center" style="height: 55px;">
                            <button type="button" id="deshacerProgramas" class="btn deshacer">Deshacer Todos</button>
                            <button type="button" id="seleccionarProgramas" class="btn deshacer">Seleccionar Todos</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center justify-content-center">
                <button class="btn" type="button" id="generarReporte">
                    Generar Reporte
                </button>
            </div>

        </div>

        <div class="row justify-content-start mt-3 columnas">
            <div class="col-4 text-center " id="colRiesgoAlto">
                <div class="card shadow mb-4 graficosRiesgo">
                    <div class="card-header">
                        <h5 id="tituloRiesgoAlto"><strong>Riesgo alto</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body center-chart">
                        <canvas id="alto"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a id="botonAlto" class="btn botonModal" data-value="ALTO"> Ver más </a>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center " id="colRiesgoMedio">
                <div class="card shadow mb-4 graficosRiesgo">
                    <div class="card-header">
                        <h5 id="tituloRiesgoMedio"><strong>Riesgo medio</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body center-chart">
                        <canvas id="medio"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a id="botonMedio" class="btn botonModal" data-value="MEDIO"> Ver más </a>
                    </div>
                </div>
            </div>
            <div class="col-4 text-center " id="colRiesgoBajo">
                <div class="card shadow mb-4 graficosRiesgo">
                    <div class="card-header">
                        <h5 id="tituloRiesgoBajo"><strong>Riesgo bajo</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body center-chart">
                        <canvas id="bajo"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a id="botonBajo" class="btn botonModal" data-value="BAJO"> Ver más </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mt-4 hidden" id="colTabla">
            <!-- Card Body -->
            <div class="card-body">
                <!--Datatable-->
                <div class="table">
                    <table id="datatable" class="display" style="width:100%">
                    </table>
                </div>
            </div>
            <br>
        </div>

        <br>

        <!--Modal Datos Alumno-->
        <div class="modal fade" id="modaldataEstudiante" tabindex="-1" role="dialog" aria-labelledby="modaldataEstudiante" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="height:600px;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="tituloEstudiante"><strong></strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-lg-4">
                                <div class="card mb-4">
                                    <div class="card-body text-center">
                                        <img src="https://e7.pngegg.com/pngimages/178/595/png-clipart-user-profile-computer-icons-login-user-avatars-monochrome-black.png" alt="avatar" class="rounded-circle img-fluid mb-2" style="width: 150px;">
                                        <p class="text-muted mb-1" id="nombreModal"></p>
                                        <p class="text-muted mb-1" id="idModal"></p>
                                        <p class="text-muted mb-1" id="facultadModal"></p>
                                        <p class="text-muted mb-1" id="programaModal"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-8">
                                    <div class="card-body text-start">
                                        <p class="text-muted mb-1" id="documentoModal"></p>
                                        <p class="text-muted mb-1" id="correoModal"></p>
                                        <p class="text-muted mb-1" id="selloModal"></p>
                                        <p class="text-muted mb-1" id="estadoModal"></p>
                                        <p class="text-muted mb-1" id="tipoModal"></p>
                                        <p class="text-muted mb-1" id="autorizadoModal"></p>
                                        <p class="text-muted mb-1" id="operadorModal"></p>
                                        <p class="text-muted mb-1" id="convenioModal"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <table class="table" id="tabla">
                                <thead>
                                    <tr>
                                        <th scope="col">Curso</th>
                                        <th scope="col">Total Actividades</th>
                                        <th scope="col">Actividades por calificar</th>
                                        <th scope="col">Cuestionarios realizados</th>
                                        <th scope="col">Primer Corte</th>
                                        <th scope="col">Segundo Corte</th>
                                        <th scope="col">Tercer Corte</th>
                                        <th scope="col">Nota Acumulada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row text-center mt-3 mb-3 center-chart">
                            <div class="col-lg-8">
                                <canvas id="riesgoIngreso"></canvas>
                            </div>

                        </div>
                        <div class="row text-center mt-3 center-chart">
                            <div class="col-lg-8" style="height: 500px;">
                                <canvas id="riesgoNotas"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script>
        var table;
        var data;
        $(document).ready(function() {

            var tabla = <?php echo json_encode($tabla); ?>;

            // Deshabilitar los checkboxes cuando comienza una solicitud AJAX
            $(document).ajaxStart(function() {
                $('div #facultades input[type="checkbox"]').prop('disabled', true);
                $('div #programas input[type="checkbox"]').prop('disabled', true);
                $('#generarReporte').prop("disabled", true);
                $('.botonModal').prop("disabled", true);
            });

            // Volver a habilitar los checkboxes cuando finaliza una solicitud AJAX
            $(document).ajaxStop(function() {
                $('div #facultades input[type="checkbox"]').prop('disabled', false);
                $('div #programas input[type="checkbox"]').prop('disabled', false);
                $('#generarReporte').prop("disabled", false);
                $('.botonModal').prop("disabled", false);
            });

            var periodosSeleccionados = [];
            var programasSeleccionados = [];
            var facultadesSeleccionadas = [];
            periodos();
            facultadesUsuario();
            riesgo();
            vistaEntrada();

            var totalFacultades;
            var totalProgramas;
            var totalPeriodos;

            function Contador() {
                totalFacultades = $('#facultades input[type="checkbox"]').length;
                totalProgramas = $('#programas input[type="checkbox"]').length;
                totalPeriodos = $('#programas input[type="checkbox"]').length;
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
            }

            /**
             * Método para verificar los periodos seleccionados
             */
            function getPeriodos() {
                var periodosSeleccionados = [];
                var checkboxesSeleccionados = $('#periodos input[type="checkbox"]:checked');
                checkboxesSeleccionados.each(function() {
                    periodosSeleccionados.push($(this).val());
                });
                return periodosSeleccionados;
            }

            var programasSeleccionados = [];
            var facultadesSeleccionadas = [];
            var periodosSeleccionados = [];

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
                                $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label><br>`);
                            });
                        }
                    })
                } else {
                    $('#programas').empty();
                }
            });

            /**
             * Botones
             */
            $('#deshacerProgramas').on('click', function(e) {
                $('#programas input[type="checkbox"]').prop('checked', false);
            });

            $('#seleccionarProgramas').on('click', function(e) {
                $('#programas input[type="checkbox"]').prop('checked', true);
            });

            $('#deshacerPeriodos').on('click', function(e) {
                $('#periodos input[type="checkbox"]').prop('checked', false);
            });

            $('#seleccionarPeriodos').on('click', function(e) {
                $('#periodos input[type="checkbox"]').prop('checked', true);
            });

            $('#deshacerFacultades').on('click', function(e) {
                $('#facultades input[type="checkbox"]').prop('checked', false);
            });

            $('#seleccionarFacultades').on('click', function(e) {
                $('#facultades input[type="checkbox"]').prop('checked', true);
            });

            function alerta() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar al menos una facultad',
                    confirmButtonColor: '#dfc14e',
                })
            }

            function alertaPeriodos() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar al menos un periodo',
                    confirmButtonColor: '#dfc14e',
                })
            }

            function ocultarDivs() {
                $('#colRiesgoAlto, #colRiesgoMedio, #colRiesgoBajo').addClass('hidden');
            }

            function facultadesUsuario() {
                var objeto;
                periodosSeleccionados = getPeriodos();
                objeto = <?php echo json_encode($facultades); ?>;
               facultadesSeleccionadas = Object.keys(objeto).map(clave => objeto[clave]);
            }

            function vistaEntrada() {
                var key = Object.keys(facultadesSeleccionadas);
                var cantidadFacultades = key.length;
                var valorFacultad = facultadesSeleccionadas[key[0]];

                if (cantidadFacultades === 1) {
                    $('#colCardFacultades').hide();
                    var textoNuevo = "<h3>A continuación podrás visualizar los datos de tu Facultad: " + valorFacultad + " </h3>";
                    $("#mensaje").html(textoNuevo);
                    var idFacultadesArray = Object.values(facultadesSelect);
                    var formData = new FormData();
                    idFacultadesArray.forEach((facultad) => {
                        formData.append('idfacultad[]', facultad);
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
                                $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label><br>`);
                            });
                        }
                    })
                }
            }

            $('#generarReporte').on('click', function(e) {
                e.preventDefault();
                Contador();
                destruirTabla();
                var key = Object.keys(facultadesSeleccionadas);
                var cantidadFacultades = key.length;
                periodosSeleccionados = getPeriodos()
                if (periodosSeleccionados.length > 0) {
                    if (cantidadFacultades == 1 && $('#programas input[type="checkbox"]:checked').length == 0) {
                        programasSeleccionados = [];
                        facultadesSeleccionadas = [];
                        periodosSeleccionados = [];
                        destruirGraficos();
                        ocultarDivs();
                        alertaProgramas();
                    } else {
                        if ($('#programas input[type="checkbox"]:checked').length > 0 && $('#programas input[type="checkbox"]:checked').length < totalProgramas) {
                            var checkboxesProgramas = $('#programas input[type="checkbox"]:checked');
                            programasSeleccionados = [];
                            checkboxesProgramas.each(function() {
                                programasSeleccionados.push($(this).val());
                            });
                            estadoUsuarioPrograma();
                            riesgo();
                        } else {
                            if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                                if ($('#facultades input[type="checkbox"]:checked').length == totalFacultades && periodosSeleccionados.length == totalPeriodos) {
                                    location.reload();
                                } else {
                                    var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                                    programasSeleccionados = [];
                                    facultadesSeleccionadas = [];
                                    checkboxesSeleccionados.each(function() {
                                        facultadesSeleccionadas.push($(this).val());
                                    });
                                    estadoUsuarioFacultad();
                                    riesgo();
                                }
                            } else {
                                /** Alerta */
                                programasSeleccionados = [];
                                facultadesSeleccionadas = [];
                                alerta();
                                limpiarTitulos();
                                ocultarDivs();
                            }
                        }
                    }
                } else {
                    alertaPeriodos();
                    limpiarTitulos();
                    ocultarDivs();
                }
            });

            function limpiarTitulos() {
                var elementosTitulos = $('#tituloRiesgoAlto, #tituloRiesgoMedio, #tituloRiesgoBajo');
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

            function estadoUsuarioPrograma() {
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
                    $('#tituloRiesgoAlto, #tituloRiesgoMedio, #tituloRiesgoBajo').append(': ' + programasFormateados);
                } else {
                    var textoNuevo = "<h4><strong>Informe programa " + programasSeleccionados + "</strong></h4>";
                    $('#tituloRiesgoAlto, #tituloRiesgoMedio, #tituloRiesgoBajo').append(': ' + programasSeleccionados);
                }
                $('.tituloPeriodo strong').append('Periodo: ' + periodosFormateados);
                $("#mensaje").show();
                $("#mensaje").html(textoNuevo);

            }

            function estadoUsuarioFacultad() {
                limpiarTitulos();
                var periodos = getPeriodos();
                $("#mensaje").empty();
                var facultadesArray = Object.values(facultadesSeleccionadas);
                var facultadesFormateadas = facultadesArray.map(function(facultad) {
                    return facultad.toLowerCase().replace(/facultad de |fac /gi, '').trim();
                }).join(' - ');

                var periodosArray = Object.values(periodos);
                var periodosFormateados = periodosArray.map(function(periodo) {
                    return periodo.replace(/2023/, '').trim();
                }).join(' - ');

                if (facultadesSeleccionadas.length > 1) {
                    var textoNuevo = "<h4><strong>Informe facultades: " + facultadesFormateadas + "</strong></h4>";
                    $('#tituloRiesgoAlto, #tituloRiesgoMedio, #tituloRiesgoBajo').append(': ' + facultadesFormateadas);
                } else {

                    var textoNuevo = "<h4><strong>Informe facultad: " + facultadesFormateadas + "</strong></h4>";
                    $('#tituloRiesgoAlto, #tituloRiesgoMedio, #tituloRiesgoBajo').append(': ' + facultadesFormateadas);
                }
                $('.tituloPeriodo strong').append('Periodo: ' + periodosFormateados);
                $("#mensaje").show();
                $("#mensaje").html(textoNuevo);
            }

            var chartRiesgoAlto;
            var chartRiesgoMedio;
            var chartRiesgoBajo;

            /**
             * Método para obtener gráficos de riesgo alto, medio y bajo 
             * */
            function riesgo() {
                if (chartRiesgoAlto && chartRiesgoMedio && chartRiesgoBajo) {
                    [chartRiesgoAlto, chartRiesgoMedio, chartRiesgoBajo].forEach(chart => chart.destroy());
                }
                console.log(facultadesSeleccionadas);
                console.log(facultadesSeleccionadas.length);
                var data;
                if (programasSeleccionados.length > 0) {
                    var url = "{{ route('moodle.riesgo.programa') }}",
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        var url = "{{ route('moodle.riesgo.facultad') }}",
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        var url = "{{ route('moodle.riesgo') }}",
                            data = '';
                    }
                }

                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        var ctx = document.getElementById('alto').getContext('2d');
                        var TotalAlto = data.total - data.alto;
                        var TotalMedio = data.total - data.medio;
                        var TotalBajo = data.total - data.bajo;
                        if (TotalAlto <= 0) {
                            TotalAlto = 0;
                        }
                        if (TotalMedio <= 0) {
                            TotalMedio = 0;
                        }
                        if (TotalBajo <= 0) {
                            TotalBajo = 0;
                        }

                        chartRiesgoAlto = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Score', 'Gray Area'],
                                datasets: [{
                                    data: [data.alto, TotalAlto],
                                    backgroundColor: ['rgba(255, 0, 0, 1)', 'rgba(181, 178, 178, 0.5)'],
                                    borderWidth: 1,
                                    cutout: '70%',
                                    circumference: 180,
                                    rotation: 270,
                                }, ],
                            },

                            options: {
                                responsive: true,
                                cutoutPercentage: 50,
                                plugins: {
                                    datalabels: {
                                        color: 'black',
                                        font: {
                                            weight: 'semibold',
                                            size: 18,
                                        },
                                    },
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: true,
                                        text: data.alto,
                                        color: 'red',
                                        position: 'bottom',
                                        font: {
                                            size: 20,
                                        },
                                    },
                                    tooltip: {
                                        enabled: false
                                    },

                                },

                            },
                            plugins: [ChartDataLabels]
                        });

                        ctx = document.getElementById('medio').getContext('2d');
                        chartRiesgoMedio = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Score', 'Gray Area'],
                                datasets: [{
                                    data: [data.medio, TotalMedio], // Aquí puedes ajustar el valor para representar la semicircunferencia deseada
                                    backgroundColor: ['rgba(220, 205, 48, 1)', 'rgba(181, 178, 178, 0.5)'], // Color de fondo para la semicircunferencia
                                    borderWidth: 1,
                                    cutout: '70%',
                                    circumference: 180,
                                    rotation: 270,
                                }, ],
                            },

                            options: {
                                responsive: true,
                                cutoutPercentage: 50,
                                plugins: {
                                    datalabels: {
                                        color: 'black',
                                        font: {
                                            weight: 'semibold',
                                            size: 18,
                                        },
                                    },
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: true,
                                        text: data.medio,
                                        color: '#DCCD30',
                                        position: 'bottom',
                                        font: {
                                            size: 20,
                                        },
                                    },
                                    tooltip: {
                                        enabled: false
                                    },

                                },

                            },
                            plugins: [ChartDataLabels]
                        });

                        ctx = document.getElementById('bajo').getContext('2d');
                        chartRiesgoBajo = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Score', 'Gray Area'],
                                datasets: [{
                                    data: [data.bajo, TotalBajo], // Aquí puedes ajustar el valor para representar la semicircunferencia deseada
                                    backgroundColor: ['rgba(0, 255, 0, 1)', 'rgba(181, 178, 178, 0.5)'], // Color de fondo para la semicircunferencia
                                    borderWidth: 1,
                                    cutout: '70%',
                                    circumference: 180,
                                    rotation: 270,
                                }, ],
                            },

                            options: {
                                responsive: true,
                                cutoutPercentage: 50,
                                plugins: {
                                    datalabels: {
                                        color: 'black',
                                        font: {
                                            weight: 'semibold',
                                            size: 18,
                                        },
                                    },
                                    legend: {
                                        display: false
                                    },
                                    title: {
                                        display: true,
                                        text: data.bajo,
                                        color: 'Green',
                                        position: 'bottom',
                                        font: {
                                            size: 20,
                                        },
                                    },
                                    tooltip: {
                                        enabled: false
                                    },

                                },

                            },
                            plugins: [ChartDataLabels]
                        });
                        if (chartRiesgoAlto.data.labels.length == 0 && chartRiesgoAlto.data.datasets[0].data.length == 0) {
                            $('#colRiesgoAlto').addClass('hidden');
                        } else {
                            $('#colRiesgoAlto').removeClass('hidden');
                        }
                        if (chartRiesgoMedio.data.labels.length == 0 && chartRiesgoMedio.data.datasets[0].data.length == 0) {
                            $('#colRiesgoMedio').addClass('hidden');
                        } else {
                            $('#colRiesgoMedio').removeClass('hidden');
                        }
                        if (chartRiesgoBajo.data.labels.length == 0 && chartRiesgoBajo.data.datasets[0].data.length == 0) {
                            $('#colRiesgoBajo').addClass('hidden');
                        } else {
                            $('#colRiesgoBajo').removeClass('hidden');
                        }
                    }
                });
            }

            /** 
             * Botones de Riesgo 
             */
            $('#botonAlto, #botonMedio, #botonBajo').on('click', function(e) {
                var riesgo = $(this).data('value');
                dataTable(riesgo);
            });

            var chartRiesgoIngreso;
            var chartRiesgoNotas;
            /**
             * Método para obtner los datos de un alumno según su id Banner y llena el Modal
             */
            function dataAlumno(id) {
                limpiarModal();
                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('moodle.data') }}",
                    data: {
                        idBanner: id
                    },
                    method: 'post',
                    success: function(data) {
                        var primerArray;
                        if (data.data) {
                            primerArray = data.data[0];
                        } else {
                            var data = jQuery.parseJSON(data);
                            primerArray = data.data[0];
                        }
                        /** Primera Card */
                        $('#tituloEstudiante strong').append('Datos estudiante: ' + primerArray.Nombre + ' ' + primerArray.Apellido + ' - ' + primerArray.Id_Banner);
                        $('#nombreModal').append('<strong>' + primerArray.Nombre + ' ' + primerArray.Apellido + '</strong>');
                        $('#idModal').append('<strong>' + primerArray.Id_Banner + '</strong>');
                        $('#facultadModal').append('<strong>' + primerArray.Facultad + '</strong>');
                        $('#programaModal').append('<strong>' + primerArray.Programa + '</strong>');

                        /** Segunda Card */
                        $('#documentoModal').append('<strong>Documento de identidad: </strong>' + primerArray.No_Documento);
                        $('#correoModal').append('<strong>Correo institucional: </strong>' + primerArray.Email);
                        $('#selloModal').append('<strong>Sello financiero: </strong>' + primerArray.Sello);
                        $('#estadoModal').append('<strong>Estado: </strong>' + primerArray.Estado_Banner);
                        $('#tipoModal').append('<strong>Tipo estudiante: </strong>' + primerArray.Tipo_Estudiante);
                        $('#autorizadoModal').append('<strong>Autorizado: </strong>' + primerArray.Autorizado_ASP);
                        $('#operadorModal').append('<strong>Autorizado: </strong>' + primerArray.Operador);
                        $('#convenioModal').append('<strong>Convenio: </strong>' + primerArray.Convenio);

                        data.data.forEach(dato => {
                            $("#tabla tbody").append(`<tr>
                            <td>${dato.Nombrecurso} </td>
                            <td>${dato.Total_Actividades} </td>
                            <td>${dato.Actividades_Por_Calificar} </td>
                            <td>${dato.Cuestionarios_Intentos_Realizados} </td>
                            <td>${dato.Primer_Corte} </td>
                            <td>${dato.Segundo_Corte} </td>
                            <td>${dato.Tercer_Corte} </td>
                            <td>${dato.Nota_Acumulada} </td>
                            <tr>`)
                        });
                    }
                });

                graficosModal(id);
            }

            /**
             * Método que grafica los datos en el Modal
             */
            function graficosModal(id) {
                var charts = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('moodle.riesgo.asistencia') }}",
                    data: {
                        idBanner: id
                    },
                    method: 'post',
                    success: function(data) {
                        data = jQuery.parseJSON(data);
                        var ctx = document.getElementById('riesgoIngreso').getContext('2d');
                        var alto = data.data.alto;
                        var medio = data.data.medio;
                        var bajo = data.data.bajo;

                        var valoralto = data.data.total.ALTO;
                        var valorbajo = data.data.total.BAJO;
                        var valormedio = data.data.total.MEDIO;

                        chartRiesgoIngreso = new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Bajo', 'Medio', 'Alto'],
                                datasets: [{
                                    data: [valoralto, valormedio, valorbajo],
                                    backgroundColor: ['rgba(0, 255, 0, 0.7)', 'rgba(220, 205, 48, 0.7)', 'rgba(255, 0, 0, 0.7)'],
                                    borderWidth: 1,
                                    cutout: '70%',
                                    circumference: 180,
                                    rotation: 270,
                                }, ],
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                cutoutPercentage: 50,
                                plugins: {
                                    datalabels: {
                                        color: 'black',
                                        font: {
                                            weight: 'semibold',
                                            size: 18,
                                        },
                                        formatter: (value, ctx) => {
                                            return value != 0 ? value.toString() : '';
                                        },
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        align: 'center',
                                        labels: {
                                            padding: 10,
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Riesgo por ingreso',
                                        color: 'black',
                                        position: 'top',
                                        font: {
                                            size: 15,
                                        },
                                    },
                                    tooltip: {
                                        enabled: false
                                    },
                                    layout: {
                                        padding: {
                                            bottom: 10,
                                        },
                                        margin: {
                                            bottom: 10,
                                        },
                                    },
                                },

                            },
                            plugins: [ChartDataLabels]
                        });

                        ctx = document.getElementById('riesgoNotas').getContext('2d');
                        const dataArray = Object.values(data.data.notas);

                        var labels = data.data.notas.map(function(elemento) {
                            return elemento.nombreCurso;
                        });

                        var valores = data.data.notas.map(function(elemento) {
                            return elemento.Nota_Acumulada;
                        });

                        chartRiesgoNotas = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: '',
                                    data: valores.map(value => value == "Sin Actividad" ? value : parseFloat(value)),
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                                    ],
                                    datalabels: {
                                        anchor: 'end',
                                        align: 'top',
                                        formatter: value => {
                                            if (value === "Sin Actividad") {
                                                return value;
                                            } else {
                                                return value.toFixed(1);
                                            }
                                        }
                                    }
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        max: 5,

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
                                    },
                                    title: {
                                        display: true,
                                        text: 'Riesgo por nota acumulada',
                                        color: 'black',
                                        position: 'top',
                                        font: {
                                            size: 15,
                                        },
                                    }

                                },
                            },
                            plugins: [ChartDataLabels]
                        });
                    }
                });

            }

            /**
             * Método para destruir DataTable
             */
            function destruirTabla() {
                $('#colTabla').addClass("hidden")
                if ($.fn.DataTable.isDataTable('#datatable')) {
                    $("#tituloTable").remove();
                    table.destroy();
                    $('#datatable').DataTable().destroy();
                    $('#datatable tbody').empty();
                    $("#datatable tbody").off("click", "button.data");
                }
            }

            /**
             * Método para construir dataTable, según el tipo de riesgo
             */
            function dataTable(riesgo) {

                destruirTabla();
                $('#colTabla').removeClass("hidden");
                var data;
                if (programasSeleccionados.length > 0) {
                    var url = "{{ route('moodle.estudiantes.programa', ['riesgo' => ' ']) }}" + riesgo;
                    data = {
                        programa: programasSeleccionados,
                        periodos: periodosSeleccionados
                    }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        var url = "{{ route('moodle.estudiantes.facultad', ['riesgo' => ' ']) }}" + riesgo;
                        data = {
                            idfacultad: facultadesSeleccionadas,
                            periodos: periodosSeleccionados
                        }
                    } else {
                        var url = "{{ route('moodle.estudiantes', ['riesgo' => ' ']) }}" + riesgo;
                        data = '';
                    }
                }

                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        var datos
                        if (data.data) {
                            datos = data.data;
                        } else {
                            var data = jQuery.parseJSON(data);
                            datos = data.data;
                        }
                        table = $('#datatable').DataTable({
                            "data": datos,
                            'pageLength': 10,
                            "columns": [{
                                    data: 'Id_Banner',
                                    title: 'Id Banner'
                                },
                                {
                                    data: null,
                                    title: 'Nombre Completo',
                                    render: function(data, type, row) {
                                        return data.Nombre + ' ' + data.Apellido;
                                    }
                                },
                                {
                                    data: 'Facultad',
                                    title: 'Facultad'
                                },
                                {
                                    data: 'Programa',
                                    title: 'Programa'
                                },
                                {
                                    defaultContent: "<button type='button' id='btn-table' class='data btn btn-warning' data-toggle='modal' data-target='#modaldataEstudiante'><i class='fa-solid fa-user'></i></button>",
                                    title: 'Datos Estudiante',
                                    className: "text-center",
                                }
                            ],
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            },
                        });
                        riesgoaux = riesgo.toLowerCase();
                        var titulo = 'Estudiantes con riesgo ' + riesgoaux;
                        $('<div id="tituloTable" class="dataTables_title text-center"> <h4>' + titulo + '</h4></div>').insertBefore('#datatable');

                        function obtenerData(tbody, table) {
                            $(tbody).on("click", "button.data", function() {
                                var datos = table.row($(this).parents("tr")).data();
                                dataAlumno(datos.Id_Banner);
                            })
                        }
                        obtenerData("#datatable tbody", table);
                    },

                });
            }
            /**
             * Método para limpiar información del Modal
             */
            function limpiarModal() {
                $('#tituloEstudiante strong, #nombreModal, #idModal, #facultadModal, #programaModal, #documentoModal, #correoModal, #selloModal, #estadoModal, #tipoModal, #autorizadoModal, #operadorModal, #convenioModal, #tabla tbody').empty();

                if (chartRiesgoIngreso && chartRiesgoNotas) {
                    [chartRiesgoIngreso, chartRiesgoNotas].forEach(chart => chart.destroy());
                }

            }
        });
    </script>

    <!-- incluimos el footer -->
    @include('layout.footer')
</div>