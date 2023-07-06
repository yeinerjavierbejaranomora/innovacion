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
                <h1 class="h3 mb-0 text-gray-800">Periodos</h1>
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
                            <button href="#" class="agregar btn btn-secondary" data-toggle="modal" data-target="#nuevoprograma" data-whatever="modal">Agregar nuevo periodo</button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

            <!--Modal para agregar un programa periodo-->
            <div class="modal fade" id="nuevoprograma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo periodo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="miForm" method="get" action="#">
                                @csrf
                                <div>
                                    <label for="ciclo1" class="col-form-label">Fecha inicio ciclo 1</label>
                                    <input type="date" min="2023-01-01" max="2023-12-31" class="form-control" id="ciclo1" name="ciclo1">
                                </div>
                                <div>
                                    <label for="ciclo2" class="col-form-label">Fecha inicio ciclo 2</label>
                                    <input type="date" min="2023-01-01" max="2023-12-31" class="form-control" id="ciclo2" name="ciclo2">
                                </div>
                                <div>
                                    <label for="temprano" class="col-form-label">Fecha inicio temprano</label>
                                    <input type="date" min="2023-01-01" max="2023-12-31" class="form-control" id="temprano" name="temprano">
                                </div>
                                <div>
                                    <label for="periodo" class="col-form-label">Fecha inicio periodo</label>
                                    <input type="date" min="2023-01-01" max="2023-12-31" class="form-control" id="periodo" name="periodo">
                                </div>
                                <div>
                                    <label for="año" class="col-form-label">Año</label>
                                    <?php
                                $cont = date('Y');
                                ?>
                                <select id="año" class="form-control">
                                    <?php while ($cont >= 2020) { ?>
                                        <option value="<?php echo ($cont); ?>"><?php echo ($cont); ?></option>
                                        <?php $cont = ($cont - 1);
                                    } ?>
                                </select>
                            </div>
                            <br>
                            <div>
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
    // * Datatable para mostrar todas las Facultades *
    var xmlhttp = new XMLHttpRequest();
    var url = "{{ route('facultad.getperiodos') }}";
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var table = $('#example').DataTable({
                "data": data.data,
                "columns": [{
                        data: 'periodos',
                        title: 'Periodo'
                    },
                    {
                        data: 'fechaInicioCiclo1',
                        title: 'Fecha de inicio ciclo 1'
                    },
                    {
                        data: 'fechaInicioCiclo2',
                        title: 'Fecha de inicio ciclo 2'
                    },
                    {
                        data: 'fechaInicioTemprano',
                        title: 'Fecha inicio temprano'
                    },
                    {
                        data: 'fechaInicioPeriodo',
                        title: 'Fecha inicio periodo'
                    },
                    {
                        data: 'year',
                        title: 'Año'
                    },
                    {
                        defaultContent: "<button type='button' class='editar btn btn-warning' data-toggle='modal' data-target='#editar_facultad' data-whatever='modal'><i class='fa-solid fa-pen-to-square'></i></button>",
                        title: 'Editar',
                        className: "text-center"
                    },
                    {
                        data: 'periodoActivo',
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
                        data: 'periodoActivo',
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
            console.log(table);

            /** Editar periodos */
            function obtener_data_editar(tbody, table) {
                $(tbody).on("click", "button.editar", function() {
                    var data = table.row($(this).parents("tr")).data();
                    $('#facultadEditar').val(data.idFacultad);
                    const {
                        value: facultad
                    } = Swal.fire({
                        title: 'Actualizar información',
                        html: '<form>' +
                            '<label for="periodo"> Periodo </label>' +
                            '<input type="date" min="2023-01-01" max="2023-12-31" id="periodo" name="periodo" value="' + data.periodos + '" class="form-control" placeholder="periodo"> <br>' +
                            '<label for="fecha1"> Fecha de inicio ciclo 1 </label>' +
                            '<input type="date" min="2023-01-01" max="2023-12-31" id="fecha1" name="fecha1" value="' + data.fechaInicioCiclo1 + '" class="form-control" placeholder="Fecha de inicio ciclo 1"> <br>' +
                            '<label for="fecha2"> Fecha de inicio ciclo 2 </label>' +
                            '<input type="date" min="2023-01-01" max="2023-12-31" id="fecha2" name="fecha2" value="' + data.fechaInicioCiclo2 + '" class="form-control" placeholder="Fecha de inicio ciclo 2"> <br>' +
                            '<label for="temprano"> Fecha de inicio temprano </label>' +
                            '<input type="date" min="2023-01-01" max="2023-12-31" id="temprano" name="temprano" value="' + data.fechaInicioTemprano + '" class="form-control" placeholder="Fecha de inicio ciclo 2"> <br>' +
                            '<label for="periodo"> Fecha de inicio periodo </label>' +
                            '<input type="date" min="2023-01-01" max="2023-12-31" id="periodo" name="periodo" value="' + data.fechaInicioPeriodo + '" class="form-control" placeholder="Fecha de inicio ciclo 2"> <br>' +
                            '<label for="año" class="col-form-label">Año</label>' +
                            '<select id = "año"> <option  value="'+ data.year +'"selected>' + data.year + '<option> <option value="2022"> 2022 </option> <option value="2021"> 2021 </option></select>',
                            icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: "Cancelar",
                        confirmButtonText: 'Editar'
                    }).then(result => {
                        if (result.value) {
                            $.post("{{ route('programa.update')}}", {
                                    '_token': $('meta[name=csrf-token]').attr('content'),
                                    id: encodeURIComponent(window.btoa(data.id)),
                                    codigo: $(document).find('#codprograma').val(),
                                    programa: $(document).find('#programa').val(),
                                    idfacultad: $(document).find('#facultades').val(),
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
            obtener_data_editar("#example tbody", table);


        }
    }
</script>
@include('layout.footer')