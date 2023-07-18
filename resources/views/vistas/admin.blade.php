<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<!--  creamos el contenido principal body -->
<style>
    #facultades {
        font-size: 18px;
    }

    #buscarProgramas {
        background-color: #dfc14e;
        border-color: #dfc14e;
        width: 150px;
        padding: 10px 30px;
        border-radius: 10px;
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
                            <h5 class="text-center">Seleccionar Facultades</h5>
                            <div class="facultades" name="facultades" id="facultades"></div>
                            <!-- <button type="button" class="btn btn-warning" id="buscarProgramas">Seleccionar</button> -->
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card shadow mb-4">
                        <div class="card-header text-center">
                            <h4><strong>Programas</strong></h4>
                        </div>
                        <div class="card-body text-star">
                            <h5 class="text-center">Seleccionar Programas</h5>
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
           datos = $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('registro.facultades') }}",
                method: 'post',
                success: function(data) {
                    data.forEach(facultad => {
                        $('div #facultades').append(`<label> <input type="checkbox" value="${facultad.id}"> ${facultad.nombre}</label><br>`);
                    });
                }
            });
            console.log(datos);
        }

        $('#facultades').change(function() {         
            var facultadesSeleccionadas = $('.facultades-checkbox:checked');
                var facultadId = $('.facultades-checkbox:checked').val();
                console.log(facultadId);
                console.log('entra');

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
                            data.forEach(programa => {
                                $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${programa.id}"> ${programa.programa}</label><br>`);
                            });
                        }
                    });
                } else {
                    $('#programas').empty();
                }
            });
    </script>

    <!-- incluimos el footer -->
    @include('layout.footer')
</div>