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
            </div>




        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Reglas de negocio</h1>
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
                        <div class="col-4 justify-content-center">
                            <button href="#" class="agregar btn btn-secondary" data-toggle="modal" data-target="#nuevoprograma" data-whatever="modal">Agregar nueva regla</button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

            <!--Modal para agregar una nueva regla-->
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
                            <form id="miForm" method="post" action="{{ route('regla.crear') }}">
                                @csrf
                                <div>
                                    <label for="codigo" class="col-form-label">Codigo del programa</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" required>
                                </div>
                                <div>
                                    <label for="creditos" class="col-form-label">Número de créditos</label>
                                    <input type="number" class="form-control" id="creditos" name="creditos" required>
                                </div>
                                <div>
                                    <label for="materias" class="col-form-label">Materias permitidas</label>
                                    <input type="number" class="form-control" id="materias" name="materias" required>
                                </div>
                                <div>
                                    <label for="estudiante" class="col-form-label">Tipo de estudiante</label>
                                    <select class="form-control" id="estudiante" name="estudiante" required>
                                        <option value="Antiguo">Antiguo</option>
                                        <option value="Transferente">Transferente</option>
                                        <option value="PrimerI">Primer ingreso</option>
                                    </select>
                                </div>
                                <label for="ciclo" class="col-form-label">Ciclo</label>
                                <br>
                                <div class="form-check form-check-inline" id="ciclo">
                                    <input class="form-check-input" type="checkbox" value="1" id="ciclo1" name="ciclo1" required>
                                    <label class="form-check-label" for="ciclo1"> Ciclo 1 </label>
                                    &nbsp
                                    <input class="form-check-input" type="checkbox" value="2" id="ciclo2" name="ciclo2" required>
                                    <label class="form-check-label" for="ciclo1"> Ciclo 2</label>
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
    /** Script para que el usuario solo pueda seleccionar 1 checkbox */
    $(document).ready(function() {
        $('#ciclo input[type="checkbox"]').on('change', function() {
            var checkboxes = $('#ciclo input[type="checkbox"]');
            if ($(this).is(':checked')) {
                checkboxes.not(this).prop('disabled', true);
            } else {
                checkboxes.prop('disabled', false);
            }
        });
    });

    // * Datatable para mostrar todas las Facultades *
    var xmlhttp = new XMLHttpRequest();
    var url = "{{ route('facultad.getreglas') }}";
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var table = $('#example').DataTable({
                "data": data.data,
                "columns": [{
                        data: 'Programa',
                        title: 'Codigo de programa'
                    },
                    {
                        data: 'creditos',
                        title: 'Creditos'
                    },
                    {
                        data: 'materiasPermitidas',
                        title: 'Materias permitidas'
                    },
                    {
                        data: 'tipoEstudiante',
                        title: 'Tipo de estudiante'
                    },
                    {
                        data: 'ciclo',
                        title: 'Ciclo'
                    },
                    {
                        defaultContent: "<button type='button' class='editar btn btn-warning' data-toggle='modal' data-target='#editar_facultad' data-whatever='modal'><i class='fa-solid fa-pen-to-square'></i></button>",
                        title: 'Editar',
                        className: "text-center",
                    },
                    {
                        data: 'activo',
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
                        data: 'activo',
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
                    },
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            });

            /** Editar periodos */
            function obtener_data_editar(tbody, table) {
                $(tbody).on("click", "button.editar", function() {
                    var data = table.row($(this).parents("tr")).data();

                    Swal.fire({
                        title: 'Actualizar información',
                        html: '<form>' +
                            '<label for="editcodigo" class="col-form-label">Codigo del programa</label>' +
                            '<input type="text" class="form-control" id="editcodigo" name="editcodigo" value="' + data.Programa + '">' +
                            '<label for="editcreditos" class="col-form-label">Número de créditos</label>' +
                            '<input type="number" class="form-control" id="editcreditos" name="editcreditos" value="' + data.creditos + '">' +
                            '<label for="editmaterias" class="col-form-label">Materias permitidas</label>' +
                            '<input type="number" class="form-control" id="editmaterias" name="editmaterias" value="' + data.materiasPermitidas + '">' +
                            '<label for="editestudiante" class="col-form-label">Tipo de estudiante</label>' +
                            '<select class="form-control" id="editestudiante" name="editestudiante">' +
                            '<option value="Antiguo"' + (data.tipoEstudiante === 'Antiguo' ? ' selected' : '') + '>Antiguo</option>' +
                            '<option value="Transferente"' + (data.tipoEstudiante === 'Transferente' ? ' selected' : '') + '>Transferente</option>' +
                            '<option value="PrimerI"' + (data.tipoEstudiante === 'PrimerI' ? ' selected' : '') + '>Primer ingreso</option>' +
                            '</select>' +
                            '<label for="ciclo" class="col-form-label">Ciclo</label><br>' +
                            '<div class="form-check form-check-inline" id="ciclo">' +
                            '<input class="form-check-input" type="checkbox" value="1"' + (data.ciclo == 1 ? 'checked' : '') + ' id="edciclo1" name="edciclo1">' +
                            '<label class="form-check-label" for="ciclo1"> Ciclo 1 </label>' +
                            '&nbsp' +
                            '<input class="form-check-input" type="checkbox" value="2"' + (data.ciclo == 2 ? 'checked' : '') + ' id="edciclo2" name="edciclo2">' +
                            '<label class="form-check-label" for="ciclo1"> Ciclo 2</label>' +
                            '</div>' +
                            '</form>',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: "Cancelar",
                        confirmButtonText: 'Editar',
                        preConfirm: () => {
                            return new Promise((resolve, reject) => {
                                const selectedCiclo1 = $('#edciclo1').is(':checked');
                                const selectedCiclo2 = $('#edciclo2').is(':checked');

                                if (!selectedCiclo1 && !selectedCiclo2) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Debes seleccionar al menos un ciclo',
                                        icon: 'error',
                                        allowOutsideClick: false
                                    });
                                } else if (selectedCiclo1 && selectedCiclo2) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Solo puedes seleccionar un ciclo',
                                        icon: 'error',
                                        allowOutsideClick: false
                                    });

                                } else {
                                    resolve();
                                }
                            });
                        }
                    }).then(result => {
                        if (result.isConfirmed) {
                            const selectedCiclo1 = $('#edciclo1').is(':checked');
                            const selectedCiclo2 = $('#edciclo2').is(':checked');
                            const selectedCiclo = selectedCiclo1 ? 1 : 2;
                            if (result.value) {
                                //** Continuar aquí */
                                $.post("{{ route('regla.update')}}", {
                                        '_token': $('meta[name=csrf-token]').attr('content'),
                                        id: encodeURIComponent(window.btoa(data.id)),
                                        programa: $(document).find('#editcodigo').val(),
                                        creditos: $(document).find('#editcreditos').val(),
                                        materias: $(document).find('#editmaterias').val(),
                                        estudiante: $(document).find('#editestudiante').val(),
                                        ciclo: selectedCiclo,
                                    },
                                    function(result) {
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
                        }
                    })
                });
            }
            obtener_data_editar("#example tbody", table);
            console.log(table);
        }
    }
</script>
@include('layout.footer')