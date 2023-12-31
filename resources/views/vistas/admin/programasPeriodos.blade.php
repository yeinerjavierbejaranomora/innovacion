<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<style>
    .card {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .card-body {
        flex: 1;
        width: 100%;
    }

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


    #cardFacultades {
        min-height: 350px;
        max-height: 350px;
    }

    #cardNivel {
        background: #FFFFFF;
    }

    .card {
        margin-bottom: 3%;
    }

    .hidden {
        display: none;
    }


    .graficosRiesgo {
        min-height: 450px;
        max-height: 450px;
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
                <div>
                    <input type="text" id="facultadEditar" value='' name="facultadEditar" hidden>
                </div>
            </div>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Programas activos por periodo</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->

            <div class="row justify-content-around mt-3 mb-3 columnas">
                <!--Columna Niveles de Formación-->
                <div class="col-8 text-start">
                    <div class="card-body" id="cardNivel" style="overflow: auto;">
                        <div class="text-center">
                            <h5 id="tituloNiveldes"><strong>Periodos Activos</strong></h5>
                        </div>
                        <div>
                            <!--Accordion-->
                            <div id="accordion">
                                <div class="row">
                                    <div class="col-6">
                                        <!--Formación continua-->
                                        <div class="card">
                                            <div class="card-header" id="heading2" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        Formación continua
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosContinua" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" id="todosContinua" name="todosContinua" checked>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion">
                                                <div class="card-body" style="width:100%;" id="Continua">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <!--Pregrado-->
                                        <div class="card">
                                            <div class="card-header" id="heading1" style="width:100%;cursor:pointer;" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        Pregrado
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosPregrado" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" id="todosPregrado" name="todosPregrado" checked>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapse1" class="collapse shadow" aria-labelledby="heading1" data-parent="#accordion">
                                                <div class="card-body" style="width:100%;" id="Pregrado">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <!--Especialización-->
                                        <div class="card">
                                            <div class="card-header" id="heading3" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        Especialización
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosEsp" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" id="todosEsp" name="todosEsp" checked>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapse3" class="collapse shadow" aria-labelledby="heading3" data-parent="#accordion">
                                                <div class="card-body" style="width:100%;" id="Esp">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <!--Maestría-->
                                        <div class="card">
                                            <div class="card-header" id="heading4" style="width:100%; cursor:pointer;" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                                    <button class="btn btn-link">
                                                        Maestría
                                                    </button>
                                                    <div class="custom-checkbox">
                                                        <label for="todosMaestria" class="text-muted" style="font-size:12px;"> Selec. Todos</label>
                                                        <input type="checkbox" id="todosMaestria" name="todosMaestria" checked>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapse4" class="collapse shadow" aria-labelledby="heading4" data-parent="#accordion">
                                                <div class="card-body" style="width:100%;" id="Maestria">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" id="deshacerPeriodos" class="btn deshacer">Deshacer Todos</button>
                            <button type="button" id="seleccionarPeriodos" class="btn deshacer">Seleccionar Todos</button>
                        </div>
                    </div>
                </div>
                <!--Columna Facultades-->
                <div class="col-4 text-star">
                    <div class="card shadow mb-5" id="cardFacultades">
                        <div class="card-header text-center">
                            <h5><strong>Seleccionar Facultades</strong></h5>
                        </div>
                        <div class="card-body text-start" id="centrar" style="overflow: auto;">
                            <div class="facultades" name="facultades" id="facultades">
                            </div>
                        </div>
                        <div class="card-footer text-center" style="height: 55px;">
                            <button type="button" id="deshacerFacultades" class="btn deshacer">Deshacer Todas</button>
                            <button type="button" id="seleccionarFacultades" class="btn deshacer">Seleccionar Todas</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row text-center justify-content-center mt-3 mb-4">
                <button class="btn button-informe" type="button" id="generarReporte">
                    Generar Reporte
                </button>
            </div>

            <div class="row mt-3">
                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12 hidden" id="colTabla">
                    <div class="card shadow mb-4">

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="text-center">
                                <h4 id="tituloTabla">Informe General</h4>
                                <h4 id="tituloPeriodo"><strong></strong></h4>
                            </div>
                            <div class="table">
                                <table id="datatable" class="display" style="width:100%">
                                </table>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>



            <!--Modal para agregar un programa nuevo-->
            <div class="modal fade" id="nuevoprograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo programa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="miForm" method="post" action="{{ route('programa.crear') }}">
                                @csrf
                                <div>
                                    <label for="recipient-name" class="col-form-label">Codigo del programa</label>
                                    <input type="text" class="form-control" id="codPrograma" name="codPrograma">
                                </div>
                                <div>
                                    <label for="message-text" class="col-form-label">Nombre del programa</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div>
                                    <label for="message-text" class="col-form-label">Facultad a la que pertenece</label>
                                    <select class="form-control" name="codFacultad" id="codFacultad"></select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="crear btn btn-success">Crear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @if(session('success'))
    <script>
        Swal.fire("Éxito", "{{ session('success') }}", "success");
    </script>
    @endif

    @if($errors->any())
    <script>
        Swal.fire("Error", "{{ $errors->first() }}", "error");
    </script>
    @endif

    <script>
        $(document).ready(function() {


            var periodosSeleccionados = [];
            var facultadesSeleccionadas = [];
            programasActivos();
            facultades();
            dataTable();

            $('#heading2').on('click', function() {
                $(this).find('[data-toggle="collapse"]').click();
            });

            function programasActivos() {
                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('programas.activos') }}",
                    method: 'post',
                    async: false,
                    success: function(data) {
                        console.log(data);
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

            function getPeriodos() {
                periodosSeleccionados = [];
                var checkboxesSeleccionados = $('#Continua, #Pregrado, #Esp, #Maestria').find('input[type="checkbox"]:checked');
                checkboxesSeleccionados.each(function() {
                    periodosSeleccionados.push($(this).val());
                });
                return periodosSeleccionados;
            }

            function getFacultades() {
                facultadesSeleccionadas = [];
                var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                checkboxesSeleccionados.each(function() {
                    facultadesSeleccionadas.push($(this).val());
                });
                return facultadesSeleccionadas;
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

            $('#deshacerPeriodos').on('click', function(e) {
                $('#accordion input[type="checkbox"]').prop('checked', false);
            });

            $('#seleccionarPeriodos').on('click', function(e) {
                $('#accordion input[type="checkbox"]').prop('checked', true);
            });

            $('#deshacerFacultades').on('click', function(e) {
                $('#facultades input[type="checkbox"]').prop('checked', false);
            });

            $('#seleccionarFacultades').on('click', function(e) {
                $('#facultades input[type="checkbox"]').prop('checked', true);
            });

            $('#generarReporte').on('click', function(e) {
                getPeriodos();
                getFacultades();

                if (periodosSeleccionados.length > 0) {
                    if (facultadesSeleccionadas.length > 0) {
                        dataTable();
                        estadoUsuarioFacultad();
                    } else {
                        alertaFacultad();
                        destruirTabla();

                    }
                } else {
                    alertaPeriodos();
                    destruirTabla();
                }
            });

            function destruirTabla() {
                if ($.fn.DataTable.isDataTable('#datatable')) {
                    table.destroy();
                    $('#datatable').DataTable().destroy();
                    $('#datatable tbody').empty();
                    $('#colTabla').addClass("hidden")
                }
            }

            function alertaPeriodos() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar al menos un periodo',
                    confirmButtonColor: '#dfc14e',
                })
            }

            function alertaFacultad() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes seleccionar al menos una facultad',
                    confirmButtonColor: '#dfc14e',
                })
            }

            function limpiarTitulos() {

                $("#tituloTabla").empty();

                var parteTituloEliminar = 'Periodos: ';
                var titulosPeriodos = $('#tituloPeriodo').find("strong");
                titulosPeriodos.each(function() {
                    var contenidoActual = $(this).text();
                    var contenidoLimpio = contenidoActual.replace(new RegExp(parteTituloEliminar + '.*'), '');
                    $(this).text(contenidoLimpio);
                });
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
                    var textoNuevo = "<h4><strong>Programas activos facultades: " + facultadesFormateadas + "</strong></h4>";
                } else {
                    var textoNuevo = "<h4><strong>Programas activos facultad: " + facultadesFormateadas + "</strong></h4>";
                }
                $('#tituloPeriodo strong').append('Periodos: ' + periodosFormateados);
                $("#tituloTabla").show();
                $("#tituloTabla").html(textoNuevo);
            }

            function dataTable() {
                destruirTabla();
                $('#colTabla').removeClass("hidden")
                var data;
                if (facultadesSeleccionadas.length > 0) {
                    var url = "{{ route('programasPeriodos.tabla.facultad') }}";
                    data = {
                        idfacultad: facultadesSeleccionadas,
                        periodos: periodosSeleccionados
                    }
                } else {
                    var url = "{{ route('programasPeriodos.tabla') }}";
                    data = {
                        periodos: periodosSeleccionados
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
                                    data: 'codPrograma',
                                    title: 'Codigo de programa'
                                },
                                {
                                    data: 'periodo',
                                    title: 'Periodo'
                                },
                                {
                                    data: 'fecha_inicio',
                                    title: 'Fecha de inicio'
                                },
                                {
                                    defaultContent: "<button type='button' class='editar btn btn-warning' data-toggle='modal' data-target='#editar_facultad' data-whatever='modal'><i class='fa-solid fa-pen-to-square'></i></button>",
                                    title: 'Editar Fecha',
                                    className: "text-center"
                                },
                                {
                                    data: 'estado',
                                    defaultContent: "",
                                    title: "Estado",
                                    className: "text-center",
                                    render: function(data, type, row) {
                                        if (data == '1') {
                                            return 'Activo';
                                        } else if (data == '0') {
                                            return 'Inactivo';
                                        }
                                    }
                                },
                                {
                                    data: 'estado',
                                    defaultContent: "",
                                    title: 'Inactivar / Activar',
                                    className: "text-center",
                                    render: function(data, type, row) {
                                        if (data == '1') {
                                            return "<button class='inactivar btn btn-success' type='button' id='boton'><i class='fa-solid fa-unlock'></i></button>";
                                        } else if (data == '0') {
                                            return "<button class='inactivar btn btn-danger' type='button' id='boton'><i class='fa-solid fa-lock'></i></button>";
                                        }
                                    }
                                }
                            ],

                            "language": {
                                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                            },

                        });

                        function obtener_data_inactivar(tbody, table) {
                            $(tbody).on("click", "button.inactivar", function(event) {
                                var data = table.row($(this).parents("tr")).data();
                                if (data.estado == 1) {
                                    Swal.fire({
                                        title: "¿Desea inactivar el perido " + data.periodo + ' - ' + data.codPrograma + "?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        showCloseButton: true,
                                        cancelButtonColor: '#DC3545',
                                        cancelButtonText: "No, Cancelar",
                                        confirmButtonText: "Si"
                                    }).then(result => {
                                        if (result.value) {
                                            $.post("{{ route('programasPeriodos.inactivar') }}", {
                                                    '_token': $('meta[name=csrf-token]').attr('content'),
                                                    id: encodeURIComponent(window.btoa(data.id)),
                                                },
                                                function(result) {
                                                    if (result == "deshabilitado") {
                                                        Swal.fire({
                                                            title: "Periodo desactivado",
                                                            html: "El periodo <strong>" + data.periodo + ' - ' + data.codPrograma +
                                                                "</strong> ha sido inactivado",
                                                            icon: 'info',
                                                            showCancelButton: true,
                                                            confirmButtonText: "Aceptar",
                                                        }).then(result => {
                                                            if (result.value) {
                                                                location.reload();
                                                            };
                                                        })
                                                    }
                                                })
                                        }
                                    });

                                } else {
                                    Swal.fire({
                                        title: "¿Desea activar el perido " + data.periodo + ' - ' + data.codPrograma + "?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        showCloseButton: true,
                                        cancelButtonColor: '#DC3545',
                                        cancelButtonText: "No, Cancelar",
                                        confirmButtonText: "Si"
                                    }).then(result => {
                                        if (result.value) {
                                            $.post("{{ route('programasPeriodos.activar') }}", {
                                                    '_token': $('meta[name=csrf-token]').attr('content'),
                                                    id: encodeURIComponent(window.btoa(data.id)),
                                                },
                                                function(result) {
                                                    if (result == "habilitado") {
                                                        Swal.fire({
                                                            title: "Periodo habilitado",
                                                            html: "El periodo <strong>" + data.periodo + ' - ' + data.codPrograma +
                                                                "</strong> ha sido habilitado",
                                                            icon: 'info',
                                                            showCancelButton: true,
                                                            confirmButtonText: "Aceptar",
                                                        }).then(result => {
                                                            if (result.value) {
                                                                location.reload();
                                                            };
                                                        })
                                                    }
                                                })
                                        }
                                    });
                                }
                            });
                        }

                        function obtener_data_editar(tbody, table) {
                            $(tbody).on("click", "button.editar", function() {
                                var data = table.row($(this).parents("tr")).data();
                                /** Líneas de código que determinan las fechas actuales y límites */
                                var fechaActual = new Date();
                                var fechaLimite = new Date(fechaActual.getFullYear() + 1, fechaActual.getMonth(), fechaActual.getDate());
                                var fechaLimiteISO = fechaLimite.toISOString().split('T')[0];
                                Swal.fire({
                                    title: 'Actualizar fecha de inicio',
                                    html: '<form>' +
                                        '<label for="fecha"> Fecha de Inicio </label>' +
                                        '<input type="date" min="' + fechaActual.toISOString().split('T')[0] + '" max="' + fechaLimiteISO + '" id="fecha" name="fecha" value="' + data.fecha_inicio + '" class="form-control"> <br>',
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    cancelButtonText: "Cancelar",
                                    confirmButtonText: 'Editar'
                                }).then(result => {
                                    if (result.value) {
                                        $.post("{{ route('programasPeriodos.actualizar')}}", {
                                                '_token': $('meta[name=csrf-token]').attr('content'),
                                                id: encodeURIComponent(window.btoa(data.id)),
                                                fecha: $(document).find('#fecha').val(),
                                            },
                                            function(result) {
                                                console.log(result);
                                                if (result == "actualizado") {
                                                    Swal.fire({
                                                        title: "Información actualizada",
                                                        icon: 'success'
                                                    }).then(result => {
                                                        location.reload();
                                                    });
                                                }
                                            }
                                        )
                                    }
                                })
                            });
                        }
                        obtener_data_inactivar("#datatable tbody", table);
                        obtener_data_editar("#datatable tbody", table);
                    }
                });
            }
        });
    </script>

    @include('layout.footer');
</div>