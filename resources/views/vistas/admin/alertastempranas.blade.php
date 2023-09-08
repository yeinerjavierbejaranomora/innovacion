<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
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
        min-height: 400px;
        max-height: 400px;
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
    #programasTotal,
    #metasTotal {
        height: 600px !important;
    }

    #seccion {
        background: #FFFFFF;
    }

    .center-chart {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
<!--  creamos el contenido principal body -->

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
                    <h3> Bienvenido {{ auth()->user()->nombre }}</h3>
                </div>
            </div>


        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                {{-- <h1 class="h3 mb-0 text-gray-800">Malla curricular del programa {{$nombre}}</h1> --}}
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->

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
                                            <div id="collapse2" class="collapse shadow" aria-labelledby="heading2" data-parent="#periodos">
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
                                            <div class="card-body text-start collapse shadow" id="acordionFacultades" aria-labelledby="HeadingFacultades">
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

            <div class="row text-center justify-content-center mb-2">
                <button class="btn button-informe" type="button" id="generarReporte">
                    Generar Reporte
                </button>
            </div>
            <div class="row d-flex align-items-center mt-3">
                <div class="col text-center" id="colAlertas">
                    <div class="card shadow mb-4" style="min-height: 450px; max-height: 450px;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8 d-flex align-items-center justify-content-center">
                                    <h5 id="tituloAlertas"><strong>Alertas por programa</strong></h5>
                                    <h5 class="tituloPeriodo"><strong></strong></h5>
                                </div>
                                <div class="col-2 text-right">
                                    <span data-toggle="tooltip" title="Muestra la cantidad de alertas activas por programa" data-placement="right">
                                        <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom"><i class="fa-solid fa-circle-question"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="graficoAlertas"></canvas>
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
        <!-- /.container-fluid -->

    </div>

</div>
<!-- End of Content Wrapper -->

</div>

<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script>

    $('#menuAlertas').addClass('activo');

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
    facultades();
    programas();

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
                        $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label><br>`);
                    });
                }
            },
            error: function() {
                $('#programas').append('<h5>No hay programas</h5>')
            }
        })
    }

    $('#deshacerProgramas').on('click', function(e) {
        $('#programas input[type="checkbox"]').prop('checked', false);
    });

    $('#seleccionarProgramas').on('click', function(e) {
        $('#programas input[type="checkbox"]').prop('checked', true);
    });

    $('#deshacerPeriodos').on('click', function(e) {
        $('.periodos input[type="checkbox"]').prop('checked', false);
        $('.todos').prop('checked', false);
    });

    $('#seleccionarPeriodos').on('click', function(e) {
        $('.periodos input[type="checkbox"]').prop('checked', true);
        $('.todos').prop('checked', true);
    });

    $('#deshacerFacultades').on('click', function(e) {
        $('#facultades input[type="checkbox"]').prop('checked', false);
    });

    $('#seleccionarFacultades').on('click', function(e) {
        $('#facultades input[type="checkbox"]').prop('checked', true);
    });

    function getPeriodos() {
        var periodosSeleccionados = [];
        var checkboxesSeleccionados = $('#Continua, #Pregrado, #Esp, #Maestria').find('input[type="checkbox"]:checked');
        checkboxesSeleccionados.each(function() {
            periodosSeleccionados.push($(this).val());
        });
        return periodosSeleccionados;
    }

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

    function Contador() {
        totalFacultades = $('#facultades input[type="checkbox"]').length;
        totalProgramas = $('#programas input[type="checkbox"]').length;
        totalPeriodos = $('#programas input[type="checkbox"]').length;
    }

    $('#generarReporte').on('click', function(e) {
        e.preventDefault();
        Contador();
        var periodosSeleccionados = getPeriodos();
        periodosSeleccionados.forEach(function(periodo, index, array) {
            array[index] = '2023' + periodo;
        });
        if (periodosSeleccionados.length > 0) {
            if ($('#programas input[type="checkbox"]:checked').length > 0 && $('#programas input[type="checkbox"]:checked').length < totalProgramas) {
                var checkboxesProgramas = $('#programas input[type="checkbox"]:checked');
                programasSeleccionados = [];
                checkboxesProgramas.each(function() {
                    programasSeleccionados.push($(this).val());
                });
                graficoAlertas();
            } else {
                if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                    var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                    programasSeleccionados = [];
                    facultadesSeleccionadas = [];
                    checkboxesSeleccionados.each(function() {
                        facultadesSeleccionadas.push($(this).val());
                    });
                    graficoAlertas();
                } else {
                    programasSeleccionados = [];
                    facultadesSeleccionadas = [];
                }
            }
            destruirTable();
            Contador();
            var periodosSeleccionados = getPeriodos();
            periodosSeleccionados.forEach(function(periodo, index, array) {
                array[index] = '2023' + periodo;
            });
            //var periodos = getPeriodos();
            dataTable(periodosSeleccionados);
        } else {
            programasSeleccionados = [];
            facultadesSeleccionadas = [];
            periodosSeleccionados = [];
        }
    });


    function dataTable(periodosSeleccionados) {
        $('#colTabla').removeClass('hidden');
        var url, data;
        var table;
        if (programasSeleccionados.length > 0) {
            url = "{{ route('alertas.tabla.programa')}}",
                data = {
                    periodos: periodosSeleccionados,
                    programas: programasSeleccionados
                }
            /*var formData = new FormData();
            formData.append('periodos', periodos);
            formData.append('programas', programasSeleccionados);*/
        } else {
            if (facultadesSeleccionadas.length > 0) {
                url = "{{ route('alertas.tabla.facultad')}}",
                    data = {
                        periodos: periodosSeleccionados,
                        facultad: facultadesSeleccionadas
                    }
            } else {
                url = "{{ route('alertas.tabla')}}",
                    data = {
                        periodos: periodosSeleccionados
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

                table = $('#datatable').DataTable({
                    "data": data,
                    'pageLength': 10,
                    "order": [2, 'desc'],
                    "columns": [{
                            title: 'Codigo Banner',
                            data: 'idbanner',
                        },
                        /*{
                            title: 'Código de programa',
                            data: 'codprograma',
                        },*/
                        {
                            title: 'Programa',
                            render: function(data, type, row) {
                                // esto es lo que se va a renderizar como html
                                return `<b>${row.codprograma}</b> - ${row.programa}`;
                            }
                        },
                        {
                            title: 'Tipo estudiante',
                            data: 'tipo_estudiante',
                        },
                        {
                            title: 'Periodo',
                            data: 'periodo',
                            className: 'dt-center'
                        },
                        {
                            title: 'Tipo alerta',
                            data: 'tipo',
                        },
                        {
                            title: 'Descripción',
                            data: 'desccripcion',
                        },
                        {
                            title: 'Activo',
                            data: 'activo',
                        },
                        {
                            title: 'Fecha creación',
                            data: 'created_at',
                        },
                        /*{
                            defaultContent: "<button type='button' id='btn-table' class='estudiantes btn btn-warning' data-toggle='modal' data-target='#modalEstudiantesPlaneados'><i class='fa-regular fa-circle-user'></i></button>",
                            title: 'Estudiantes planeados',
                            className: 'dt-center'
                        },

                        {
                            defaultContent: "<button type='button' id='btn-table' class='malla btn btn-warning' data-toggle='modal' data-target='#modalMallaCurricular'><i class='fa-solid fa-bars'></i></button>",
                            title: 'Malla Curricular',
                            className: 'dt-center'
                        },*/
                    ]
                });

                /*function tablaMalla(tbody, table) {
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

                tablaMalla("#datatable tbody", table);
                tablaEstudiantes("#datatable tbody", table);*/
            }

        });
    }

    function destruirTable() {
        $('#colTabla').addClass('hidden');
        if ($.fn.DataTable.isDataTable('#datatable')) {
            $('#datatable').dataTable().fnDestroy();
            $('#datatable tbody').empty();
            $("#datatable tbody").off("click", "button.malla");
            $("#datatable tbody").off("click", "button.estudiantes");
        }
    }


    var chartAlertas;

    graficoAlertas();

    function graficoAlertas() {
        if (chartAlertas) { chartAlertas.destroy(); }
    var url, data;
    var periodosSeleccionados = getPeriodos();
    periodosSeleccionados.forEach(function(periodo, index, array) {
        array[index] = '2023' + periodo;
    });

    if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
        url = "{{ route('alertas.grafico.programa') }}",
            data = {
                programas: programasSeleccionados,
                periodos: periodosSeleccionados
            }
    } else {
        if (facultadesSeleccionadas.length > 0) {
            url = "{{ route('alertas.grafico.facultad') }}",
                data = {
                    facultad: facultadesSeleccionadas,
                    periodos: periodosSeleccionados
                }
        } else {
            url = "{{ route('alertas.grafico') }}",
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
            var labels = data.map(function(elemento) {
                return elemento.codprograma;
            });
            var valores = data.map(function(elemento) {
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
            var ctx = document.getElementById('graficoAlertas').getContext('2d');
            chartAlertas = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
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
            if (chartAlertas.data.labels.length == 0 && chartAlertas.data.datasets[0].data.length == 0) {
                $('#colAlertas').addClass('hidden');
            } else {
                $('#colAlertas').removeClass('hidden');
            }
        }
    });
    }
</script>


@include('layout.footer')
