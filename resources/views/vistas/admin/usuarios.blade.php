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
                <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
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
                            <button href="#" class="agregar btn btn-secondary" data-toggle="modal" data-target="#nuevousuario" data-whatever="modal">Agregar nuevo usuario</button>
                        </div>
                        <br>
                    </div>
                </div>
            </div>

            <!--Modal para agregar un usuario nuevo-->
            <div class="modal fade" id="nuevousuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="miForm" method="post" action="{{ route('user.crear') }}">
                                @csrf
                                <div>
                                    <label for="recipient-name" class="col-form-label">ID Banner</label>
                                    <input type="number" placeholder="ID Banner" class="form-control" id="idbanner" name="id_banner" required>
                                </div>
                                <div>
                                    <label for="message-text" class="col-form-label">Documento de identidad</label>
                                    <input type="number" placeholder="Documento de identidad" class="form-control" id="documento" name="documento" required>
                                </div>
                                <div>
                                    <label for="message-text" class="col-form-label">Nombre completo</label>
                                    <input type="text" placeholder="Nombre completo" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div>
                                    <label for="message-text" class="col-form-label">Correo electronico</label>
                                    <input type="email" placeholder="Correo electronico" class="form-control" id="correo" name="email" required>
                                </div>
                                <div>
                                    <label for="message-text" class="col-form-label">Rol</label>
                                    <select class="form-control" name="id_rol" id="rol" required>
                                        <option value="1">Decano</option>
                                        <option value="2">Director</option>
                                        <option value="3">Coordinador</option>
                                        <option value="4">Líder</option>
                                        <option value="5">Docente</option>
                                        <option value="6">Estudiante</option>
                                        <option value="9">Admin</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="message-text" class="col-form-label">Facultad</label>
                                    <select class="form-control" name="id_facultad" id="facultades">
                                        <option value="" selected>Seleccione la facultad</option>
                                    </select>
                                </div>
                                <div id="programas"> </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="crear btn btn-success">Crear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Fin Modal-->
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

<!-- Alertas al crear usuario -->
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
    facultades();
    /** Función que trae todas las faculades */
    function facultades() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('registro.facultades') }}",
            method: 'post',
            success: function(data) {
                data.forEach(facultad => {
                    $('#nuevousuario select#facultades').append(`<option value="${facultad.id}">${facultad.nombre}</option>`);
                })
            }
        })
    }

    //* Comprueba si el select de facultades cambia de valor/
    $('#nuevousuario select#facultades').change(function() {
        console.log('1');
        facultades = $(this);
        //* comprueba que el valor de facultados sea diferente a vacio/
        if ($(this).val() != '') {
            //* se crea un objeto FormData para crear un conjunto depares clave/valor para el envio de los datos/
            var formData = new FormData();
            //* Se añade el par clave/valor con el valor del select/
            formData.append('idfacultad', facultades.val());
            //* Se envia el id de facultad pormedio de ajax para recibir los programas relacionados al id enviado/
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('registro.programas') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    facultades.prop('disabled', true);
                },
                success: function(data) {
                    console.log(data);
                    facultades.prop('disabled', false)
                    $('#nuevousuario div#programas').empty();
                    data.forEach(programa => {
                        //* Se crea un input tipo checkbox para cada programa recibido/
                        $('#nuevousuario div#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${programa.id}"> ${programa.programa}</label><br>`);
                    });
                }
            });
        } else {
            $('#programas').empty();
            facultades.prop('disabled', false)
        }
    })

    /** DataTable */
    var xmlhttp = new XMLHttpRequest();
    var url = "{{ route('admin.getusers') }}";
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var table = $('#example').DataTable({
                "data": data.data,
                "columns": [{
                        data: 'id_banner',
                        title: 'Id Banner'
                    },
                    {
                        data: 'documento',
                        title: 'Documento de identidad'
                    },
                    {
                        data: 'nombre',
                        title: 'Nombre de usuario'
                    },
                    {
                        data: 'email',
                        title: 'Email'
                    },
                    {
                        data: 'nombreRol',
                        title: 'Rol'
                    },
                    {
                        defaultContent: "<button type='button' class='editar btn btn-warning'><i class='fa-solid fa-pen-to-square'></i></button>",
                        title: 'Editar'
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
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },

                //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            });

            function obtener_data_editar(tbody, table) {
                $(tbody).on("click", "button.editar", function() {
                    var data = table.row($(this).parents("tr")).data();

                    $(location).attr('href', "editar/" + encodeURIComponent(window.btoa(data.id)));

                })
            }

            function obtener_data_inactivar(tbody, table) {
                $(tbody).on("click", "button.inactivar", function(event) {
                    var data = table.row($(this).parents("tr")).data();
                    if (data.activo == 1) {
                        Swal.fire({
                            title: "¿Desea inactivar el usuario " + data.nombre + "?",
                            icon: 'warning',
                            showCancelButton: true,
                            showCloseButton: true,
                            cancelButtonColor: '#DC3545',
                            cancelButtonText: "No, Cancelar",
                            confirmButtonText: "Si"
                        }).then(result => {
                            if (result.value) {
                                $.post("{{ route('user.inactivar') }}", {
                                        '_token': $('meta[name=csrf-token]').attr('content'),
                                        id: data.id,
                                    },
                                    function(result) {
                                        console.log(result);
                                        if (result == "deshabilitado") {
                                            Swal.fire({
                                                title: "Usuario deshabilitado",
                                                html: "El programa <strong>" + data.nombre +
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
                            title: "¿Desea activar el usuario " + data.nombre + "?",
                            icon: 'warning',
                            showCancelButton: true,
                            showCloseButton: true,
                            cancelButtonColor: '#DC3545',
                            cancelButtonText: "No, Cancelar",
                            confirmButtonText: "Si"
                        }).then(result => {
                            if (result.value) {
                                $.post("{{ route('user.activar') }}", {
                                        '_token': $('meta[name=csrf-token]').attr('content'),
                                        id: data.id,
                                    },
                                    function(result) {
                                        if (result == "habilitado") {
                                            Swal.fire({
                                                title: "Usuario habilitado",
                                                html: "El usuario <strong>" + data.nombre +
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

            obtener_data_editar("#example tbody", table);
            obtener_data_inactivar("#example tbody", table);

        }
    }






    /*$(document).ready(function() {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: {


            url: "{{ route('admin.getusers') }}",
                /*type: "POST",
                contentType: "application/json",*/
    /*data: function(d) {
        console.log(JSON.stringify(d));
        return JSON.stringify(d)
    },
    dataSrc: 'result.data'*/
    /*},
            columns: [{
                    data: 'id_banner'
                },
                {
                    data: 'documento'
                },
                {
                    data: 'nombre'
                },
                {
                    data: 'email'
                },
                {
                    data: 'nombreRol'
                },
            ],

            //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        });
    });*/
</script>

<!-- incluimos el footer -->
@include('layout.footer')