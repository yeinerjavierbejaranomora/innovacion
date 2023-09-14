@include('layout.header')

@include('menus.menu_Coordinador')
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
            <div class="row justify-content-start mb-3" id="seccion">

                <!--Columna Niveles de Formación-->
                <div class="col-12 text-start mt-1">
                    <div class="card-body mb-3" id="cardNivel">
                        <div class="row">
                            <div class="text-center col-8">
                                <h5 id="tituloNiveles" class="text-dark"><strong>Periodos Activos</strong></h5>
                            </div>
                            <div class="text-center col-4">
                                <h5 id="tituloNiveles" class="text-dark"><strong>Programas</strong></h5>
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
                                                        @foreach ($programas as $programa)
                                                        <li id="Checkbox{{$programa->codprograma}}" data-codigo="{{$programa->codprograma}}"><label><input id="checkboxProgramas" type="checkbox" name="programa[]" value="{{$programa->codprograma}}" checked> {{$programa->programa}}</label></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
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

            <div class="row justify-content-start mt-5 columnas">
                <div class="col-6 text-center " id="colSelloFinanciero">
                    <div class="card shadow mb-6 graficos">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8 d-flex align-items-center justify-content-center">
                                    <h5 id="tituloEstadoFinanciero"><strong>Estado Financiero</strong></h5>
                                    <h5 class="tituloPeriodo"><strong></strong></h5>
                                </div>
                                <div class="col-2 text-right">
                                    <span data-toggle="tooltip" title="Aquí se muestra un resumen del estado financiero (con sello, con retención o ASP) de los estudiantes proyectados o programados." data-placement="right">
                                        <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fondocharts">
                            <canvas id="activos"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center " id="colRetencion">
                    <div class="card shadow mb-6 graficos">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8 d-flex align-items-center justify-content-center">
                                    <h5 id="tituloRetencion"><strong>Estado Financiero - Retención</strong></h5>
                                    <h5 class="tituloPeriodo"><strong></strong></h5>
                                </div>
                                <div class="col-2 text-right">
                                    <span data-toggle="tooltip" title="Aquí se muestra un resumen del estado en plataforma de los estudiantes proyectados o programados que su estado financiero se encuentra en retención." data-placement="right">
                                        <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fondocharts">
                            <canvas id="retencion"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center " id="colPrimerIngreso">
                    <div class="card shadow mb-6 graficos">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8 d-flex align-items-center justify-content-center">
                                    <h5 id="tituloEstudiantesNuevos"><strong>Estudiantes nuevos - Estado Financiero</strong></h5>
                                    <h5 class="tituloPeriodo"><strong></strong></h5>
                                </div>
                                <div class="col-2 text-right">
                                    <span data-toggle="tooltip" title="En este gráfico se puede visualizar el Estado financiero de todos los estudiantes proyectados o programados de primer ingreso y transferentes." data-placement="right">
                                        <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fondocharts">
                            <canvas id="primerIngreso"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center " id="colAntiguos">
                    <div class="card shadow mb-6 graficos">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8 d-flex align-items-center justify-content-center">
                                    <h5 id="tituloEstudiantesAntiguos"><strong>Estudiantes antiguos - Estado Financiero</strong></h5>
                                    <h5 class="tituloPeriodo"><strong></strong></h5>
                                </div>
                                <div class="col-2 text-right">
                                    <span data-toggle="tooltip" title="En este gráfico se puede visualizar el Estado financiero de todos los estudiantes antiguos." data-placement="right">
                                        <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body center-chart fondocharts">
                            <canvas id="antiguos"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-6 text-center " id="colTipoEstudiantes">
                    <div class="card shadow mb-6 graficosBarra">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8 d-flex align-items-center justify-content-center">
                                    <h5 id="tituloTipos"><strong>Tipos de estudiantes</strong></h5>
                                    <h5 class="tituloPeriodo"><strong></strong></h5>
                                </div>
                                <div class="col-2 text-right">
                                    <span data-toggle="tooltip" title="Ilustra los tipos de estudiantes activos, además cuenta la opción 'Ver más' para ampliar la cantidad de datos mostrados." data-placement="right">
                                        <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fondocharts">
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
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8 d-flex align-items-center justify-content-center">
                                    <h5 id="tituloOperadores"><strong>Estudiantes activos por operador</strong></h5>
                                    <h5 class="tituloPeriodo"><strong></strong></h5>
                                </div>
                                <div class="col-2 text-right">
                                    <span data-toggle="tooltip" title="Muestra la cantidad de estudiantes inscritos por cada operador, también cuenta con la opción de 'Ver más'." data-placement="right">
                                        <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body fondocharts">
                            <canvas id="operadores" style="height: 400px;"></canvas>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="" id="botonModalOperador" class="btn botonModal" data-toggle="modal" data-target="#modalOperadoresTotal"> Ver más </a>
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

        <!-- Modal Estudiantes planeados -->
        <div class="modal fade" id="modalEstudiantesPlaneados" tabindex="-1" role="dialog" aria-labelledby="modalEstudiantesPlaneados" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="height:1000px;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="tituloEstudiantes"><strong></strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--Datatable-->
                        <div class="table">
                            <table id="estudiantesPlaneados" class="display" style="width:100%">
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal Buscar estudiante -->
         <div class="modal fade" id="modalBuscarEstudiante" tabindex="-1" role="dialog" aria-labelledby="modalBuscarEstudiante" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="height:1000px;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="tituloBuscar"><strong>Buscar estudiante</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="form-inline" id="formBuscar">
                        @csrf
                        <h5>Id banner del estudiante</h5>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="idBanner" class="sr-only">Id Banner</label>
                            <input type="text" class="form-control" id="idBanner" placeholder="Id Banner">
                        </div>
                        <button type="submit" class="btn botonModal mb-2">Buscar</button>
                    </form class="mt-2">

                    <div class="hidden mt-3 mb-3" id="dataEstudiante">
                            <h5 id="primerApellido" class="text-black"></h5>
                            <h5 id="Sello" class="text-black"></h5>
                            <h5 id="Operador" class="text-black"></h5>
                            <h5 id="tipEstudiante" class="text-black"></h5>
                        </div>
                        <br>
                        <!--Datatable con id Banner del estudiante-->
                        <div class="text-center text-black hidden" id='tituloTablaBuscar'>
                            <h4>Materias inscritas</h4>
                        </div>
                        <div class="table" id="divTablaBuscador">
                            <table id="buscarEstudiante" class="display" style="width:100%">
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
            $('#menuPlaneacion').addClass('activo');
            var tabla = <?php echo json_encode($tabla); ?>;
            var programasSeleccionados = [];
            var periodosSeleccionados = [];
            console.log(tabla);
            programasUsuario();
            Contador();
            vistaEntrada();

            periodos();
            invocarGraficos();
            getPeriodos();
            dataTable();

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
            }

            /**
             * Método que trae los periodos activos
             */
            function periodos() {
                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('periodosPrograma.activos') }}",
                    data: {
                        programas: programasSeleccionados,
                    },
                    method: 'post',
                    async: false,
                    success: function(datos) {
                        console.log(datos);
                        datos.forEach(periodo => {
                            periodosSeleccionados.push(periodo.periodo);
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
                periodosSeleccionados.forEach(function(periodo, index, array) {
                    array[index] = '2023' + periodo;
                });
            }

            function vistaEntrada() {
                var key = Object.keys(programasSeleccionados);
                var cantidadProgramas = key.length;
                var valorPrograma = programasSeleccionados[key[0]];

                if (cantidadProgramas === 1) {
                    $('#colCardProgramas').hide();
                    var textoNuevo = "<h3>A continuación podrás visualizar los datos de tu Programa: " + valorPrograma + " </h3>";
                    $("#mensaje").html(textoNuevo);
                }

            }

            function getPeriodos() {
                var periodosSeleccionados = [];
                var checkboxesSeleccionados = $('#Continua, #Pregrado, #Esp, #Maestria').find('input[type="checkbox"]:checked');
                checkboxesSeleccionados.each(function() {
                    periodosSeleccionados.push($(this).val());
                });
                periodosSeleccionados.forEach(function(periodo, index, array) {
                    array[index] = '2023' + periodo;
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
                graficoSelloAntiguos();
                graficoOperadores();
            }

            /**
             * Método que oculta todos los divs de los gráficos, antes de generar algún reporte
             */
            function ocultarDivs() {
                $('#colEstudiantes, #colSelloFinanciero, #colRetencion, #colPrimerIngreso, #colAntiguos, #colTipoEstudiantes, #colOperadores, #colProgramas').addClass('hidden');
            }

            /**
             * Método que cuenta la cantidad de programas de la facultad correspondiente
             */
            var totalProgramas;

            function Contador() {
                totalProgramas = $('#programas input[type="checkbox"]').length;
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
                [chartEstudiantesActivos, chartRetencion, chartSelloPrimerIngreso, chartTipoEstudiante, chartSelloAntiguos, chartOperadores].forEach(chart => chart.destroy());
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
                periodosSeleccionados = getPeriodos();
                Contador();
                if (periodosSeleccionados.length > 0) {
                    if ($('#programas input[type="checkbox"]:checked').length > 0) {
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
                } else {
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
                    chartTipoEstudiante || chartOperadores || chartSelloAntiguos) {
                    destruirGraficos();
                }
                $(".facultadtitulos").hide();
                $(".programastitulos").show();

                invocarGraficos();
            }

            /**
             * Método que genera el gráfico de sello financiero de algún programa en específico
             */
            var chartEstudiantesActivos;

            function grafioSelloFinanciero() {
                var data;
                var url = "{{ route('estudiantes.sello.programa',['tabla' => ' ']) }}" + tabla,
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
                        var labels = [];
                        var valores = [];

                        for (var propiedad in data) {
                            if (data.hasOwnProperty(propiedad)) {
                                labels.push(propiedad + ': ' + data[propiedad]);
                                valores.push(data[propiedad]);
                            }
                        }

                        var suma = valores.reduce(function(acumulador, valorActual) {
                            return acumulador + valorActual;
                        }, 0);

                        // Crear el gráfico circular
                        var ctx = document.getElementById('activos').getContext('2d');
                        chartEstudiantesActivos = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 0.5)', 'rgba(223, 193, 78, 1)', 'rgba(56,101,120,1)', 'rgba(208,171,75, 1)']
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
                                        formatter: function(value, context) {
                                            return context.chart.data.datasets[0].data[context.dataIndex] >= 10 ? value : '';
                                        }
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'border',
                                        textMargin: 2
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
                                    },
                                    title: {
                                        display: true,
                                        text: 'TOTAL SELLO: ' + suma,
                                        font: {
                                            size: 14,
                                            Style: 'bold',
                                        },
                                        position: 'bottom'
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
            var chartRetencion;

            function graficoRetencion() {
                var data;
                var url = "{{ route('estudiantes.retencion.programa',['tabla' => ' ']) }}" + tabla,
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
                        try {
                            data = jQuery.parseJSON(data);
                        } catch {
                            data = data;
                        }
                        var total = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });

                        total = total.reduce((a, b) => a + b, 0);

                        var labels = data.data.map(function(elemento) {
                            if (elemento.autorizado_asistir.startsWith('ACTIVO EN ')) {
                                return elemento.autorizado_asistir.replace('ACTIVO EN ', '').trim();
                            } else {
                                return elemento.autorizado_asistir;
                            }
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
                        var ctx = document.getElementById('retencion').getContext('2d');
                        chartRetencion = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == '') {
                                        label = 'SIN MARCACIÓN'
                                    }
                                    return label + ': ' + valores[index];
                                }),
                                datasets: [{
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 1)', 'rgba(223, 193, 78, 1)', 'rgba(208,171,75, 1)',
                                        'rgba(208,171,75, 1)'
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
                                        display: false,
                                    }
                                },
                            },
                            plugins: [ChartDataLabels],
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
                var data;
                var url = "{{ route('estudiantes.primerIngreso.programa',['tabla' => ' ']) }}" + tabla,
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
                        var labels = [];
                        var valores = [];

                        for (var propiedad in data) {
                            if (data.hasOwnProperty(propiedad)) {
                                labels.push(propiedad + ': ' + data[propiedad]);
                                valores.push(data[propiedad]);
                            }
                        }

                        var suma = valores.reduce(function(acumulador, valorActual) {
                            return acumulador + valorActual;
                        }, 0);

                        // Crear el gráfico circular
                        var ctx = document.getElementById('primerIngreso').getContext('2d');
                        chartSelloPrimerIngreso = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == 'TOTAL') {
                                        return label + ': ' + suma;
                                    } else {
                                        return label;
                                    }
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 0.5)', 'rgba(223, 193, 78, 1)', 'rgba(56,101,120,1)', 'rgba(208,171,75, 1)']
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
                                        formatter: function(value, context) {
                                            return context.chart.data.datasets[0].data[context.dataIndex] >= 10 ? value : '';
                                        }
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'border',
                                        textMargin: 2
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
                                    },
                                    title: {
                                        display: true,
                                        text: 'TOTAL SELLO ESTUDIANTES PRIMER INGRESO: ' + suma,
                                        font: {
                                            size: 14,
                                            Style: 'bold',
                                        },
                                        position: 'bottom'
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

            var chartSelloAntiguos;

            function graficoSelloAntiguos() {
                var url, data;
                url = "{{ route('antiguos.estudiantes.programa',['tabla' => ' ']) }}" + tabla,
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
                        var labels = [];
                        var valores = [];
                        for (var propiedad in data) {
                            if (data.hasOwnProperty(propiedad)) {
                                labels.push(propiedad + ': ' + data[propiedad]);
                                valores.push(data[propiedad]);
                            }
                        }

                        var suma = valores.reduce(function(acumulador, valorActual) {
                            return acumulador + valorActual;
                        }, 0);

                        // Crear el gráfico circular
                        var ctx = document.getElementById('antiguos').getContext('2d');
                        chartSelloAntiguos = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    if (label == 'TOTAL') {
                                        return label + ': ' + suma;
                                    } else {
                                        return label;
                                    }
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(74, 72, 72, 0.5)', 'rgba(223, 193, 78, 1)', 'rgba(56,101,120,1)', 'rgba(208,171,75, 1)']
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
                                        formatter: function(value, context) {
                                            return context.chart.data.datasets[0].data[context.dataIndex] >= 10 ? value : '';
                                        }
                                    },
                                    labels: {
                                        render: 'percenteaje',
                                        size: '14',
                                        fontStyle: 'bolder',
                                        position: 'border',
                                        textMargin: 2
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
                                    },
                                    title: {
                                        display: true,
                                        text: 'TOTAL SELLO ESTUDIANTES ANTIGUOS: ' + suma,
                                        font: {
                                            size: 14,
                                            Style: 'bold',
                                        },
                                        position: 'bottom'
                                    }
                                },
                            },
                            plugins: [ChartDataLabels]
                        });
                        if (chartSelloAntiguos.data.labels.length == 0 && chartSelloAntiguos.data.datasets[0].data.length == 0) {
                            $('#colAntiguos').addClass('hidden');
                        } else {
                            $('#colAntiguos').removeClass('hidden');
                        }
                    }
                });

            }

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
            var chartOperadores;

            function graficoOperadores() {
                var data;
                var url = "{{ route('estudiantes.operador.programa',['tabla' => ' ']) }}" + tabla,
                    data = {
                        programa: programasSeleccionados,
                        periodos: periodosSeleccionados
                    };
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
                                        display: false,
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
             * Método que trae todos los operadores de la Facultad
             */
            var chartOperadoresTotal;

            function graficoOperadoresTotal() {
                var data;
                var url = "{{ route('operadores.programa.estudiantes',['tabla' => ' ']) }}" + tabla;
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

            var programaEstudiante;

            function dataTable() {
                $('#colTabla').removeClass('hidden');
                var url, data;
                var table;
                    url = "{{ route('planeacionProgramas.tabla.programa')}}",
                    data = {
                        periodos: periodosSeleccionados,
                        programas: programasSeleccionados
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
                                    title: 'Matrículas planeadas',
                                    className: 'dt-center'
                                },
                                {
                                    title: 'Con Sello Financiero',
                                    className: 'dt-center'
                                },
                                {
                                    title: 'ASP',
                                    className: 'dt-center'
                                },
                                {
                                    defaultContent: "<button type='button' id='btn-table' class='estudiantes btn btn-warning' data-toggle='modal' data-target='#modalEstudiantesPlaneados'><i class='fa-regular fa-circle-user'></i></button>",
                                    title: 'Estudiantes planeados',
                                    className: 'dt-center'
                                },
                                {
                                    defaultContent: "<button type='button' id='btn-table' class='buscar btn btn-warning' data-toggle='modal' data-target='#modalBuscarEstudiante'><i class='fa-solid fa-magnifying-glass'></i></button>",
                                    title: 'Buscar estudiante',
                                    className: 'dt-center'
                                },
                                {
                                    defaultContent: "<button type='button' id='btn-table' class='malla btn btn-warning' data-toggle='modal' data-target='#modalMallaCurricular'><i class='fa-solid fa-bars'></i></button>",
                                    title: 'Malla Curricular',
                                    className: 'dt-center'
                                },
                            ]
                        });

                        function tablaMalla(tbody, table) {
                            $(tbody).on("click", "button.malla", function() {
                                var datos = table.row($(this).parents("tr")).data();
                                var programa = datos[0];
                                var nombrePrograma = datos[1];
                                mallaPrograma(programa, nombrePrograma);
                            })
                        }

                        function tablaEstudiantes(tbody, table) {
                            $(tbody).on("click", "button.estudiantes", function() {
                                var datos = table.row($(this).parents("tr")).data();
                                var programa = datos[0];
                                var nombrePrograma = datos[1];
                                estudiantesPlaneados(programa, nombrePrograma);
                            })
                        }

                        function buscarEstudiante(tbody, table) {
                            $(tbody).on("click", "button.buscar", function() {
                                limpiarModalBuscador();
                                $("#idBanner").val("");
                                var datos = table.row($(this).parents("tr")).data();
                                programaEstudiante = datos[0];
                                $('#dataEstudiante').addClass('hidden');
                                $('#tituloTablaBuscar').addClass('hidden');
                            })
                        }
                        buscarEstudiante("#datatable tbody", table);
                        tablaMalla("#datatable tbody", table);
                        tablaEstudiantes("#datatable tbody", table);
                    }

                });
            }

            function mallaPrograma(programa, nombrePrograma) {
                limpiarModalMalla();
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
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null
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
                                    title: 'Matrículas planeadas',
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
                                    title: 'Cantidad de cursos',
                                    render: function(data, type, row) {
                                        if (type === 'display') {
                                            var conSello = parseFloat(row[3]);
                                            var curso = (conSello / 85).toFixed(2);
                                            return curso;
                                        }
                                        return data;
                                    },
                                    visible: false
                                },
                                {
                                    title: 'tutor 1',
                                    visible: false
                                },
                                {
                                    title: 'correo tutor 1',
                                    visible: false
                                },
                                {
                                    title: 'tutor 2',
                                    visible: false
                                },
                                {
                                    title: 'correo tutor 2',
                                    visible: false
                                },
                                {
                                    title: 'tutor 3',
                                    visible: false
                                },
                                {
                                    title: 'correo tutor 3',
                                    visible: false
                                },
                            ],
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            },
                        });
                    }
                });
            }

            function estudiantesPlaneados(programa, nombrePrograma) {
                limpiarModalEstudiantes();
                $('#tituloEstudiantes').empty();
                $('#estudiantesPlaneados').empty();
                $('#tituloEstudiantes').append('Estudiantes planeados ' + nombrePrograma + ' - ' + programa);
                var mensaje = 'Cargando, por favor espere...';

                $('#estudiantesPlaneados').append(mensaje);
                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('estudiantesMateria.tabla') }}",
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
                        $('#estudiantesPlaneados').empty();
                        tabla = $('#estudiantesPlaneados').DataTable({
                            "dom": 'Bfrtip',
                            "data": data,
                            "buttons": [
                                'copy', 'excel', 'pdf', 'print'
                            ],
                            "columns": [{
                                    title: 'Codigo Banner',
                                    data: 'codBanner'
                                },
                                {
                                    title: 'Codigo Materia',
                                    data: 'codMateria'
                                },
                                {
                                    title: 'Materia',
                                    data: 'curso'
                                }
                            ],
                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            },
                        });
                    }
                });
            }

            function limpiarModalMalla() {
                if ($.fn.DataTable.isDataTable('#mallaCurricular')) {
                    $("#mallaCurricular").remove();
                    table.destroy();
                    $('#mallaCurricular').DataTable().destroy();
                    $('#mallaCurricular thead').empty();
                    $('#mallaCurricular tbody').empty();
                    $('#mallaCurricular tfooter').empty();
                }
            }

            function limpiarModalEstudiantes() {
                if ($.fn.DataTable.isDataTable('#estudiantesPlaneados')) {
                    $("#estudiantesPlaneados").remove();
                    tabla.destroy();
                    $('#estudiantesPlaneados').DataTable().destroy();
                    $('#estudiantesPlaneados thead').empty();
                    $('#estudiantesPlaneados tbody').empty();
                    $('#estudiantesPlaneados tfooter').empty();
                }
            }

            function limpiarModalBuscador() {
                if ($.fn.DataTable.isDataTable('#buscarEstudiante')) {
                    $("#buscarEstudiante").remove();
                    estudiante.destroy();
                    $('#buscarEstudiante').DataTable().destroy();
                    $('#buscarEstudiante thead').empty();
                    $('#buscarEstudiante tbody').empty();
                    $('#buscarEstudiante tfooter').empty();
                }
            }

            function destruirTable() {
                $('#colTabla').addClass('hidden');
                if ($.fn.DataTable.isDataTable('#datatable')) {
                    $('#datatable').dataTable().fnDestroy();
                    $('#datatable thead').empty();
                    $('#datatable tbody').empty();
                    $('#datatable tfooter').empty();
                    $("#datatable tbody").off("click", "button.malla");
                    $("#datatable tbody").off("click", "button.estudiantes");
                    $("#datatable tbody").off("click", "button.buscar");
                }
            }

            $("#formBuscar").submit(function(e) {
                limpiarModalBuscador();
                e.preventDefault();
                console.log(programaEstudiante);
                var id = $("#idBanner").val();
                var url, data;
                data = {
                    id: id,
                    programa: programaEstudiante
                };
                url = "{{ route('materias.estudiante') }}";
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
                        if (data.length === 0) {
                            $('#divTablaBuscador').append('<h5 class="text-center">No hay datos por mostrar</h5>');
                        } else {

                            ['#primerApellido', '#Sello', '#Operador', '#tipEstudiante'].forEach(selector => {
                                $(selector).empty();
                            });
                            $('#dataEstudiante').removeClass('hidden');
                            $('#tituloTablaBuscar').removeClass('hidden');
                            $('#primerApellido').append('Primer Apellido: ' + data.estudiante.primer_apellido);
                            $('#Sello').append('Sello financiero: ' + data.estudiante.sello);
                            $('#Operador').append('Operador: ' + data.estudiante.operador);
                            $('#tipEstudiante').append('Tipo estudiante: ' + data.estudiante.tipoestudiante);

                            console.log(data);
                            estudiante = $('#buscarEstudiante').DataTable({
                                "data": data.materias,
                                'pageLength': 10,
                                "columns": [{
                                        title: 'Código de materia',
                                        data: 'codMateria'
                                    },
                                    {
                                        title: 'Nombre materia',
                                        data: 'curso'
                                    },
                                    {
                                        title: 'Semestre',
                                        data: 'semestre',
                                        className: 'dt-center'
                                    },
                                ]
                            });
                        }
                    }
                });
            });

        });
    </script>

    <!-- incluimos el footer -->
    @include('layout.footer')
</div>