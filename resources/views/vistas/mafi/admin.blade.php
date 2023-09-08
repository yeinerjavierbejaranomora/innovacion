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

    #botonModalTiposEstudiantes,
    #botonModalProgramas,
    #botonModalOperador,
    #botonModalMetas {
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

    .fondocards{
        color: white;
        background-color: #3A6577;
    }

    .fondocharts{
        background-color: #DFE0E2;
    }

    .inputTodos:checked {
    background-color: #dfc14e;
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
                <div class="input-group-append text-gray-800 text-center">
                    <h3><strong> Bienvenido {{auth()->user()->nombre}}! - Informe de Admisiones (Argos) </strong></h3>
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

        </div>

        <div class="row justify-content-start mt-5 columnas">
            <div class="col-6 text-center" id="colEstudiantes">
                <div class="card shadow mb-5 graficos" id="chartEstudiantes">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8 d-flex align-items-center justify-content-center">
                                <h5 id="tituloEstudiantes"><strong>Total estudiantes Argos</strong></h5>
                                <h5 class="tituloPeriodo"><strong></strong></h5>
                            </div>
                            <div class="col-2 text-right">
                                <span data-toggle="tooltip" title="Este gráfico muestra el total de los estudiantes y los clásifica en activos e inactivos. Adicionalmente cuenta con la opción 'Descargar datos Banner' la cual genera un Excel con los datos de Banner." data-placement="right">
                                    <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body center-chart fondocharts">
                        <canvas id="estudiantes"></canvas>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn botonMafi" id="descargarMafi">Descargar datos Banner</a>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center" id="colSelloFinanciero">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8 d-flex align-items-center justify-content-center">
                                <h5 id="tituloEstadoFinanciero"><strong>Estado Financiero</strong></h5>
                                <h5 class="tituloPeriodo"><strong></strong></h5>
                            </div>
                            <div class="col-2 text-right">
                                <span data-toggle="tooltip" title="Aquí se muestra un resumen del estado financiero (con sello, con retención o ASP) de los estudiantes activos." data-placement="right">
                                    <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body center-chart fondocharts">
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
                                <span data-toggle="tooltip" title="Aquí se muestra un resumen del estado en plataforma de los estudiantes activos que su estado financiero se encuentra en retención." data-placement="right">
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
            <div class=" col-6 text-center " id="colPrimerIngreso">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8 d-flex align-items-center justify-content-center">
                                <h5 id="tituloEstudiantesNuevos"><strong>Estudiantes nuevos - Estado Financiero</strong></h5>
                                <h5 class="tituloPeriodo"><strong></strong></h5>
                            </div>
                            <div class="col-2 text-right">
                                <span data-toggle="tooltip" title="En este gráfico se puede visualizar el Estado financiero de todos los estudiantes activos de primer ingreso y transferentes." data-placement="right">
                                    <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body center-chart fondocharts">
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
            <div class="col-6 text-center " id="colProgramas">
                <div class="card shadow mb-4 graficosBarra" id="ocultarGraficoProgramas">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8 d-flex align-items-center justify-content-center">
                                <h5 id="tituloProgramas"><strong>Programas con mayor cantidad de admitidos Activos</strong></h5>
                                <h5 class="tituloPeriodo"><strong></strong></h5>
                            </div>
                            <div class="col-2 text-right">
                                <span data-toggle="tooltip" title="Muestra la cantidad de estudiantes inscritos en cada programa, cuenta con la opción de 'Ver más'." data-placement="right">
                                    <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body fondocharts">
                        <canvas id="estudiantesProgramas"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalProgramas" class="btn botonModal" data-toggle="modal" data-target="#modalProgramasTotal"> Ver más </a>
                    </div>
                </div>
            </div>

            <div class="col-6 text-center" id="colMetas">
                <div class="card shadow mb-4 graficosBarra">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8 d-flex align-items-center justify-content-center">
                                <h5 id="tituloMetas"><strong>Metas periodo activo por programa</strong></h5>
                                <h5 class="tituloPeriodo"><strong></strong></h5>
                            </div>
                            <div class="col-2 text-right">
                                <span data-toggle="tooltip" title="Muestra la cantidad de estudiantes inscritos por programa con sello financiero y de primer ingreso VS la meta fijada, además permite descargar un Excel en donde se puede visualizar el porcentaje de cumplimiento de la meta." data-placement="right">
                                    <button type="button" class="btn" style="background-color: #dfc14e;border-color: #dfc14e;; color:white;" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body fondocharts">
                        <canvas id="graficoMetas"></canvas>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="" id="botonModalMetas" class="btn botonModal" data-toggle="modal" data-target="#modalMetas"> Ver más </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Todos los Operadores de la Ibero -->
        <div class="modal fade" id="modalOperadoresTotal" tabindex="-1" role="dialog" aria-labelledby="modalOperadoresTotal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="height:1000px;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="tituloOperadoresTotal"><strong>Estudiantes activos por operador</strong></h5>
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

        <!-- Modal Metas -->
        <div class="modal fade" id="modalMetas" tabindex="-1" role="dialog" aria-labelledby="modalMetas" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document" style="height:1000px;">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title" id="tituloMetasTotal"><strong>Metas por programa (Primer ingreso y transferentes)</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <canvas id="metasTotal"></canvas>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" id="generarExcel">Descargar datos</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#menuAdmisiones').addClass('activo');

            var tabla = 'Mafi';

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

            var programasSeleccionados = [];
            var facultadesSeleccionadas = [];
            var periodosSeleccionados = [];
            periodos();
            llamadoFunciones();
            facultades();
            programas();


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
             * Llamado a todos los scripts
             */
            function llamadoFunciones() {
                graficoEstudiantes();
                graficoSelloFinanciero();
                graficoRetencion();
                graficoSelloPrimerIngreso();
                graficoSelloAntiguos();
                graficoTipoDeEstudiante();
                graficoOperadores();
                graficoProgramas();
                graficoMetas();
            }

            function limpiarTitulos() {
                var elementosTitulos = $('#tituloEstudiantes, #tituloEstadoFinanciero, #tituloRetencion, #tituloEstudiantesNuevos, #tituloTipos, #tituloOperadores, #tituloProgramas, #tituloOperadoresTotal, #tituloTiposTotal, #tituloProgramasTotal').find("strong");
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

            function getPeriodos() {
                var periodosSeleccionados = [];
                var checkboxesSeleccionados = $('#Continua, #Pregrado, #Esp, #Maestria').find('input[type="checkbox"]:checked');
                checkboxesSeleccionados.each(function() {
                    periodosSeleccionados.push($(this).val());
                });
                return periodosSeleccionados;
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
                [chartEstudiantes, chartProgramas, chartEstudiantesActivos, chartRetencion, chartSelloPrimerIngreso, chartSelloAntiguos, chartTipoEstudiante, chartOperadores, chartMetas].forEach(chart => chart.destroy());
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

            $('#descargarMafi').on('click', function(e) {
                Swal.fire({
                    title: 'Descargar datos',
                    text: "La datos generados se actualizan una vez al día, para obtener la información completamente actualizada dirigete directamente a Banner",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Descargar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Descargando',
                            icon: 'success'
                        })
                        ExcelBanner();
                    }
                })
            });

            function ExcelBanner(){
                console.log(programasSeleccionados);
                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    console.log('entra');
                    url = "{{ route('data.Mafi.programa') }}",
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('data.Mafi.facultad') }}",
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('data.Mafi') }}",
                            data = ''
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
                        console.log(data);

                        var newData = [];
                        newData.push(headers);
                        data.forEach(function(item) {
                            var fila = [
                                item.idbanner,
                                item.primer_apellido,
                                item.programa,
                                item.codprograma,
                                item.cadena
                            ];
                            newData.push(fila);
                        });
                        var wb = XLSX.utils.book_new();
                        var ws = XLSX.utils.aoa_to_sheet(newData);
                        XLSX.utils.book_append_sheet(wb, ws, "Informe");
                        XLSX.writeFile(wb, "informe banner.xlsx");
                    }
                });
            }


            $('#generarReporte').on('click', function(e) {
                e.preventDefault();
                Contador();
                var periodosSeleccionados = getPeriodos();
                periodosSeleccionados.forEach(function(periodo, index, array) {
                    array[index] = '2023' + periodo;
                });
                console.log(periodosSeleccionados);
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
                        $("#colMetas").addClass("hidden");
                        destruirGraficos();
                        llamadoFunciones();
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
                            $("#colMetas").removeClass("hidden");
                            estadoUsuarioFacultad();
                            destruirGraficos();
                            llamadoFunciones();
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

            });

            function estadoUsuarioPrograma() {
                limpiarTitulos();
                $("#mensaje").empty();

                var periodosArray = Object.values(periodosSeleccionados);
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
                $("#mensaje").empty();
                var facultadesArray = Object.values(facultadesSeleccionadas);
                var facultadesFormateadas = facultadesArray.map(function(facultad) {
                    return facultad.toLowerCase().replace(/facultad de |fac /gi, '').trim();
                }).join(' - ');

                var periodosArray = Object.values(periodosSeleccionados);
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
                                    $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label><br>`);
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

            /**
             * Método que muestra el total de estudiantes activos e inactivos
             */
            var chartEstudiantes;

            function graficoEstudiantes() {
                var url, data;
                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    url = "{{ route('estudiantes.activos.programa') }}",
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('estudiantes.activos.facultad') }}",
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('estudiantes.activos') }}",
                            data = ''
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
                            return elemento.estado;
                        });

                        var valores = data.data.map(function(elemento) {
                            return elemento.TOTAL;
                        });
                        var suma = valores.reduce(function(acumulador, valorActual) {
                            return acumulador + valorActual;
                        }, 0);
                        // Crear el gráfico circular
                        var ctx = document.getElementById('estudiantes').getContext('2d');
                        chartEstudiantes = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels.map(function(label, index) {
                                    label = label.toUpperCase();
                                    if (label != 'TOTAL') {
                                        return label + 'S: ' + valores[index];
                                    } else {
                                        return label + ': ' + suma;
                                    }
                                }),
                                datasets: [{
                                    label: 'Gráfico Circular',
                                    data: valores,
                                    backgroundColor: ['rgba(223, 193, 78, 1)', 'rgba(74, 72, 72, 0.5)']
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
                                        position: 'border',
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
                                    },
                                    title: {
                                    display: true,
                                    text: 'TOTAL ESTUDIANTES: ' + suma,
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
                        if (chartEstudiantes.data.labels.length == 0 && chartEstudiantes.data.datasets[0].data.length == 0) {
                            $('#colEstudiantes').addClass('hidden');
                        } else {
                            $('#colEstudiantes').removeClass('hidden');
                        }
                    }
                });
            }

            /**
             * Método que genera el gráfico de sello financiero
             */
            var chartEstudiantesActivos;

            function graficoSelloFinanciero() {
                var url, data;
                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    url = "{{ route('estudiantes.sello.programa',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('estudiantes.sello.facultad',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('sello.activos', ['tabla' => ' ']) }}" + tabla,
                            data = ''
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
             * Método que genera el gráfico de estudiantes con retención (ASP)
             */
            var chartRetencion;

            function graficoRetencion() {
                var url, data;

                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    url = "{{ route('estudiantes.retencion.programa',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('estudiantes.retencion.facultad',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('retencion.activos', ['tabla' => ' ']) }}" + tabla,
                            data = ''
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
             * Método que genera el gráfico de estudiantes de primer ingreso
             */
            var chartSelloPrimerIngreso;

            function graficoSelloPrimerIngreso() {
                var url, data;

                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    url = "{{ route('estudiantes.primerIngreso.programa',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('estudiantes.primerIngreso.facultad',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('sello.estudiantes', ['tabla' => ' ']) }}" + tabla,
                            data = ''
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

            var chartSelloAntiguos;

            function graficoSelloAntiguos() {
                var url, data;

                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    url = "{{ route('antiguos.estudiantes.programa',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('antiguos.estudiantes.facultad',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('antiguos.estudiantes', ['tabla' => ' ']) }}" + tabla,
                            data = ''
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

            /**
             * Método que genera el gráfico con todos los tipos de estudiantes
             */
            var chartTipoEstudiante;

            function graficoTipoDeEstudiante() {
                var url, data;
                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    url = "{{ route('estudiantes.tipo.programa',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('estudiantes.tipo.facultad',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('tipo.estudiantes', ['tabla' => ' ']) }}" + tabla,
                            data = ''
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
                                    if (label.includes("ESTUDIANTE ")) {
                                        label = label.replace(/ESTUDIANTE\S*/i, "");
                                    }
                                    return label;
                                }),
                                datasets: [{
                                    label: '',
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
                            plugins: [ChartDataLabels],
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
             * Método que genera el gráfico con los 5 operadores que mas estudiantes traen
             */
            var chartOperadores;

            function graficoOperadores() {
                var url, data;
                if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
                    url = "{{ route('estudiantes.operador.programa',['tabla' => ' ']) }}" + tabla,
                        data = {
                            programa: programasSeleccionados,
                            periodos: periodosSeleccionados
                        }
                } else {
                    if (facultadesSeleccionadas.length > 0) {
                        url = "{{ route('estudiantes.operador.facultad',['tabla' => ' ']) }}" + tabla,
                            data = {
                                idfacultad: facultadesSeleccionadas,
                                periodos: periodosSeleccionados
                            }
                    } else {
                        url = "{{ route('operadores.estudiantes', ['tabla' => ' ']) }}" + tabla,
                            data = ''
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

            /**
             * Método que genera el gráfico con los 5 programas que tienen mas estudiantes inscritos
             */

            var chartProgramas;

            function graficoProgramas() {
                if (facultadesSeleccionadas.length > 0) {
                    url = "{{ route('programas.estudiantes.facultad',['tabla' => ' ']) }}" + tabla,
                        data = {
                            idfacultad: facultadesSeleccionadas,
                            periodos: periodosSeleccionados
                        }
                } else {
                    url = "{{ route('programas.estudiantes', ['tabla' => ' ']) }}" + tabla,
                        data = ''
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
                                        display: false,
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

            $('#botonModalOperador').on("click", function(e) {
                e.preventDefault();
                if (chartOperadoresTotal) {
                    chartOperadoresTotal.destroy();
                }
                var periodos = getPeriodos();
                periodos.forEach(function(periodo, index, array) {
                    array[index] = '2023' + periodo;
                });
                graficoOperadoresTotal(periodos);
            });

            $('#botonModalProgramas').on("click", function(e) {
                e.preventDefault();
                if (chartProgramasTotal) {
                    chartProgramasTotal.destroy();
                }
                var periodos = getPeriodos();
                periodos.forEach(function(periodo, index, array) {
                    array[index] = '2023' + periodo;
                });
                graficoProgramasTotal(periodos);
            });

            $('#botonModalTiposEstudiantes').on("click", function(e) {
                e.preventDefault();
                if (chartTiposEstudiantesTotal) {
                    chartTiposEstudiantesTotal.destroy();
                }
                var periodos = getPeriodos();
                periodos.forEach(function(periodo, index, array) {
                    array[index] = '2023' + periodo;
                });
                tiposEstudiantesTotal(periodos);
            });

            $('#botonModalMetas').on("click", function(e) {
                e.preventDefault();
                if (chartMetasTotal) {
                    chartMetasTotal.destroy();
                }

                graficoMetasTotal();
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

            var chartMetasTotal;
            var chartMetas;

            function graficoMetas() {

                var url = "{{ route('metas.programa')}}";
                var data = '';

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

                        var labels = [];
                        var values = [];
                        var valuesSello = [];
                        var valuesRetencion = [];

                        Object.keys(data.metas).forEach(meta => {
                            labels.push(meta);
                            values.push(data.metas[meta]);
                            valuesSello.push(data.matriculaSello[meta]);
                            valuesRetencion.push(data.matriculaRetencion[meta]);
                        });

                        var ctx = document.getElementById('graficoMetas').getContext('2d');
                        chartMetas = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                        label: 'Sello',
                                        data: valuesSello,
                                        backgroundColor: ['rgba(223, 193, 78, 1)'],
                                        datalabels: {
                                            anchor: 'middle',
                                            align: 'center'
                                        },
                                        stack: 'Stack 0',
                                    },
                                    {
                                        label: 'Metas',
                                        data: values,
                                        backgroundColor: ['rgba(186,186,186,1)'],
                                        datalabels: {
                                            anchor: 'end',
                                            align: 'top',
                                        },
                                        stack: 'Stack 0',
                                    },
                                ]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        stacked: false,
                                    }
                                },
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
                        if (chartMetas.data.labels.length == 0 && chartMetas.data.datasets[0].data.length == 0) {
                            $('#colMetas').addClass('hidden');
                        } else {
                            $('#colMetas').removeClass('hidden');
                        }
                    }
                });
            }

            function graficoMetasFacultad(facultades) {

                var url = "{{ route('metasFacultad.programa')}}";

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: url,
                    data: {
                        idfacultad: facultades,
                    },
                    success: function(data) {
                        try {
                            data = jQuery.parseJSON(data);
                        } catch {
                            data = data;
                        }

                        var labels = [];
                        var values = [];
                        var valuesSello = [];
                        var valuesRetencion = [];

                        Object.keys(data.metas).forEach(meta => {
                            labels.push(meta);
                            values.push(data.metas[meta]);
                            valuesSello.push(data.matriculaSello[meta]);
                            valuesRetencion.push(data.matriculaRetencion[meta]);
                        });

                        var ctx = document.getElementById('graficoMetas').getContext('2d');
                        chartMetas = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                        label: 'Sello',
                                        data: valuesSello,
                                        backgroundColor: ['rgba(223, 193, 78, 1)'],
                                        datalabels: {
                                            anchor: 'middle',
                                            align: 'center'
                                        },
                                        stack: 'Stack 0',
                                    },
                                    {
                                        label: 'Metas',
                                        data: values,
                                        backgroundColor: ['rgba(186,186,186,1)'],
                                        datalabels: {
                                            anchor: 'end',
                                            align: 'top',
                                        },
                                        stack: 'Stack 0',
                                    },
                                ]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        stacked: false,
                                    }
                                },
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
                        if (chartMetas.data.labels.length == 0 && chartMetas.data.datasets[0].data.length == 0) {
                            $('#colMetas').addClass('hidden');
                        } else {
                            $('#colMetas').removeClass('hidden');
                        }
                    }
                });
            }

            function graficoMetasTotal() {

                var url, data;

                if (facultadesSeleccionadas.length > 0) {
                    url = "{{ route('metasTotalFacultad.programa')}}",
                        data = {
                            idfacultad: facultadesSeleccionadas,
                        }
                } else {
                    url = "{{ route('metasTotal.programa')}}";
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

                        try {
                            data = jQuery.parseJSON(data);
                        } catch {
                            data = data;
                        }
                        var labels = [];
                        var values = [];
                        var valuesSello = [];
                        var valuesRetencion = [];

                        Object.keys(data.metas).forEach(meta => {
                            labels.push(meta);
                            values.push(data.metas[meta]);
                            valuesSello.push(data.matriculaSello[meta]);
                            valuesRetencion.push(data.matriculaRetencion[meta]);
                        });

                        var ctx = document.getElementById('metasTotal').getContext('2d');
                        chartMetasTotal = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                        label: 'Sello',
                                        data: valuesSello,
                                        backgroundColor: ['rgba(223, 193, 78, 1)'],
                                        datalabels: {
                                            anchor: 'middle',
                                            align: 'center'
                                        },
                                        stack: 'Stack 0',
                                    },

                                    {
                                        label: 'Metas',
                                        data: values,
                                        backgroundColor: ['rgba(186,186,186,1)'],
                                        datalabels: {
                                            anchor: 'end',
                                            align: 'top',
                                        },
                                        stack: 'Stack 0',
                                    },
                                ]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        stacked: false,
                                    }
                                },
                                plugins: {
                                    formatter: function(value, context) {
                                        if (context.dataset.label == 'Retencion' && value == 0) {
                                            return '';
                                        }
                                    },
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

            $("#generarExcel").on("click", function() {
                if (facultadesSeleccionadas.length > 0) {
                    url = "{{ route('metasTotalFacultad.programa')}}",
                        data = {
                            idfacultad: facultadesSeleccionadas,
                        }
                } else {
                    url = "{{ route('metasTotal.programa')}}";
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
                        try {
                            data = jQuery.parseJSON(data);
                        } catch {
                            data = data;
                        }
                        var newData = [];
                        var headers = ["Codigo Programa", "Programa", "Meta", "Sello", "% Ejecución"];

                        var col1 = [];
                        var col2 = [];
                        var col3 = [];
                        var col4 = [];

                        Object.keys(data.metas).forEach(meta => {
                            col1.push(meta);
                            col2.push(data.nombres[meta]);
                            col3.push(data.metas[meta]);
                            col4.push(data.matriculaSello[meta]);
                        });

                        var porcentaje;
                        newData.push(headers);
                        for (var i = 0; i < col1.length; i++) {
                            porcentaje = (((col4[i]) / col3[i]) * 100).toFixed(2);
                            if (porcentaje > 100) {
                                porcentaje = 'Meta Superada';
                            }

                            var row = [col1[i], col2[i], col3[i], col4[i], porcentaje];
                            newData.push(row);
                        }
                        var wb = XLSX.utils.book_new();
                        var ws = XLSX.utils.aoa_to_sheet(newData);
                        XLSX.utils.book_append_sheet(wb, ws, "Metas");

                        // Generar el archivo Excel y descargarlo
                        XLSX.writeFile(wb, "Metas.xlsx");
                    }
                });
            });

        });
    </script>

    <!-- incluimos el footer -->
    @include('layout.footer')
</div>
