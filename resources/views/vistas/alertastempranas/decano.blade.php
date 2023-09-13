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

    .fondocards{
        color: white;
        background-color: #3A6577;
    }

    .fondocharts{
        background-color: #DFE0E2;
    }

</style>
<style>
    .checkbox-wrapper input[type="checkbox"] {
        display: none;
        visibility: hidden;
    }

    .checkbox-wrapper .cbx {
        margin: auto;
        -webkit-user-select: none;
        user-select: none;
        cursor: pointer;
    }

    .checkbox-wrapper .cbx span {
        display: inline-block;
        vertical-align: middle;
        transform: translate3d(0, 0, 0);
    }

    .checkbox-wrapper .cbx span:first-child {
        position: relative;
        width: 18px;
        height: 18px;
        border-radius: 3px;
        transform: scale(1);
        vertical-align: middle;
        border: 1px solid #f6c23e;
        background: #FFFFFF;
        transition: all 0.2s ease;
    }

    .checkbox-wrapper .cbx span:first-child svg {
        position: absolute;
        top: 3px;
        left: 2px;
        fill: none;
        stroke: #FFFFFF;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 16px;
        stroke-dashoffset: 16px;
        transition: all 0.3s ease;
        transition-delay: 0.1s;
        transform: translate3d(0, 0, 0);
    }

    .checkbox-wrapper .cbx span:first-child:before {
        content: "";
        width: 100%;
        height: 100%;
        background: #f6c23e;
        display: block;
        transform: scale(0);
        opacity: 1;
        border-radius: 50%;
    }

    .checkbox-wrapper .cbx span:last-child {
        padding-left: 8px;
    }

    .checkbox-wrapper .cbx:hover span:first-child {
        border-color: #f6c23e;
    }

    .checkbox-wrapper .inp-cbx:checked+.cbx span:first-child {
        background: #f6c23e;
        border-color: #f6c23e;
        animation: wave 0.4s ease;
    }

    .checkbox-wrapper .inp-cbx:checked+.cbx span:first-child svg {
        stroke-dashoffset: 0;
    }

    .checkbox-wrapper .inp-cbx:checked+.cbx span:first-child:before {
        transform: scale(3.5);
        opacity: 0;
        transition: all 0.6s ease;
    }

    @keyframes wave {
        50% {
            transform: scale(0.9);
        }
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
                <div class="input-group-append text-gray-800">
                    <h3><strong> Bienvenido {{auth()->user()->nombre}}! - Informe Proyección - Planeación </strong></h3>
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
                                                    {{-- <div class="custom-checkbox">
                                                        <label for="todosContinua" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos inputTodos" id="todosContinua" name="todosContinua" checked>
                                                    </div> --}}
                                                    <div class="checkbox-wrapper">
                                                        <label for="todosContinua" style="font-size:12px;">Selec. Todos</label>
                                                        <input class="inp-cbx" id="todosContinua" type="checkbox" checked>
                                                        <label class="cbx" for="todosContinua"><span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg></span><span style="display: none;">Selec. Todos</span>
                                                        </label>
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
                                                    {{-- <div class="custom-checkbox">
                                                        <label for="todosPregrado" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosPregrado" name="todosPregrado" checked>
                                                    </div> --}}
                                                    <div class="checkbox-wrapper">
                                                        <label for="todosPregrado" style="font-size:12px;">Selec. Todos</label>
                                                        <input class="inp-cbx" id="todosPregrado" type="checkbox" checked>
                                                        <label class="cbx" for="todosPregrado"><span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg></span><span style="display: none;">Selec. Todos</span>
                                                        </label>
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
                                                    {{-- <div class="custom-checkbox">
                                                        <label for="todosPrograma" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" id="todosPrograma" name="todosPrograma" checked>
                                                    </div> --}}
                                                    <div class="checkbox-wrapper">
                                                        <label for="todosPrograma" style="font-size:12px;">Selec. Todos</label>
                                                        <input class="inp-cbx" id="todosPrograma" type="checkbox" checked>
                                                        <label class="cbx" for="todosPrograma"><span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg></span><span style="display: none;">Selec. Todos</span>
                                                        </label>
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
                                <div class="row">
                                    <div class="col-4">
                                        <!--Especialización-->
                                        <div class="card">
                                            <div class="card-header fondocards" id="heading3" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link text-light">
                                                        Especialización
                                                    </button>
                                                    {{-- <div class="custom-checkbox">
                                                        <label for="todosEsp" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosEsp" name="todosEsp" checked>
                                                    </div> --}}
                                                    <div class="checkbox-wrapper">
                                                        <label for="todosEsp" style="font-size:12px;">Selec. Todos</label>
                                                        <input class="inp-cbx" id="todosEsp" type="checkbox" checked>
                                                        <label class="cbx" for="todosEsp"><span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg></span><span style="display: none;">Selec. Todos</span>
                                                        </label>
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
                                                    {{-- <div class="custom-checkbox">
                                                        <label for="todosMaestria" class="text-light" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" class="todos" id="todosMaestria" name="todosMaestria" checked>
                                                    </div> --}}
                                                    <div class="checkbox-wrapper">
                                                        <label for="todosMaestria" style="font-size:12px;">Selec. Todos</label>
                                                        <input class="inp-cbx" id="todosMaestria" type="checkbox" checked>
                                                        <label class="cbx" for="todosMaestria"><span>
                                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                </svg></span><span style="display: none;">Selec. Todos</span>
                                                        </label>
                                                    </div>
                                                </h5>
                                            </div>
                                            <div id="collapse4" class="collapse shadow" aria-labelledby="heading4" data-parent="#periodos">
                                                <div class="card-body periodos" style="width:100%;" id="Maestria"></div>
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

    </div>
<script>
    $('#menuAlertas').addClass('activo');

    $(document).ajaxStart(function() {
        $('div #programas input[type="checkbox"]').prop('disabled', true);
        $('#generarReporte').prop("disabled", true);
    });

    // Volver a habilitar los checkboxes cuando finaliza una solicitud AJAX
    $(document).ajaxStop(function() {
        $('div #programas input[type="checkbox"]').prop('disabled', false);
        $('#generarReporte').prop("disabled", false);
    });
    var programasSeleccionados = [];
    var facultadesSeleccionadas = [];
    var periodosSeleccionados = [];
    facultadesUsuario();
    periodos();
    programas();
    Contador();

    function facultadesUsuario() {
        periodosSeleccionados = getPeriodos();
        facultadesSeleccionadas = <?php echo json_encode($facultades); ?>;
    }

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
                        //$('#Continua').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                        $('#Continua').append(`<div class="checkbox-wrapper mb-1">
                            <input class="inp-cbx" id="cbx-${periodo.periodo}" type="checkbox" value="${periodo.periodo}" checked>
                            <label class="cbx" for="cbx-${periodo.periodo}"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span>${periodo.periodo}</span>
                            </label>
                        </div>`);
                    }
                    if (periodo.nivelFormacion == "PROFESIONAL") {
                        //$('#Pregrado').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                        $('#Pregrado').append(`<div class="checkbox-wrapper mb-1">
                            <input class="inp-cbx" id="cbx-${periodo.periodo}" type="checkbox" value="${periodo.periodo}" checked>
                            <label class="cbx" for="cbx-${periodo.periodo}"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span>${periodo.periodo}</span>
                            </label>
                        </div>`);
                    }
                    if (periodo.nivelFormacion == "ESPECIALISTA") {
                        //$('#Esp').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                        $('#Esp').append(`<div class="checkbox-wrapper mb-1">
                            <input class="inp-cbx" id="cbx-${periodo.periodo}" type="checkbox" value="${periodo.periodo}" checked>
                            <label class="cbx" for="cbx-${periodo.periodo}"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span>${periodo.periodo}</span>
                            </label>
                        </div>`);
                    }
                    if (periodo.nivelFormacion == "MAESTRIA") {
                        //$('#Maestria').append(`<label"> <input type="checkbox" value="${periodo.periodo}" checked> ${periodo.periodo}</label><br>`);
                        $('#Maestria').append(`<div class="checkbox-wrapper mb-1">
                            <input class="inp-cbx" id="cbx-${periodo.periodo}" type="checkbox" value="${periodo.periodo}" checked>
                            <label class="cbx" for="cbx-${periodo.periodo}"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span>${periodo.periodo}</span>
                            </label>
                        </div>`);
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
                        //$('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.codprograma}" checked> ${value.nombre}</label><br>`);
                        $('#programas').append(`<div class="checkbox-wrapper mb-1">
                            <input class="inp-cbx" id="cbx-${value.codprograma}" type="checkbox" name="programa[]" value="${value.codprograma}" checked>
                            <label class="cbx" for="cbx-${value.codprograma}"><span>
                                    <svg width="12px" height="10px" viewbox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg></span><span>${value.nombre}</span>
                            </label>
                        </div>`);
                    });
                }
            },
            error: function() {
                $('#programas').append('<h5>No hay programas</h5>')
            }
        })
    }

    function Contador() {
        totalProgramas = $('#programas input[type="checkbox"]').length;
        totalPeriodos = $('#programas input[type="checkbox"]').length;
    }

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

    // Grafico
    var chartAlertas;
    graficoAlertas();

    function graficoAlertas() {
        if (chartAlertas) { chartAlertas.destroy(); }
        var url, data;
        var periodosSeleccionados = getPeriodos();
        periodosSeleccionados.forEach(function(periodo, index, array) {
            array[index] = '2023' + periodo;
        });

            //console.log(facultadesSeleccionadas);

        if (programasSeleccionados.length > 0 && programasSeleccionados.length < totalProgramas) {
            url = "{{ route('alertas.grafico.programa') }}",
                data = {
                    programas: programasSeleccionados,
                    periodos: periodosSeleccionados
                }
        } else {

                url = "{{ route('alertas.grafico.facultad') }}",
                    data = {
                        facultad: facultadesSeleccionadas,
                        periodos: periodosSeleccionados
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
