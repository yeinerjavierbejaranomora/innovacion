@include('layout.header')

<style>
    #facultades {
        font-size: 14px;
    }

    #programas {
        font-size: 14px;
    }

    #generarReporte {
        margin-left: 260px;
    }


    .btn {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 200px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
    }

    #botonModalProgramas,
    #botonModalOperador {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 100px;
        height: 30px;
        border-radius: 10px;
        font-weight: bold;
        place-items: center;
        font-size: 14px;
    }

    #cardFacultades {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    #cardProgramas {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    .card {
        margin-bottom: 3%;
    }

    .hidden {
        display: none;
    }

    #chartEstudiantes {
        min-height: 405.6px;
        max-height: 405.6px;
    }

    #centrar {
        display: flex;
        align-items: center;
    }

    .graficos {
        min-height: 460px;
        max-height: 460px;
    }

    #operadoresTotal,
    #programasTotal {
        height: 600px !important;
    }

</style>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="text-center">
                <h1 class="h3 mb-0 text-gray-800"> <strong>Historial Estudiante</strong></h1>
            </div>
            <br>
            <div class="text-center" id="mensaje">
                <h3>Compruebe su historial ingresando su codigo de estudiante</h3>
            </div>
            <div class="text-center" id="">
                <div class="row">
                    <div class="col-sm-3 text-dark">
                        <p class="mb-0">Codigo estudiante</p>
                    </div>
                    <div class="col-sm-3">
                        <p class="text-muted mb-0"><input class="form-control" type="text" name="codigo" placeholder="Codigo estudiante" id="codigo" required></p>
                    </div>
                    <div class="col-auto">
                        <button type="button" onclick="consultarEstudiante()" class="btn btn-primary mb-3">Consultar</button>
                    </div>
                </div>
            </div>
            <br>

            <div class="container-fluid">
                <div class="container mt-3" id="info">

                </div>
            </div>



            <div class="container-fluid">
                <div class="container mt-3">
                    <div class="row py-5" id="botones">

                    </div>
                </div>
            </div>



        </div>

        {{-- <div class="row justify-content-center mt-5" id="">
            <div class="col-10 text-center" id="colSelloFinanciero">
                <div class="card shadow mb-6 graficos">
                    <div class="card-header">
                        <h5 class="titulos"><strong>Malla Curricular</strong></h5></div>
                    <div class="card-body">
                        <div class="tab-content">
                            <table class="table">
                                <tbody id="contenido">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div> --}}

        <br>

    </div>
    <script>
        function consultarEstudiante() {
            codBanner = $('#codigo');
            if (codBanner.val() != '') {

                consultaEstudiante(codBanner.val());
                consultaNombre(codBanner.val());

                //consultaHistorial(codBanner.val());
                //consultaProgramacion(codBanner.val());

            } else {

                alert("ingrese su codigo de estudiante");
            }
        }

        function consultaNombre(codBanner){
            var formData = new FormData();
            formData.append('codBanner',codBanner);
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('historial.consultanombre') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#codigo').prop('disabled',true);
                },
                success: function(data){
                    console.log(data);
                    $('#codigo').prop('disabled',false);
                    $('#info').html('');
                    $('#info').append(`<p class="col-md-12" style="margin-top: 2%;">
                        <strong>Historial académico de: </strong> ${data}<br>
                        <strong>IdBanner</strong>: ${codBanner}<br>

                        <b> Recuerde que la información suministrada por este sistema es de carácter informativo.</b> <br>
                        Nota: si el periodo ha finalizado las calificaciones pueden tardar alrededor de 5 días para verse reflejadas en el historial.
                    </p>`);
                }
            });
        }

        function consultaEstudiante(codBanner) {
            var formData = new FormData();
            formData.append('codBanner',codBanner);
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('historial.consulta') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#codigo').prop('disabled',true);
                },
                success: function(data){
                    $('#codigo').prop('disabled',false);
                    if(data.homologante != ''){
                        $('#botones').html('');
                        $('#botones').append(`<div class="col 4 text-center">
                            <a type="button" class="btn boton" onclick="consultaMalla('${data.programa}');">
                                Malla curricular
                            </a>
                        </div>
                        <div class="col 4 text-center">
                            <a type="button" class="btn boton" onclick="consultaHistorial(${data.homologante});">
                                Historial academico
                            </a>
                        </div>
                        <div class="col 4 text-center">
                            <a type="button"class="btn boton" onclick="consultaProgramacion(${data.homologante});">
                                Programado
                            </a>
                        </div>
                        <div class="col 4 text-center">
                            <a type="button"class="btn boton" onclick="consultaPorVer(${data.homologante});">
                                Materias Por Ver
                            </a>
                        </div>`)
                    }else{
                        $('#botones').html('');
                        $('#codigo').prop('disabled',false);
                    }
                }
            });
        }

        /*function consultaMalla(programa) {
            var formData = new FormData();
            // formData.append('codBanner',codBanner);
            formData.append('programa',programa);
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('historial.consultamalla') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#codigo').prop('disabled',true);
                },
                success: function(data){
                    $('#codigo').prop('disabled',false);
                    //console.log(data);
                    data.forEach(malla => {
                        $('#contenido').append(renderMalla(malla));
                    })
                }
            });
        }

        function renderMalla(malla){
            render = `<tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>`;
            return render;
        }

        function consultaHistorial(codBanner) {
            var formData = new FormData();
            formData.append('codBanner',codBanner);
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('historial.consultahistorial') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#codigo').prop('disabled',true);
                },
                success: function(data){
                    $('#codigo').prop('disabled',false);
                    console.log(data);
                }
            });
        }

        function consultaProgramacion(codBanner) {
            var formData = new FormData();
            formData.append('codBanner',codBanner);
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('historial.consultaprogramacion') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#codigo').prop('disabled',true);
                },
                success: function(data){
                    $('#codigo').prop('disabled',false);
                    console.log(data);
                }
            });
        }

        function consultaPorVer(codBanner){
            var formData = new FormData();
            formData.append('codBanner',codBanner);
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                data: formData,
                url: "{{ route('historial.consultaporver') }}",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#codigo').prop('disabled',true);
                },
                success: function(data){
                    $('#codigo').prop('disabled',false);
                    console.log(data);
                }
            })
        }*/

    </script>
    @include('layout.footer')

