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
                <h1 class="h3 mb-0 text-gray-800">Planeacion</h1>
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
    </div>
    <!-- /.container-fluid -->



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script>
        // * Datatable para mostrar todas las Facultades *
        var xmlhttp = new XMLHttpRequest();
        var url = "{{ route('programas.planeacion') }}";
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var data = JSON.parse(this.responseText);
                var table = $('#example').DataTable({
                    "data": data.data,
                    "order": [
                            [2, 'asc'],
                            [3, 'asc']
                        ],
                    "columns": [{
                            data: 'codBanner',
                            title: 'Codigo Banner'
                        },
                        {
                            data: 'codMateria',
                            title: 'Codigo Materia'
                        },
                        {
                            data: 'orden',
                            title: 'Orden'
                        }, 
                        {
                            data: 'semestre',
                            title: 'Semestre'
                        },
                        {
                            data: 'programada',
                            title: 'Programada'
                        },
                        {
                            data: 'codprograma',
                            title: 'Codigo programa'
                        },
                        {
                            data: 'fecha_registro',
                            title: 'Fecha de registro'
                        }
                    ],

                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                    },

                });
            }
        }
    </script>
    @include('layout.footer')
</div>