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
    var xmlhttp = new XMLHttpRequest();
    var url = "{{ route('admin.getusers') }}";
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);
            $('#example').DataTable({
                "data": data.data,
                "columns": [{
                        data: 'id_banner',
                        title: 'Id Banner'
                    },
                    {
                        data: 'documento',
                        title:'Documento de identidad'
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
                        title:'Rol'
                    },
                    {
                        defaultContent: "<button type='button' class='btn btn-secondary'><i class='fa-solid fa-pen-to-square'></i></button>",
                        title:'Editar'                    
                    },
                    {
                        defaultContent: "<input data-id= class='toggle-class' type='checkbox' data-onstyle='success' data-offstyle='danger' data-toggle='toggle' data-on='Active' data-off='Inactive' {{activo ? 'checked' : '' }}>",
                        title:'Inactivar'
                    }
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },

                //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            });
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