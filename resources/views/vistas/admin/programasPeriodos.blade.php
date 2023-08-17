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
                <div class="col-5 text-start">
                    <div class="card-body" id="cardNivel" style="overflow: auto;">
                        <div class="text-center">
                            <h5 id="tituloNiveldes"><strong>Niveles de Formación</strong></h5>
                            <h5 class="tituloPeriodo"><strong></strong></h5>
                        </div>
                        <div>
                            <!--Accordion-->
                            <div id="accordion">

                                <!--Formación continua-->
                                <div class="card">
                                    <div class="card-header" id="heading2" style="width:100%;">
                                        <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                Formación continua
                                            </button>
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="todosContinua" checked>
                                            </div>
                                        </h5>
                                    </div>

                                    <div id="collapse2" class="collapse show" aria-labelledby="heading2" data-parent="#accordion">
                                        <div class="card-body" style="width:100%;" id="Continua">

                                        </div>
                                    </div>
                                </div>

                                <!--Pregrado-->
                                <div class="card">
                                    <div class="card-header" id="heading1" style="width:100%;">
                                        <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                Pregrado
                                            </button>
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="todosPregrado" checked>
                                            </div>
                                        </h5>
                                    </div>

                                    <div id="collapse1" class="collapse shadow" aria-labelledby="heading1" data-parent="#accordion">
                                        <div class="card-body" style="width:100%;" id="Pregrado">

                                        </div>
                                    </div>
                                </div>

                                <!--Especialización-->
                                <div class="card">
                                    <div class="card-header" id="heading3" style="width:100%;">
                                        <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                Especialización
                                            </button>
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="todosEsp" checked>
                                            </div>
                                        </h5>
                                    </div>

                                    <div id="collapse3" class="collapse shadow" aria-labelledby="heading3" data-parent="#accordion">
                                        <div class="card-body" style="width:100%;" id="Esp">

                                        </div>
                                    </div>
                                </div>

                                <!--Maestría-->
                                <div class="card">
                                    <div class="card-header" id="heading4" style="width:100%;">
                                        <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                Maestría
                                            </button>
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="todosMaestria" checked>
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
                        <div class="text-center">
                            <button type="button" id="deshacerProgramas" class="btn deshacer">Deshacer Todos</button>
                            <button type="button" id="seleccionarProgramas" class="btn deshacer">Seleccionar Todos</button>
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
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table">
                                <table id="example" class="display" style="width:100%">
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

            $('.acordion').collapse();

            periodosSeleccionados = [];
            programasActivos();
            facultades();

            function programasActivos() {
                var datos = $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('programas.activos') }}",
                    method: 'post',
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
                console.log(periodosSeleccionados);
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

            var xmlhttp = new XMLHttpRequest();
            var url = "{{ route('programasPeriodos.tabla') }}";
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    var table = $('#example').DataTable({
                        "data": data.data,
                        "columns": [{
                                data: 'codPrograma',
                                title: 'Codigo de programa'
                            },
                            {
                                data: 'periodo',
                                title: 'Periodo'
                            },
                            {
                                data: 'estado',
                                title: 'Estado'
                            },
                            {
                                data: 'fecha_inicio',
                                title: 'Fecha de inicio'
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
                    obtener_data_inactivar("#example tbody", table);
                }
            };
        });
    </script>

    @include('layout.footer');
</div>