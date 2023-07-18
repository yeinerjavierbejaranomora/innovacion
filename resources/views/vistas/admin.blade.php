<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<!--  creamos el contenido principal body -->
<style>
    #facultades {
        font-size: 18px;
    }
</style>


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
            <div class="row justify-content-center" id="">
                <div class="col-4">
                    <div class="card shadow mb-4">
                        <div class="card-header text-center">
                            <h4><strong>Facultades</strong></h4>
                        </div>
                        <div class="card-body text-start">
                            <h5>Seleccionar Facultades</h5>
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
                            <h5>Seleccionar Programas</h5>
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

        $('.facultades-checkbox').change(function() {
            facultades = $(this);
            
            if ($(this).val() != '') {
                var formData = new FormData();
                formData.append('idfacultad', facultades.val());

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
                        $('#programas').empty();
                        data.forEach(programa => {
                            //* Se crea un input tipo checkbox para cada programa recibido/
                            $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${programa.id}"> ${programa.programa}</label><br>`);
                        });
                    }
                });
            } else {
                $('#programas').empty();
                facultades.prop('disabled', false)
            }
        })
    </script>




    <!-- incluimos el footer -->
    @include('layout.footer')
</div>