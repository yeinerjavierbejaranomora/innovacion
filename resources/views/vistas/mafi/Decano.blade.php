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
                <h3>A continuación podrás visualizar los datos de tus Facultades:
                    @foreach ($facultades as $facultad)
                    {{$facultad}} -
                    @endforeach
                </h3>

            </div>
            <br>

            <!-- Checkbox Facultades -->
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
                <div class="col-4 text-star" id="colCardFacultades">
                    <div class="card shadow mb-5" id="cardFacultades">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Facultad</strong></h5>
                        </div>
                        <div class="card-body text-start" id="centrar" style="overflow: auto;">
                            <div class="facultades" name="facultades" id="facultades">
                                <div>
                                    @foreach ($facultades as $facultad)
                                    <label class="idFacultad"> <input data-facultad="{{$facultad}}" type="checkbox" value="{{$facultad}}" checked> {{$facultad}} </label><br>
                                    @endforeach
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
                <div class="col-4 text-start" id="colcardProgramas">
                    <div class="card shadow mb-5" id="cardProgramas">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Programas</strong></h5>
                        </div>
                        <div class="card-body text-star" style="overflow: auto;">
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

        <div class="row justify-content-start mt-5">
            <div class=" col-6 text-center" id="colEstudiantes">
                <div class="card shadow mb-5 graficos" id="chartEstudiantes">
                    <div class="card-header">
                        <h5 id="tituloEstudiantes"><strong>Total estudiantes Banner</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="estudiantes"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colSelloFinanciero">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 id="tituloEstadoFinanciero"><strong>Estado Financiero</strong></h5>
                        <h5 class="tituloPeriodo">
                            <strong></strong>
                        </h5>
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
                        <h5 class="tituloPeriodo">
                            <strong></strong>
                        </h5>
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
                <div class="card shadow mb-6 graficos">
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
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 id="tituloOperadores"><strong>Operadores</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
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
                        <h5 id="tituloProgramas"><strong>Programas con mayor cantidad de admitidos</strong></h5>
                        <h5 class="tituloPeriodo"><strong></strong></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="estudiantesProgramas"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalProgramas" class="btn" data-toggle="modal" data-target="#modalProgramasTotal"> Ver más </a>
                    </div>
                </div>
            </div>

        </div>

        <br>
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
        $(document).ready(function() {
            var tabla = 'Mafi';
            var periodosSeleccionados = [];
            periodos();
            facultadesUsuario();

            vistaEntrada();

            // Deshabilitar los checkboxes cuando comienza una solicitud AJAX
            $(document).ajaxStart(function() {
                $('div #facultades input[type="checkbox"]').prop('disabled', true);
                $('div #programas input[type="checkbox"]').prop('disabled', true);
                $('#generarReporte').prop("disabled", true);
            });

            // Volver a habilitar los checkboxes cuando finaliza una solicitud AJAX
            $(document).ajaxStop(function() {
                $('div #facultades input[type="checkbox"]').prop('disabled', false);
                $('div #programas input[type="checkbox"]').prop('disabled', false);
                $('#generarReporte').prop("disabled", false);
            });

            /**
             * Método que trae los periodos activos
             */
            function periodos() {
                periodosSeleccionados = [];
                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('periodos.activos') }}",
                    method: 'post',
                    async: false,
                    success: function(data) {
                        data.forEach(periodo => {

                            $('div #periodos').append(`<label"> <input type="checkbox" value="${periodo.periodos}" checked> ${periodo.periodos}</label><br>`);
                        });
                    }
                });

            }

            function getPeriodos() {
                periodosSeleccionados = [];
                var checkboxesSeleccionados = $('#periodos input[type="checkbox"]:checked');
                checkboxesSeleccionados.each(function() {
                    periodosSeleccionados.push($(this).val());
                });
                return periodosSeleccionados;
            }


            var totalFacultades;
            var totalProgramas;
            var totalPeriodos;

            function Contador() {
                totalFacultades = $('#facultades input[type="checkbox"]').length;
                totalProgramas = $('#programas input[type="checkbox"]').length;
                totalPeriodos = $('#programas input[type="checkbox"]').length;
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
                destruirGraficos();
                llamadoFunciones();
            }


            var facultadesSeleccionadas = [];
            var facultadesSelect;

            function facultadesUsuario() {
                periodosSeleccionados = getPeriodos();
                facultadesSeleccionadas = <?php echo json_encode($facultades); ?>;
                facultadesSelect = facultadesSeleccionadas;
                console.log(facultadesSeleccionadas);

                graficosporFacultad(facultadesSeleccionadas, periodosSeleccionados);
            }

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

        function vistaEntrada() {
                var key = Object.keys(facultadesSelect);
                var cantidadFacultades = key.length;
                var valorFacultad = facultadesSelect[key[0]];

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

        var programasSeleccionados = [];
        $('#generarReporte').on('click', function(e) {
                e.preventDefault();
                Contador();
                getPeriodos();
                var key = Object.keys(facultadesSelect);
                var cantidadFacultades = key.length;
                console.log(cantidadFacultades);

                if (periodosSeleccionados.length > 0) {
                    if(cantidadFacultades == 1 && $('#programas input[type="checkbox"]:checked').length == 0)
                    {
                    programasSeleccionados = [];
                    facultadesSeleccionadas = [];
                    periodosSeleccionados = [];
                    destruirGraficos();
                    ocultarDivs();
                    alertaProgramas();
                    }
                    else{
                    if ($('#programas input[type="checkbox"]:checked').length > 0 && $('#programas input[type="checkbox"]:checked').length < totalProgramas) {
                        var checkboxesProgramas = $('#programas input[type="checkbox"]:checked');
                        programasSeleccionados = [];
                        checkboxesProgramas.each(function() {
                            programasSeleccionados.push($(this).val());
                        });
                        estadoUsuarioPrograma()
                        graficosporPrograma(programasSeleccionados);
                    } else {
                        if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                            if ($('#facultades input[type="checkbox"]:checked').length == totalFacultades && periodosSeleccionados.length == totalPeriodos) {
                                location.reload();
                            } else {
                                $('#mensaje').hide();
                                var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                                programasSeleccionados = [];
                                facultadesSeleccionadas = [];
                                checkboxesSeleccionados.each(function() {
                                    facultadesSeleccionadas.push($(this).val());
                                });
                                estadoUsuarioFacultad()
                                graficosporFacultad(facultadesSeleccionadas);
                            }
                        } else {
                            /** Alerta */
                            programasSeleccionados = [];
                            facultadesSeleccionadas = [];
                            periodosSeleccionados = [];
                            destruirGraficos();
                            ocultarDivs();
                            alertaFacultad();
                        }
                    }
                }
                } else {
                    programasSeleccionados = [];
                    facultadesSeleccionadas = [];
                    periodosSeleccionados = [];
                    destruirGraficos();
                    ocultarDivs();
                    alertaPeriodos();
                }
        });

            function alertaFacultad() {
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

            function alertaProgramas() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar al menos un programa',
                    confirmButtonColor: '#dfc14e',
                })
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
                    $('#tituloEstudiantes strong, #tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + programasFormateados);
                } else {
                    var textoNuevo = "<h4><strong>Informe programa " + programasSeleccionados + "</strong></h4>";
                    $('#tituloEstudiantes strong, #tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + programasSeleccionados);
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
                    $('#tituloEstudiantes strong, #tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + facultadesFormateadas);
                } else {

                    var textoNuevo = "<h4><strong>Informe facultad: " + facultadesFormateadas + "</strong></h4>";
                    $('#tituloEstudiantes strong, #tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + facultadesFormateadas);
                }
                $('.tituloPeriodo strong').append('Periodo: ' + periodosFormateados);
                $("#mensaje").show();
                $("#mensaje").html(textoNuevo);
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
                                $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label><br>`);
                            });
                        }
                    })
                } else {
                    $('#programas').empty();
                }
            });

            var chartEstudiantes;

            var chartEstudiantesActivos;

            var chartRetencion;

            var chartSelloPrimerIngreso;

            var chartTipoEstudiante;

            var chartOperadores;

            var chartProgramas;


            /**
             * Método que vacía el contenido de todos los gráficos una vez el usuario desea visualizar unicamente los de alguna facultad
             */

            function graficosporFacultad(facultades) {
                if (chartProgramas || chartEstudiantes || chartEstudiantesActivos || chartRetencion || chartSelloPrimerIngreso ||
                    chartTipoEstudiante || chartOperadores) {
                    destruirGraficos();
                    $("#ocultarGraficoProgramas").show();
                }
                graficoEstudiantesPorFacultades(facultades);
                graficoSelloFinancieroPorFacultad(facultades);
                graficoRetencionPorFacultad(facultades);
                graficoSelloPrimerIngresoPorFacultad(facultades);
                graficoTiposDeEstudiantesFacultad(facultades);
                graficoOperadoresFacultad(facultades);
                graficoProgramasFacultad(facultades);
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
                    url: "{{ route('estudiantes.activos.facultad',['tabla' => ' ']) }}" + tabla,
                    data: {
                        idfacultad: facultades,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.sello.facultad',['tabla' => ' ']) }}" + tabla,
                    data: {
                        idfacultad: facultades,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.retencion.facultad',['tabla' => ' ']) }}" + tabla,
                    data: {
                        idfacultad: facultades,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.primerIngreso.facultad',['tabla' => ' ']) }}" + tabla,
                    data: {
                        idfacultad: facultades,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.tipo.facultad',['tabla' => ' ']) }}" + tabla,
                    data: {
                        idfacultad: facultades,
                        periodos: periodosSeleccionados
                    },
                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.tipoestudiante;
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
                                }, ]
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
            function graficoOperadoresFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.operador.facultad',['tabla' => ' ']) }}" + tabla,
                    data: {
                        idfacultad: facultades,
                        periodos: periodosSeleccionados
                    },
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

            /**
             * Método que genera el gráfico de los 5 programas con mas estudiantes inscritos por facultad
             */
            function graficoProgramasFacultad(facultades) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('programas.estudiantes.facultad',['tabla' => ' ']) }}" + tabla,
                    data: {
                        idfacultad: facultades,
                        periodos: periodosSeleccionados
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
                        var ctx = document.getElementById('estudiantesProgramas').getContext('2d');
                        chartProgramas = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
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
                    url: "{{ route('estudiantes.activos.programa',['tabla' => ' ']) }}" + tabla,
                    data: {
                        programa: programas,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.sello.programa',['tabla' => ' ']) }}" + tabla,
                    data: {
                        programa: programas,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.retencion.programa',['tabla' => ' ']) }}" + tabla,
                    data: {
                        programa: programas,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.primerIngreso.programa',['tabla' => ' ']) }}" + tabla,
                    data: {
                        programa: programas,
                        periodos: periodosSeleccionados
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
                    url: "{{ route('estudiantes.tipo.programa',['tabla' => ' ']) }}" + tabla,
                    data: {
                        programa: programas,
                        periodos: periodosSeleccionados
                    },

                    success: function(data) {
                        data = jQuery.parseJSON(data);

                        var labels = data.data.map(function(elemento) {
                            return elemento.tipoestudiante;
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
            function graficoOperadoresPrograma(programas) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('estudiantes.operador.programa',['tabla' => ' ']) }}" + tabla,
                    data: {
                        programa: programas,
                        periodos: periodosSeleccionados
                    },
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
                console.log(periodosSeleccionados);
                var data;
                if (programasSeleccionados.length > 0) {
                    var url = "{{ route('tiposEstudiantes.programa.estudiantes',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        var url = "{{ route('tiposEstudiantes.facultad.estudiantes',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        var url = "{{ route('tiposEstudiantes.total.estudiantes',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSelect,
                                periodos: periodosSeleccionados
                            }
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
             * Método que trae todos los operadores de la Ibero
             */
            var chartOperadoresTotal;

            function graficoOperadoresTotal() {
                var data;
                if (programasSeleccionados.length > 0) {
                    var url = "{{ route('operadores.programa.estudiantes',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        var url = "{{ route('operadores.facultad.estudiantes',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        var url = "{{ route('operadoresTotal.estudiantes',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSelect,
                                periodos: periodosSeleccionados
                            }
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

            /**
             * Método que trae todos los programas de la Ibero
             */
            var chartProgramasTotal;

            function graficoProgramasTotal() {
                if (facultadesSeleccionadas.length > 0) {
                    var url = "{{ route('FacultadTotal.estudiantes',['tabla' => ' ']) }}" + tabla,
                        data = {
                            idfacultad: facultadesSeleccionadas,
                            periodos: periodosSeleccionados
                        }
                } else {
                    var url = "{{ route('programasTotal.estudiantes',['tabla' => ' ']) }}" + tabla,
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
                        var ctx = document.getElementById('programasTotal').getContext('2d');
                        chartProgramasTotal = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    return label;
                                }),
                                datasets: [{
                                    label: 'Programas',
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