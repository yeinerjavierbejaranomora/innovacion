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
                    <h3> Bienvenido {{auth()->user()->nombre}}</h3>
                </div>
            </div>




        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Checkbox Facultades -->
            <div class="row justify-content-between" id="">
                <div class="col-4 text-start">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4><strong>Facultades</strong></h4>
                        </div>
                        <div class="card-body">
                            <h6>Seleccionar Facultades</h6>
                           <div name="facultades" id="facultades"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-center">
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h4><strong>Programas</strong></h4>
                        </div>
                        <div class="card-body">
                           <div name="programas" id="programas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        facultades();

        function facultades() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('registro.facultades') }}",
                method: 'post',
                success: function(data) {
                    data.forEach(facultad => {
                        $('div #facultades').append(`<label> <input type="checkbox" id="" value="${facultad.id}"> ${facultad.nombre}</label><br>`);
                    });
                }
            });

        }
    </script>




    <!-- incluimos el footer -->
    @include('layout.footer')
</div>