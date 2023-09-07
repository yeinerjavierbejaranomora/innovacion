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

            <div class="row text-center justify-content-center">
                <button class="btn button-informe" type="button" id="generarReporte">
                    Generar Reporte
                </button>
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
            }
            , url: "{{ route('programas.activos') }}"
            , method: 'post'
            , async: false
            , success: function(data) {
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

    function programas(){
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

    function Contador() {
        totalFacultades = $('#facultades input[type="checkbox"]').length;
        totalProgramas = $('#programas input[type="checkbox"]').length;
        totalPeriodos = $('#programas input[type="checkbox"]').length;
    }

    /*$('#generarReporte').on('click', function(e) {
        e.preventDefault();
        Contador();
        var periodosSeleccionados = getPeriodos();
        periodosSeleccionados.forEach(function(periodo, index, array) {
            array[index] = '2023' + periodo;
        });
        if (periodosSeleccionados.length > 0) {
            console.log(totalProgramas);
            if ($('#programas input[type="checkbox"]:checked').length > 0 && $('#programas input[type="checkbox"]:checked').length < totalProgramas) {
                var checkboxesProgramas = $('#programas input[type="checkbox"]:checked');
                programasSeleccionados = [];
                checkboxesProgramas.each(function() {
                    programasSeleccionados.push($(this).val());
                });
                console.log(programasSeleccionados);
            }else{
                if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                    var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                    programasSeleccionados = [];
                    facultadesSeleccionadas = [];
                    checkboxesSeleccionados.each(function() {
                        facultadesSeleccionadas.push($(this).val());
                    });
                    console.log(facultadesSeleccionadas);
                }else{
                    programasSeleccionados = [];
                    facultadesSeleccionadas = [];
                }
            }
        }else{
            programasSeleccionados = [];
            facultadesSeleccionadas = [];
            periodosSeleccionados = [];
        }
    });*/

    $('#generarReporte').on("click", function(e) {
        e.preventDefault();
        destruirTable();
        var periodos = getPeriodos();
        dataTable(periodos);
    });

    function dataTable(periodos) {
        $('#colTabla').removeClass('hidden');
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
</script>


@include('layout.footer')

