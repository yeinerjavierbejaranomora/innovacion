<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
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

            <div class="row">
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
                    if (data.activo == 1) {
                        Swal.fire({
                            title: "¿Desea inactivar el perido " + data.periodo + ' - '+ data.codPrograma + "?",
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
                                                html: "El periodo <strong>" + data.periodo + ' - '+ data.codPrograma +
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
                            title: "¿Desea activar el perido " + data.periodo + ' - '+ data.codPrograma + "?",
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
                                                html: "La regla <strong>" + data.periodo + ' - '+ data.codPrograma +
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