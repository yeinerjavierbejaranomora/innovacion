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

    .button-informe {
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

    #btn-table {
        width: 60px;
    }

    .botonModal {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 100px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .botonMafi {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 200px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #botondataTable {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 250px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .boton {
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

    .card {
        margin-bottom: 3%;
    }

    .hidden {
        display: none;
    }

    .graficos {
        min-height: 450px;
        max-height: 450px;
    }

    .graficosRiesgo {
        min-height: 350px;
        max-height: 350px;
    }

    #cardProgramas {
        max-height: 500px;
    }

    .graficosBarra {
        min-height: 450px;
        max-height: 450px;
    }

    #tiposEstudiantesTotal,
    #operadoresTotal,
    #programasTotal,
    #metasTotal {
        height: 600px !important;
    }

    #seccion {
        background: #DFE0E2;
    }

    .center-chart {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .fondocards {
        color: white;
        background-color: #3A6577;
    }

    .fondocharts {
        background-color: #DFE0E2;
    }

    .custom-text {
        margin-top: 30px;
        font-size: 14px;
        color: black;
        font-family: sans-serif;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background-image: url('/public/assets/images/fondo cabecera.png');">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <div class="input-group">
                <div class="input-group-append text-gray-800 text-center">
                    <h3><strong> Bienvenido {{ auth()->user()->nombre }}! - Informe de Moodle </strong></h3>
                </div>
            </div>


        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->

            <div class="text-center" id="mensaje">
                <h5>Por defecto se muestran los datos de todas las facultades,
                    si quieres ver datos en especifico, selecciona alguna en específico.
                </h5>
            </div>
            <br>

            <!-- Checkbox Periodos -->
            <div class="row justify-content-start mb-3" id="seccion">

                <!--Columna Niveles de Formación-->
                <div class="col-12 text-start mt-1">
                    <div class="card-body mb-3" id="cardNivel">
                        <div class="row">
                            <div class="text-center col-8">
                                <h5 id="tituloNiveles" class="text-dark"><strong>Periodos Activos</strong></h5>
                            </div>
                            <div class="text-center col-4">
                                <h5 id="tituloNiveles" class="text-dark"><strong>Facultades y Programas</strong></h5>
                            </div>
                        </div>

                        <div class="text-start">
                            <div id="periodos">
                                <!--Accordion-->
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <!--Formación continua-->
                                        <div class="card">
                                            <div class="card-header fondocards" id="heading2" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link text-light">
                                                        For. Contínua
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosContinua" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos inputTodos" id="todosContinua" name="todosContinua" checked>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapse2" class="collapse shadow" aria-labelledby="heading2" data-parent="#periodos">
                                                <div class="card-body periodos" style="width:100%;" id="Continua"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!--Pregrado-->
                                        <div class="card">
                                            <div class="card-header fondocards" id="heading1" style="width:100%;cursor:pointer;" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link text-light">
                                                        Pregrado
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosPregrado" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosPregrado" name="todosPregrado" checked>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapse1" class="collapse shadow" aria-labelledby="heading1" data-parent="#periodos">
                                                <div class="card-body periodos" style="width:100%;" id="Pregrado"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-start">
                                        <div class="card" id="cardFacultades">
                                            <div class="card-header text-center fondocards" id="HeadingFacultades" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#acordionFacultades" aria-expanded="false" aria-controls="acordionFacultades">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link text-light">
                                                        Facultades
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosFacultad" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosFacultad" name="todosFacultad" checked>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div class="card-body text-start collapse shadow" id="acordionFacultades" aria-labelledby="HeadingFacultades">
                                                <div name="facultades" id="facultades"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <!--Especialización-->
                                        <div class="card">
                                            <div class="card-header fondocards" id="heading3" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link text-light">
                                                        Especialización
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosEsp" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosEsp" name="todosEsp" checked>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapse3" class="collapse shadow" aria-labelledby="heading3" data-parent="#periodos">
                                                <div class="card-body periodos" style="width:100%;" id="Esp"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!--Maestría-->
                                        <div class="card">
                                            <div class="card-header fondocards" id="heading4" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link text-light">
                                                        Maestría
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosMaestria" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosMaestria" name="todosMaestria" checked>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapse4" class="collapse shadow" aria-labelledby="heading4" data-parent="#periodos">
                                                <div class="card-body periodos" style="width:100%;" id="Maestria">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4 text-start">
                                        <div class="card mb-3" id="cardProgramas">
                                            <div class="card-header text-center fondocards" id="HeadingProgramas" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#acordionProgramas" aria-expanded="false" aria-controls="acordionProgramas">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link text-light">
                                                        Programas
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosPrograma" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" id="todosPrograma" name="todosPrograma" checked>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div class="card-body text-start collapse shadow" id="acordionProgramas" aria-labelledby="headingProgramas" style="overflow: auto;">
                                                <div name="programas">
                                                    <input type="text" class="form-control mb-2" id="buscadorProgramas" placeholder="Buscar programas">
                                                    <ul style="list-style:none" id="programas">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row text-center justify-content-center">
                <button class="btn button-informe" type="button" id="generarReporte">
                    Generar Reporte
                </button>
            </div>

            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-header text-center">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active menuMoodle" id="navAusentismo" href="#ausentismo">Informe de Ausentismo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link menuMoodle" id="navCursos" href="#cursos">Cursos activos</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="ausentismo" class="content">
                                <div class="text-center mt-4 mb-4">
                                    <h4><strong>Informe de estudiantes en riesgo por Ausentismo</strong></h4>
                                </div>

                                <div class="row justify-content-start mt-3 columnas">
                                    <div class="col-4 text-center " id="colRiesgoAlto">
                                        <div class="card shadow mb-4 graficosRiesgo">
                                            <div class="card-header">
                                                <h5 id="tituloRiesgoAlto"><strong>Riesgo alto</strong></h5>
                                                <h5 class="tituloPeriodo"><strong></strong></h5>
                                            </div>
                                            <div class="card-body center-chart fondocharts" style="position: relative;">
                                                <canvas id="alto"></canvas>
                                                <div style="flex: 1;">
                                                    <div class="custom-text totalMatriculas"></div>
                                                </div>
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
                                            <div class="card-body center-chart fondocharts">
                                                <canvas id="medio"></canvas>
                                                <div style="flex: 1;">
                                                    <div class="custom-text totalMatriculas"></div>
                                                </div>
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
                                            <div class="card-body center-chart fondocharts">
                                                <canvas id="bajo"></canvas>
                                                <div style="flex: 1;">
                                                    <div class="custom-text totalMatriculas"></div>
                                                </div>
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
                            </div>
                            <div id="cursos" class="content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            <div class="row text-center mt-4 center-chart">
                                <div class="col-lg-8 center-chart" style="height: 500px;">
                                    <canvas id="riesgoNotas"></canvas>
                                </div>
                            </div>

                            <div class="row text-center mt-4 mb-4 center-chart">
                                <div class="col-lg-8 center-chart">
                                    <canvas id="riesgoIngreso"></canvas>
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
            $('#menuMoodle').addClass('activo');

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
                facultades();
                programas();
                riesgo();

                function Contador() {
                    totalFacultades = $('#facultades input[type="checkbox"]').length;
                    totalProgramas = $('#programas input[type="checkbox"]').length;
                    totalPeriodos = $('#Continua, #Pregrado, #Esp, #Maestria input[type="checkbox"]').length;
                }

                function getPeriodos() {
                    var periodosSeleccionados = [];
                    var checkboxesSeleccionados = $('#Continua, #Pregrado, #Esp, #Maestria').find('input[type="checkbox"]:checked');
                    checkboxesSeleccionados.each(function() {
                        periodosSeleccionados.push($(this).val());
                    });
                    return periodosSeleccionados;
                }

                /**
                 * Método que trae las facultades y genera los checkbox en la vista
                 */
                function facultades() {
                    var datos = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('registro.facultades') }}",
                        method: 'post',
                        success: function(data) {
                            data.forEach(facultad => {
                                $('div #facultades').append(`<label"> <input type="checkbox" value="${facultad.nombre}" checked> ${facultad.nombre}</label><br>`);
                            });
                        }
                    });
                }

                /**
                 * Método que trae los periodos activos
                 */
                function periodos() {
                    var datos = $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('programas.activos') }}",
                        method: 'post',
                        async: false,
                        success: function(data) {
                            data.forEach(periodo => {
                                if (periodo.nivelFormacion == "EDUCACION CONTINUA") {
                                    $('#Continua').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                                }
                                if (periodo.nivelFormacion == "PROFESIONAL") {
                                    $('#Pregrado').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                                }
                                if (periodo.nivelFormacion == "ESPECIALISTA") {
                                    $('#Esp').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                                }
                                if (periodo.nivelFormacion == "MAESTRIA") {
                                    $('#Maestria').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                                }
                            });
                        }
                    });
                }

                function programas() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: "{{ route('todosProgramas.activos') }}",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(datos) {
                            if (datos != null) {
                                try {
                                    datos = jQuery.parseJSON(datos);
                                } catch {
                                    datos = datos;
                                }
                                $.each(datos, function(key, value) {
                                    $('#programas').append(`<li id="Checkbox${value.codprograma}" data-codigo="${value.codprograma}"><label><input id="checkboxProgramas" type="checkbox" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label></li>`);
                                });
                            }
                        },
                        error: function() {
                            $('#programas').append('<h5>No hay programas</h5>')
                        }
                    })
                }

                var buscador = $('#buscadorProgramas');
                var listaProgramas = $('.listaProgramas');
                var divProgramas = $('#programas');

                // Agregar un evento de escucha al campo de búsqueda
                buscador.on('input', function() {
                    var query = $(this).val().toLowerCase();
                    divProgramas.find('li').each(function() {
                        var label = $(this);
                        var etiqueta = label.text().toLowerCase();
                        var $checkbox = label.find('input[type="checkbox"]');

                        if (etiqueta.includes(query)) {
                            label.removeClass('d-none');
                            //label.removeAttr('d-none');
                            //$checkbox.removeClass('d-none');
                        } else {
                            label.addClass('d-none');
                            //label.addClass('hidden');
                            //$checkbox.addClass('d-none');
                        }
                    });
                });

                /**
                 * Método para verificar los periodos seleccionados
                 */
                function getPeriodos() {
                    var periodosSeleccionados = [];
                    var checkboxesSeleccionados = $('#Continua, #Pregrado, #Esp, #Maestria').find('input[type="checkbox"]:checked');
                    checkboxesSeleccionados.each(function() {
                        periodosSeleccionados.push($(this).val());
                    });
                    return periodosSeleccionados;
                }

                var programasSeleccionados = [];
                var facultadesSeleccionadas = [];
                var periodosSeleccionados = [];

                $('body').on('change', '#facultades input[type="checkbox"], .periodos input[type="checkbox"], .todos', function() {
                    if ($('#facultades input[type="checkbox"]:checked').length > 0 && $('.periodos input[type="checkbox"]:checked').length) {
                        $('#programas').empty();
                        var formData = new FormData();
                        var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                        checkboxesSeleccionados.each(function() {
                            formData.append('idfacultad[]', $(this).val());
                        });

                        var periodosSeleccionados = getPeriodos();
                        var periodos = periodosSeleccionados.map(item => item.slice(-2));

                        periodos.forEach(function(periodo) {
                            formData.append('periodos[]', periodo);
                        });

                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'post',
                            url: "{{ route('programasPeriodo.activos') }}",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(datos) {
                                if (datos != null) {
                                    try {
                                        datos = jQuery.parseJSON(datos);
                                    } catch {
                                        datos = datos;
                                    }
                                    $.each(datos, function(key, value) {
                                        $('#programas').append(`<li id="Checkbox${value.codprograma}" data-codigo="${value.codprograma}"><label><input id="checkboxProgramas" type="checkbox" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label></li>`);
                                    });
                                }
                            },
                            error: function() {
                                $('#programas').append('<h5>No hay programas</h5>')
                            }
                        })
                    } else {
                        $('#programas').empty();
                    }
                });

                /**
                 * Botones
                 */

                $("#todosContinua").change(function() {
                    if ($(this).is(":checked")) {
                        $("#Continua input[type='checkbox']").prop("checked", true);
                    } else {
                        $("#Continua input[type='checkbox']").prop("checked", false);
                    }
                });

                $("#todosPregrado").change(function() {
                    if ($(this).is(":checked")) {
                        $("#Pregrado input[type='checkbox']").prop("checked", true);
                    } else {
                        $("#Pregrado input[type='checkbox']").prop("checked", false);
                    }
                });

                $("#todosEsp").change(function() {
                    if ($(this).is(":checked")) {
                        $("#Esp input[type='checkbox']").prop("checked", true);
                    } else {
                        $("#Esp input[type='checkbox']").prop("checked", false);
                    }
                });

                $("#todosMaestria").change(function() {
                    if ($(this).is(":checked")) {
                        $("#Maestria input[type='checkbox']").prop("checked", true);
                    } else {
                        $("#Maestria input[type='checkbox']").prop("checked", false);
                    }
                });

                $("#todosFacultad").change(function() {
                    if ($(this).is(":checked")) {
                        $("#facultades input[type='checkbox']").prop("checked", true);
                    } else {
                        $("#facultades input[type='checkbox']").prop("checked", false);
                    }
                });

                $("#todosPrograma").change(function() {
                    if ($(this).is(":checked")) {
                        $("#programas input[type='checkbox']").prop("checked", true);
                    } else {
                        $("#programas input[type='checkbox']").prop("checked", false);
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

                $('#generarReporte').on('click', function(e) {
                    e.preventDefault();
                    Contador();
                    destruirTabla();
                    periodosSeleccionados = getPeriodos();
                    periodosSeleccionados.forEach(function(periodo, index, array) {
                        array[index] = '2023' + periodo;
                    });
                    console.log(periodosSeleccionados);
                    if (periodosSeleccionados.length > 0) {
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
                                var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                                console.log('entra');
                                programasSeleccionados = [];
                                facultadesSeleccionadas = [];
                                checkboxesSeleccionados.each(function() {
                                    facultadesSeleccionadas.push($(this).val());
                                });
                                estadoUsuarioFacultad();
                                riesgo();
                            } else {
                                /** Alerta */
                                programasSeleccionados = [];
                                facultadesSeleccionadas = [];
                                alerta();
                                limpiarTitulos();
                                ocultarDivs();
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
                    $('.tituloPeriodo strong').append('Periodo: ' + periodosArray);
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
                            $('.totalMatriculas').empty();
                            $('.totalMatriculas').text('Total: ' + data.total);

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
                                            weight: 'semibold',
                                            size: 16,
                                        },
                                        legend: {
                                            display: false
                                        },
                                        title: {
                                            display: true,
                                            text: data.alto + ' Matrículas',
                                            color: 'red',
                                            position: 'bottom',
                                            font: {
                                                size: 14,
                                            },
                                            fullSize: false,
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
                                            weight: 'semibold',
                                            size: 16,
                                        },
                                        legend: {
                                            display: false
                                        },
                                        title: {
                                            display: true,
                                            text: data.medio + ' Matrículas',
                                            color: '#DCCD30',
                                            position: 'bottom',
                                            font: {
                                                size: 14,
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
                                            weight: 'semibold',
                                            size: 16,
                                        },
                                        legend: {
                                            display: false
                                        },
                                        title: {
                                            display: true,
                                            text: data.bajo + ' Matrículas',
                                            color: 'Green',
                                            position: 'bottom',
                                            font: {
                                                size: 14,
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
                                    labels: ['Alto', 'Medio', 'Bajo'],
                                    datasets: [{
                                        data: [valoralto, valormedio, valorbajo],
                                        backgroundColor: ['rgba(255, 0, 0, 0.7)', 'rgba(220, 205, 48, 0.7)', 'rgba(0, 255, 0, 0.7)'],
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

                            var labels = [];
                            var valores = [];
                            var colores = [];
                            var valor;
                            Object.keys(data.data.notas).forEach(curso => {
                                labels.push(curso);
                                const valor = parseFloat(data.data.notas[curso]);
                                valores.push(valor);
                                if (valor < 3) {
                                    colores.push('rgba(255, 0, 0, 0.8)');
                                }
                                if (valor >= 3 && valor <= 3.5) {
                                    colores.push('rgba(220, 205, 48, 1)');
                                }
                                if (valor > 3.5) {
                                    colores.push('rgba(0, 255, 0, 0.8)');
                                }
                            });

                            ctx = document.getElementById('riesgoNotas').getContext('2d');
                            const dataArray = Object.values(data.data.notas);

                            chartRiesgoNotas = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Riesgo según notas',
                                        data: valores.map(value => value == "Sin Actividad" ? value : parseFloat(value)),
                                        backgroundColor: colores,
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