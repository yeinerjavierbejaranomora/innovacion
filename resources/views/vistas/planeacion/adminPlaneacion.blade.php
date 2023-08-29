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

    .deshacer {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 140px;
        height: 30px;
        border-radius: 10px;
        font-weight: 800;
        place-items: center;
        font-size: 11px;
    }

    #botonModalTiposEstudiantes,
    #botonModalProgramas,
    #botonModalOperado {
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
        min-height: 600px;
        max-height: 600px;
    }

    #cardProgramas {
        max-height: 500px;
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

    #seccion{
        background: #FFFFFF;
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
                    <h3><strong> Bienvenido {{auth()->user()->nombre}}! - Informe de Facultades Planeación </strong></h3>
                </div>
            </div>


        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col 4 text-center">
                    <a type="button" class="btn boton" href="{{ route('home.mafi') }}">
                        Admisiones
                    </a>
                </div>
                <div class="col 4 text-center">
                    <a type="button" class="btn boton" href="{{ route('home.moodle') }}">
                        Moodle
                    </a>
                </div>
            </div>
            <br>
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
                        <div class="text-center col-8">
                            <h5 id="tituloNiveles"><strong>Periodos Activos</strong></h5>
                        </div>
                        <div class="text-start">
                            <div id="periodos">
                            <!--Accordion-->
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <!--Formación continua-->
                                        <div class="card">
                                            <div class="card-header" id="heading2" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        For. Contínua
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosContinua" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosContinua" name="todosContinua" checked>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#periodos">
                                                <div class="card-body periodos" style="width:100%;" id="Continua"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <!--Pregrado-->
                                        <div class="card">
                                            <div class="card-header" id="heading1" style="width:100%;cursor:pointer;" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        Pregrado
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosPregrado" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
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
                                            <div class="card-header text-center" id="HeadingFacultades" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#acordionFacultades" aria-expanded="false" aria-controls="acordionFacultades">
                                                <h5><strong>Seleccionar Facultades</strong></h5>
                                            </div>
                                            <div class="card-body text-start collapse show" id="acordionFacultades" aria-labelledby="HeadingFacultades">
                                                <div name="facultades" id="facultades"></div>
                                            </div>
                                            <div class="card-footer text-center" style="height: 55px;">
                                                <button type="button" id="deshacerFacultades" class="btn deshacer col-5">Deshacer Todas</button>
                                                <button type="button" id="seleccionarFacultades" class="btn deshacer col-6">Seleccionar Todas</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <!--Especialización-->
                                        <div class="card">
                                            <div class="card-header" id="heading3" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        Especialización
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosEsp" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
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
                                            <div class="card-header" id="heading4" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        Maestría
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosMaestria" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
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
                                            <div class="card-header text-center" id="HeadingProgramas" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#acordionProgramas" aria-expanded="false" aria-controls="acordionProgramas">
                                                <h5><strong>Seleccionar Programas</strong></h5>
                                            </div>
                                            <div class="card-body text-start collapse shadow" id="acordionProgramas" aria-labelledby="headingProgramas" style="overflow: auto;">
                                                <div name="programas" id="programas"></div>
                                            </div>
                                            <div class="card-footer text-center" style="height: 55px;">
                                                <button type="button" id="deshacerProgramas" class="btn deshacer col-5">Deshacer Todos</button>
                                                <button type="button" id="seleccionarProgramas" class="btn deshacer col-6">Seleccionar Todos</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                        </div>
                        </div>
                        <div class="text-center col-8 mt-3" style="height: 30px;">
                            <button type="button" id="deshacerPeriodos" class="btn deshacer">Deshacer Todos</button>
                            <button type="button" id="seleccionarPeriodos" class="btn deshacer">Seleccionar Todos</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center justify-content-center">
                <button class="btn button-informe" type="button" id="generarReporte">
                    Generar Reporte
                </button>
        </div>

    </div>

    <div class="row justify-content-start mt-5 columnas">
        <div class="col-6 text-center " id="colSelloFinanciero">
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
        <div class="col-6 text-center " id="colRetencion">
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
        <div class="col-6 text-center " id="colPrimerIngreso">
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
        <div class="col-6 text-center " id="colTipoEstudiantes">
            <div class="card shadow mb-6 graficosBarra">
                <div class="card-header">
                    <h5 id="tituloTipos"><strong>Tipos de estudiantes</strong></h5>
                    <h5 class="tituloPeriodo"><strong></strong></h5>
                </div>
                <div class="card-body">
                    <canvas id="tipoEstudiante"></canvas>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="" id="botonModalTiposEstudiantes" class="btn botonModal" data-toggle="modal" data-target="#modalTiposEstudiantes"> Ver más </a>
                </div>
            </div>
        </div>
        <div class="col-6 text-center " id="colOperadores">
            <div class="card shadow mb-6 graficosBarra">
                <div class="card-header">
                    <h5 id="tituloOperadores"><strong>Operadores</strong></h5>
                    <h5 class="tituloPeriodo"><strong></strong></h5>
                </div>
                <div class="card-body">
                    <canvas id="operadores" style="height: 400px;"></canvas>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <a href="" id="botonModalOperador" class="btn botonModal" data-toggle="modal" data-target="#modalOperadoresTotal"> Ver más </a>
                </div>
            </div>
        </div>
        <div class="col-6 text-center " id="colProgramas">
            <div class="card shadow mb-4 graficosBarra" id="ocultarGraficoProgramas">
                <div class="card-header">
                    <h5 id="tituloProgramas"><strong>Programas con mayor cantidad de admitidos</strong></h5>
                    <h5 class="tituloPeriodo"><strong></strong></h5>
                </div>
                <div class="card-body">
                    <canvas id="estudiantesProgramas"></canvas>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <div class="mr-3">
                        <a href="" id="botondataTable" class="btn botonModal">Ver informe detallado </a>
                    </div>
                    <div class="ml-1">
                        <a href="" id="botonModalProgramas" class="btn botonModal" data-toggle="modal" data-target="#modalProgramasTotal"> Ver más </a>
                    </div>
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

    <!-- Modal Todos los Operadores de la Ibero -->
    <div class="modal fade" id="modalOperadoresTotal" tabindex="-1" role="dialog" aria-labelledby="modalOperadoresTotal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="tituloOperadoresTotal"><strong>Operadores</strong></h5>
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
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="tituloProgramasTotal"><strong>Programas</strong></h5>
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
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="tituloTiposTotal"><strong>Tipos de estudiantes</strong></h5>
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

    <!-- Modal Tabla Malla Curricular -->
    <div class="modal fade" id="modalMallaCurricular" tabindex="-1" role="dialog" aria-labelledby="modalMallaCurricular" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document" style="height:1000px;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="tituloMalla"><strong></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--Datatable-->
                    <div class="table">
                        <table id="mallaCurricular" class="display" style="width:100%">
                        </table>
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
    $(document).ready(function() {
        var tabla = <?php echo json_encode($tabla); ?>;

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

        periodos();
        llamadoFunciones();
        facultades();

        /**
         * Llamado a todos los scripts
         */
        function llamadoFunciones() {
            graficoSelloFinanciero();
            graficoRetencion();
            graficoSelloPrimerIngreso();
            graficoTipoDeEstudiante();
            graficoOperadores();
            graficoProgramas();
        }

        function limpiarTitulos() {
            var elementosTitulos = $('#tituloEstadoFinanciero, #tituloRetencion, #tituloEstudiantesNuevos, #tituloTipos, #tituloOperadores, #tituloProgramas, #tituloOperadoresTotal, #tituloTiposTotal, #tituloProgramasTotal').find("strong");
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

        function limpiarTituloModal() {
            var elementosTitulos = $('#tituloOperadoresTotal, #tituloTiposTotal, #tituloProgramasTotal').find("strong");
            var parteEliminar = ': ';
            elementosTitulos.each(function() {
                var contenidoActual = $(this).text();
                var contenidoLimpio = contenidoActual.replace(new RegExp(parteEliminar + '.*'), '');
                $(this).text(contenidoLimpio);
            });
        }

        function estadoUsuarioPrograma() {
            limpiarTitulos();
            var periodos = getPeriodos();
            $("#mensaje").empty();
            if (programasSeleccionados.length > 1) {
                var programasArray = Object.values(programasSeleccionados);
                var programasFormateados = programasArray.join(' - ');
                var textoNuevo = "<h4><strong>Informe programas: " + programasFormateados + "</strong></h4>";
                $('#tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + programasFormateados);
            } else {
                var textoNuevo = "<h4><strong>Informe programa " + programasSeleccionados + "</strong></h4>";
                $('#tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + programasSeleccionados);
            }
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
                $('#tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + facultadesFormateadas);
            } else {

                var textoNuevo = "<h4><strong>Informe facultad: " + facultadesFormateadas + "</strong></h4>";
                $('#tituloEstadoFinanciero strong, #tituloRetencion strong, #tituloEstudiantesNuevos strong, #tituloTipos strong, #tituloOperadores strong, #tituloProgramas strong').append(': ' + facultadesFormateadas);
            }
            $('.tituloPeriodo strong').append('Periodo: ' + periodosFormateados);
            $("#mensaje").show();
            $("#mensaje").html(textoNuevo);
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

        function getPeriodos() {
            var periodosSeleccionados = [];
            var checkboxesSeleccionados = $('#Continua, #Pregrado, #Esp, #Maestria').find('input[type="checkbox"]:checked');
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
            [chartEstudiantesActivos, chartProgramas, chartRetencion, chartSelloPrimerIngreso, chartTipoEstudiante, chartOperadores].forEach(chart => chart.destroy());
        }

        /**
         * Método que oculta todos los divs de los gráficos, antes de generar algún reporte
         */
        function ocultarDivs() {
            $('#colSelloFinanciero, #colRetencion, #colPrimerIngreso, #colTipoEstudiantes, #colOperadores, #colProgramas').addClass('hidden');
        }

        /**
         * Método que trae la información de toda la Ibero 
         * */
        function informacionGeneral() {
            $('#mensaje').show();
            destruirGraficos();
            llamadoFunciones();
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

        $('#deshacerFacultades').on('click', function(e) {
            $('#facultades input[type="checkbox"]').prop('checked', false);
        });

        $('#seleccionarFacultades').on('click', function(e) {
            $('#facultades input[type="checkbox"]').prop('checked', true);
        });

        var programasSeleccionados = [];
        var facultadesSeleccionadas = [];
        var periodosSeleccionados = [];
        $('#generarReporte').on('click', function(e) {
            e.preventDefault();
            Contador();
            destruirTable();
            var periodosSeleccionados = getPeriodos();
            periodosSeleccionados.forEach(function(periodo, index, array) {
                array[index] = '2023' + periodo;
            });

            if ($('#deshacerProgramas, #seleccionarProgramas').is(':hidden')) {
                $('#deshacerProgramas, #seleccionarProgramas').show();
            }
            if (periodosSeleccionados.length > 0) {
                if ($('#programas input[type="checkbox"]:checked').length > 0 && $('#programas input[type="checkbox"]:checked').length < totalProgramas) {
                    var checkboxesProgramas = $('#programas input[type="checkbox"]:checked');
                    programasSeleccionados = [];
                    checkboxesProgramas.each(function() {
                        programasSeleccionados.push($(this).val());
                    });
                    estadoUsuarioPrograma();
                    $("#colProgramas").addClass("hidden");
                    graficosporPrograma(programasSeleccionados, periodosSeleccionados);
                    dataTable(periodosSeleccionados);
                } else {
                    if ($('#facultades input[type="checkbox"]:checked').length > 0) {
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
                        graficosporFacultad(facultadesSeleccionadas, periodosSeleccionados);
                    } else {
                        /** Alerta */
                        programasSeleccionados = [];
                        facultadesSeleccionadas = [];
                        destruirGraficos();
                        ocultarDivs();
                        alerta();
                    }
                }
            } else {
                /** Alerta Seleccionar al menos un periodo */
                programasSeleccionados = [];
                facultadesSeleccionadas = [];
                periodosSeleccionados = [];
                destruirGraficos();
                ocultarDivs();
                alertaPeriodos();
            }

            vacio();
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

        function vacio() {
            if ($("#colEstudiantes, #colSelloFinanciero, #colRetencion, #colPrimerIngreso, #colTipoEstudiantes, #colOperadores, #colProgramas").hasClass("hidden")) {
                $('#vacio').addClass('hidden');
            } else {
                $('#vacio').removeClass('hidden');
            }
        }

        $('body').on('change', '#facultades input[type="checkbox"], #periodos input[type="checkbox"]', function() {
            if ($('#facultades input[type="checkbox"]:checked').length > 0 && $('#periodos input[type="checkbox"]:checked').length) {
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
                                $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label><br>`);
                            });
                        }
                    },
                    error: function() {
                        console.log('entra');
                        $('#programas').append('<h5>No hay programas</h5>')
                    }
                })
            } else {
                $('#programas').empty();
            }
        });

        /**
         * Método que genera el gráfico de sello financiero
         */
        var chartEstudiantesActivos;

        function graficoSelloFinanciero() {
            var url = '/home/estudiantesActivos/' + tabla;
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
                                label = 'INACTIVO';
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
                            datalabels: {
                                color: 'black',
                                font: {
                                    weight: 'bold',
                                    size: 12
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
                    plugins: [ChartDataLabels]
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
            var url = '/home/retencionActivos/' + tabla;
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
                                label = 'SIN MARCACIÓN'
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
                            datalabels: {
                                color: 'black',
                                font: {
                                    weight: 'bold',
                                    size: 12
                                },
                            },
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
                    plugins: [ChartDataLabels]
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
            var url = '/home/estudiantesPrimerIngreso/' + tabla;
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
                                label = 'INACTIVO';
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
                            datalabels: {
                                color: 'black',
                                font: {
                                    weight: 'bold',
                                    size: 12
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
                    plugins: [ChartDataLabels]
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
            var url = '/home/tipoEstudiantes/' + tabla;
            $.getJSON(url, function(data) {
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
                            if (label.includes("ESTUDIANTE ")) {
                                label = label.replace(/ESTUDIANTE\S*/i, "");
                            }
                            return label;
                        }),
                        datasets: [{
                            label: 'Tipos de estudiantes',
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
                        maintainAspectRatio: false,
                        responsive: true,
                        plugins: {
                            scales: {
                                y: {
                                    max: yMax,
                                    beginAtZero: true
                                }
                            },
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
                    plugins: [ChartDataLabels],
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
            var url = '/home/operadores/' + tabla;
            $.getJSON(url, function(data) {
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
            });
        }

        /**
         * Método que genera el gráfico con los 5 programas que tienen mas estudiantes inscritos 
         */

        var chartProgramas;

        function graficoProgramas() {
            var url = '/home/estudiantesProgramas/' + tabla;
            $.getJSON(url, function(data) {
                var labels = data.data.map(function(elemento) {
                    return elemento.programa;
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
                var ctx = document.getElementById('estudiantesProgramas').getContext('2d');
                chartProgramas = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels.map(function(label, index) {
                            if (label == '') {
                                label = 'IBERO';
                            }
                            return label;
                        }),
                        datasets: [{
                            label: 'Programas con mayor cantidad de estudiantes',
                            data: valores,
                            backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                'rgba(186,186,186,1)', 'rgba(56,101,120,1)', 'rgba(229,137,7,1)'
                            ],
                            datalabels: {
                                anchor: 'end',
                                align: 'top',
                            },
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
            });
        }

        /**
         * Método que vacía el contenido de todos los gráficos una vez el usuario desea visualizar unicamente los de alguna facultad
         */

        function graficosporFacultad(facultades, periodos) {
            if (chartProgramas || chartEstudiantes || chartEstudiantesActivos || chartRetencion || chartSelloPrimerIngreso ||
                chartTipoEstudiante || chartOperadores) {
                destruirGraficos();
                $("#ocultarGraficoProgramas").show();

                graficoSelloFinancieroPorFacultad(facultades, periodos);
                graficoRetencionPorFacultad(facultades, periodos);
                graficoSelloPrimerIngresoPorFacultad(facultades, periodos);
                graficoTiposDeEstudiantesFacultad(facultades, periodos);
                graficoOperadoresFacultad(facultades, periodos);
                graficoProgramasFacultad(facultades, periodos);
            }
        }


        /**
         * Método que genera el gráfico de sello financiero de alguna facultad en específico
         */
        function graficoSelloFinancieroPorFacultad(facultades, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.sello.facultad',['tabla' => ' ']) }}" + tabla,
                data: {
                    idfacultad: facultades,
                    periodos: periodos
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
                                    label = 'INACTIVO';
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
                                    color: 'black',
                                    font: {
                                        weight: 'bold',
                                        size: 12
                                    },
                                },
                                datalabels: {
                                    color: 'black',
                                    font: {
                                        weight: 'bold',
                                        size: 12
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
                        plugins: [ChartDataLabels]
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
        function graficoRetencionPorFacultad(facultades, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.retencion.facultad',['tabla' => ' ']) }}" + tabla,
                data: {
                    idfacultad: facultades,
                    periodos: periodos
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
                                    label = 'SIN MARCACIÓN'
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
                                    color: 'black',
                                    font: {
                                        weight: 'bold',
                                        size: 12
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
                        plugins: [ChartDataLabels]
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
        function graficoSelloPrimerIngresoPorFacultad(facultades, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.primerIngreso.facultad',['tabla' => ' ']) }}" + tabla,
                data: {
                    idfacultad: facultades,
                    periodos: periodos
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
                                    label = 'INACTIVO';
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
                                    color: 'black',
                                    font: {
                                        weight: 'bold',
                                        size: 12
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
                        plugins: [ChartDataLabels]
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
        function graficoTiposDeEstudiantesFacultad(facultades, periodos) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.tipo.facultad',['tabla' => ' ']) }}" + tabla,
                data: {
                    idfacultad: facultades,
                    periodos: periodos
                },
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
        function graficoOperadoresFacultad(facultades, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.operador.facultad',['tabla' => ' ']) }}" + tabla,
                data: {
                    idfacultad: facultades,
                    periodos: periodos
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
        function graficoProgramasFacultad(facultades, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('programas.estudiantes.facultad',['tabla' => ' ']) }}" + tabla,
                data: {
                    idfacultad: facultades,
                    periodos: periodos
                },
                beforeSend: function() {
                    // Deshabilitar los checkboxes antes de la solicitud AJAX
                    $('div #facultades input[type="checkbox"]').prop('disabled', true);
                },
                success: function(data) {
                    data = jQuery.parseJSON(data);

                    var labels = data.data.map(function(elemento) {
                        return elemento.programa;
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
        function graficosporPrograma(programas, periodos) {
            if (chartProgramas || chartEstudiantes || chartEstudiantesActivos || chartRetencion || chartSelloPrimerIngreso ||
                chartTipoEstudiante || chartOperadores) {
                destruirGraficos();

                $("#ocultarGraficoProgramas").hide();

                grafioSelloFinancieroPorPrograma(programas, periodos);
                graficoRetencionPorPrograma(programas, periodos);
                graficoSelloPrimerIngresoPorPrograma(programas, periodos);
                graficoTiposDeEstudiantesPrograma(programas, periodos);
                graficoOperadoresPrograma(programas, periodos);
            }
        }

        /**
         * Método que genera el gráfico de sello financiero de algún programa en específico
         */
        function grafioSelloFinancieroPorPrograma(programas, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.sello.programa',['tabla' => ' ']) }}" + tabla,
                data: {
                    programa: programas,
                    periodos: periodos
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
                                    label = 'INACTIVO';
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
                                    color: 'black',
                                    font: {
                                        weight: 'bold',
                                        size: 12
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
                        plugins: [ChartDataLabels]
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
        function graficoRetencionPorPrograma(programas, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.retencion.programa',['tabla' => ' ']) }}" + tabla,
                data: {
                    programa: programas,
                    periodos: periodos
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
                                    label = 'SIN MARCACIÓN'
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
                                    color: 'black',
                                    font: {
                                        weight: 'bold',
                                        size: 12
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
                        plugins: [ChartDataLabels]
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
        function graficoSelloPrimerIngresoPorPrograma(programas, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.primerIngreso.programa',['tabla' => ' ']) }}" + tabla,
                data: {
                    programa: programas,
                    periodos: periodos
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
                                    label = 'INACTIVO';
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
                                    color: 'black',
                                    font: {
                                        weight: 'bold',
                                        size: 12
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
                        plugins: [ChartDataLabels]
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
        function graficoTiposDeEstudiantesPrograma(programas, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.tipo.programa',['tabla' => ' ']) }}" + tabla,
                data: {
                    programa: programas,
                    periodos: periodos
                },

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
        function graficoOperadoresPrograma(programas, periodos) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('estudiantes.operador.programa',['tabla' => ' ']) }}" + tabla,
                data: {
                    programa: programas,
                    periodos: periodos
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
            var periodos = getPeriodos();
            graficoOperadoresTotal(periodos);
        });

        $('#botonModalProgramas').on("click", function(e) {
            e.preventDefault();
            if (chartProgramasTotal) {
                chartProgramasTotal.destroy();
            }
            var periodos = getPeriodos();
            graficoProgramasTotal(periodos);
        });

        $('#botonModalTiposEstudiantes').on("click", function(e) {
            e.preventDefault();
            if (chartTiposEstudiantesTotal) {
                chartTiposEstudiantesTotal.destroy();
            }
            var periodos = getPeriodos();
            tiposEstudiantesTotal(periodos);
        });

        var chartTiposEstudiantesTotal

        function tiposEstudiantesTotal(periodosSeleccionados) {
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
         * Método que trae todos los operadores de la Ibero
         */
        var chartOperadoresTotal;

        function graficoOperadoresTotal(periodosSeleccionados) {
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

        function graficoProgramasTotal(periodosSeleccionados) {
            var data;
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
                        return elemento.programa;
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

        $('#botondataTable').on("click", function(e) {
            e.preventDefault();
            destruirTable();
            var periodos = getPeriodos();
            dataTable(periodos);
        });


        function dataTable(periodos) {
            $('#colTabla').removeClass('hidden');
            var url, data;
            var table;
            if (programasSeleccionados.length > 0) {
                url = "{{ route('planeacionProgramas.tabla.programa')}}",
                    data = {
                        periodos: periodos,
                        programas: programasSeleccionados
                    }
            } else {
                if (facultadesSeleccionadas.length > 0) {
                    url = "{{ route('planeacionProgramas.tabla.facultad')}}",
                        data = {
                            periodos: periodos,
                            facultad: facultadesSeleccionadas
                        }
                } else {
                    url = "{{ route('planeacionProgramas.tabla')}}",
                        data = {
                            periodos: periodos
                        }
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
                    try {
                        data = parseJSON(data);
                    } catch {
                        data = data;
                    }
                    var dataTableData = [];
                    for (const programaKey in data) {
                        if (data.hasOwnProperty(programaKey)) {
                            const programa = data[programaKey];
                            var rowData = [
                                programaKey,
                                programa.programa,
                                programa.Total,
                                programa.Sello,
                                programa.Retencion,
                            ];
                            dataTableData.push(rowData);
                        }
                    }

                    table = $('#datatable').DataTable({
                        "data": dataTableData,
                        'pageLength': 10,
                        "order": [2, 'desc'],
                        "columns": [{
                                title: 'Código de programa'
                            },
                            {
                                title: 'Programa'
                            },
                            {
                                title: 'Estudiantes inscritos',
                                className: 'dt-center'
                            },
                            {
                                title: 'Con Sello Financiero',
                            },
                            {
                                title: 'ASP',
                            },
                            {
                                defaultContent: "<button type='button' id='btn-table' class='malla btn btn-warning' data-toggle='modal' data-target='#modalMallaCurricular'><i class='fa-solid fa-bars'></i></button>",
                                title: 'Malla Curricular',
                                className: 'dt-center'
                            },
                        ]
                    });

                    function obtenerData(tbody, table) {
                        $(tbody).on("click", "button.malla", function() {
                            var datos = table.row($(this).parents("tr")).data();
                            var programa = datos[0];
                            var nombrePrograma = datos[1];
                            mallaPrograma(programa, nombrePrograma);
                        })
                    }
                    obtenerData("#datatable tbody", table);
                }

            });
            console.log(table);
        }

        function mallaPrograma(programa, nombrePrograma) {
            limpiarModal();
            $('#tituloMalla').empty();
            $('#tituloMalla').append('Materias programa ' + nombrePrograma);
            var datos = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('mallaPrograma.tabla') }}",
                data: {
                    programa: programa
                },
                method: 'post',
                success: function(data) {
                    try {
                        data = parseJSON(data);
                    } catch {
                        data = data;
                    }
                    console.log(data);
                    var dataTableData = [];

                    for (const cursoKey in data) {
                        if (data.hasOwnProperty(cursoKey)) {
                            const curso = data[cursoKey];
                            var rowData = [
                                cursoKey,
                                curso.nombreMateria,
                                curso.Total,
                                curso.Sello,
                                curso.Retencion,
                            ];
                            dataTableData.push(rowData);
                        }
                    }

                    table = $('#mallaCurricular').DataTable({
                        "dom": 'Bfrtip',
                        "data": dataTableData,
                        'pageLength': 10,
                        "buttons": [
                            'copy', 'excel', 'pdf', 'print'
                        ],
                        "columns": [{
                                title: 'Codigo de Materia'
                            },
                            {
                                title: 'Nombre Materia',
                            },
                            {
                                title: 'Estudiantes inscritos',
                                className: 'dt-center'
                            },
                            {
                                title: 'Con sello Financiero',
                                className: 'dt-center'
                            },
                            {
                                title: 'ASP',
                                className: 'dt-center'
                            },
                            {
                                data: null,
                                title: 'tutor',
                                visible: false
                            }
                        ],
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                        },
                    });
                }
            });
        }

        function limpiarModal() {
            if ($.fn.DataTable.isDataTable('#mallaCurricular')) {
                $("#mallaCurricular").remove();
                table.destroy();
                $('#mallaCurricular').DataTable().destroy();
                $('#mallaCurricular tbody').empty();
            }
        }

        function destruirTable() {
            $('#colTabla').addClass('hidden');
            if ($.fn.DataTable.isDataTable('#datatable')) {

                $('#datatable').dataTable().fnDestroy();
                $('#datatable tbody').empty();
                $("#datatable tbody").off("click", "button.malla");
            }
        }
    });
</script>

<!-- incluimos el footer -->
@include('layout.footer')
</div>