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

    .card {
        max-height: 280.22px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
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
            <div class="text-center">
                <h1 class="h3 mb-0 text-gray-800"> <strong>Informe de Facultades</strong></h1>
            </div>
            <br>
            <div class="text-center" id="mensaje">
                <h3>Por defecto se muestran los datos de todas las facultades,
                    si quieres ver datos en especifico, selecciona alguna facultad.
                </h3>
            </div>
            <br>
            <!-- Checkbox Facultades -->
            <div class="row justify-content-center" id="">
                <div class="col-4">
                    <div class="card shadow mb-4">
                        <div class="card-header text-center">
                            <h4><strong>Seleccionar Facultades</strong></h4>
                        </div>
                        <div class="card-body text-start" style="overflow: auto;">
                            <div class="facultades" name="facultades" id="facultades"></div>
                            <!-- <button type="button" class="btn btn-warning" id="buscarProgramas">Seleccionar</button> -->
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card shadow mb-4">
                        <div class="card-header text-center">
                            <h4><strong>Seleccionar Programas</strong></h4>
                        </div>
                        <div class="card-body text-star" style="overflow: auto;">
                            <div name="programas" id="programas"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row justify-content-start" id="graficos">
        <div class=" col-4 text-center">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4><strong>Sello financiero</strong></h4>
                </div>
                <div class="card-body">
                    <canvas id="activos"></canvas>
                </div>
            </div>
        </div>
        <div class="col-4 text-center">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4><strong>Activos con Retención</strong></h4>
                </div>
                <div class="card-body">
                    <canvas id="retencion"></canvas>
                </div>
            </div>
        </div>
        <div class="col-4 text-center">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h4><strong>Activos Primer Ingreso</strong></h4>
                </div>
                <div class="card-body">
                    <canvas id="primerIngreso"></canvas>
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
                        $('div #facultades').append(`<label> <input type="checkbox" value="${facultad.nombre}"> ${facultad.nombre}</label><br>`);
                    });
                }
            });

        }



        $('body').on('change', '#facultades input[type="checkbox"]', function() {
            if ($('#facultades input[type="checkbox"]:checked').length > 0) {
                $('#mensaje').hide();
                $('#programas').empty();
                var formData = new FormData();
                var checkboxesSeleccionados = $('#facultades input[type="checkbox"]:checked');
                valoresSeleccionados = []
                checkboxesSeleccionados.each(function() {
                    formData.append('idfacultad[]', $(this).val());
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('traer.programas') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(datos) {
                        datos = jQuery.parseJSON(datos);

                        $.each(datos, function(key, value) {
                            $('#programas').append(`<label><input type="checkbox" id="" name="programa[]" value="${value.id}"> ${value.nombre}</label><br>`);
                        });
                    }
                })
            } else {
                $('#mensaje').show();
            }
        });
    </script>






    <!-- incluimos el footer -->
    @include('layout.footer')
</div>