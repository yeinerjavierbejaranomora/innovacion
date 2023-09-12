@include('layout.header')

<style>

    .card_historial{
        border-radius: 2rem;
    box-shadow: 5px 5px;
    
    }
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

    .table td, .table th {
        border: 13px solid white;
    }

</style>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" style="background-image: url('/public/assets/images/img_estudiantes.png');text-align: center;display: block;color: white;">
            <div class="text-center">
                <h1 class="h3 mb-0 text-gray-800"> <strong style="color:white">Historial Estudiante</strong></h1>
            </div>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
      
            <div class="text-center" id="mensaje">
                <h3>Compruebe el historial ingresando el codigo del estudiantil</h3>
            </div>
            <div class="text-center" id="">
                {{-- <form action="{{ route('historial.consulta') }}" method="post"> --}}
                    {{-- @csrf --}}
                    <div class="row">
                        <div class="col-sm-3 text-dark">
                            <p class="mb-0">Codigo estudiante</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="text-muted mb-0"><input class="form-control" type="text" name="codigo" placeholder="Codigo estudiante" id="codigo" required value="100039616"></p>
                        </div>
                        <div class="col-auto">
                            <button type="button" onclick="consultarEstudiante()" class="btn btn-primary mb-3">Consultar</button>
                            {{-- <button type="submit"  class="btn btn-primary mb-3">Consultar</button> --}}
                        </div>
                    </div>
                {{-- </form> --}}

            </div>

            <br>

            <div class="container-fluid" style="background-color: #d1d3e2;padding: 1%;">
                <div class="container mt-3" id="info">

                </div>
            </div>
            <div class="container-fluid">
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTabs">
                        <!-- Pestañas se llenarán dinámicamente aquí -->
                    </ul>

                </div>
            </div>

            <div class="tab-content" id="tabContent">
                <!-- Contenidos de pestañas se llenarán dinámicamente aquí -->
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

        <div class="" id="taps_internos">
            <div class="container">
                <div class="">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#malla" role="tab" aria-controls="pills-home" aria-selected="true">malla</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#Viendo" role="tab" aria-controls="pills-profile" aria-selected="false">Viendo en aula</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#proyectadas" role="tab" aria-controls="pills-contact" aria-selected="false">Materias proyectadas - programadas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#por_ver" role="tab" aria-controls="pills-contact" aria-selected="false">Materias por ver</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#vistas" role="tab" aria-controls="pills-contact" aria-selected="false">Materias vistas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#Historial" role="tab" aria-controls="pills-contact" aria-selected="false">Historial completo</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="malla"  role="tabpanel" >
                            <div class="card-deck">

                                <div class="card card_historial semestre" style="background-color: #dfc14e;color: #4a4848;">
                                    <div class="card-body">
                                        
                                        <h5 style="position: relative;top: 50%;transform: translateY(-50%);text-align: center;"><b>Semestre:</b><br><span id="semestre"> 1 </span> </h5>
                                        
                                    </div>
                                </div>
                            
                                <div class="card card_historial materias">
                                    <div class="card-body">
                                            <div class="" style=" display: flex;">
                                                <span class="bg-danger"style="border-bottom: 2px solid;border-top: 2px solid;order-left:2px solid;border-top-left-radius: 30px;border-bottom-left-radius: 28px;min-width: 27px;height: 42px;">&nbsp;&nbsp;&nbsp;<br><br>                                            
                                                </span>
                                        
                                                <h6 class="card-title" style="border-top: 2px solid;border-bottom: 2px solid;border-right: 2px solid;border-bottom-right-radius: 30px;border-top-right-radius: 30px;margin-left: 4px;height: 42px;width: 100%;">
                                                    <b>Codigo:</b>
                                                    <br>
                                                    <span>
                                                    ABV32190
                                                    </span>
                                                </h6>
                                            </div>
                                            <p class="card-text" id="" style="text-align: center;"><span>DIP SEG Y SALUD TRA RIES P VIR</span> </p>
                                            <p class="card-text" id="" style="text-align: center;"><span><b>Calificación:</b> 4.5</span> </p>
                                            <p class="card-text" id="" style="text-align: center;"><span> <b>Créditos:</b> 2</span> </p>
                                        
                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="tab-pane fade" id="Viendo" role="tabpanel" >

                            <div class="container">
                                <div class="row">
                                    <table class="table table-striped">
                                        <thead style="background-color: #d5b94b;color: white;border: 1px solid black;">
                                            <tr style="border: 13px solid;">
                                                <th scope="col">Codigo Materia</th>
                                                <th scope="col">Materias</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Ciclo</th>
                                                <th scope="col">Creditos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">ABV32190</th>
                                                <td>ALGORITMOS Y VISUALIZACIÓN DE DATOS</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade"                id="proyectadas"    role="tabpanel" >
                            <div class="table-responsive-xl">
                            <table class="table table-striped">
                                        <thead style="background-color: #d5b94b;color: white;border: 1px solid black;">
                                            <tr style="border: 13px solid;">
                                                <th scope="col">Codigo Materia</th>
                                                <th scope="col">Materias</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Ciclo</th>
                                                <th scope="col">Creditos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
    
                                            </tr>
                                            <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>  
                        </div>
                        <div class="tab-pane fade"                id="por_ver"        role="tabpanel" > <table class="table table-striped">
                                        <thead style="background-color: #d5b94b;color: white;border: 1px solid black;">
                                            <tr style="border: 13px solid;">
                                                <th scope="col">Codigo Materia</th>
                                                <th scope="col">Materias</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Ciclo</th>
                                                <th scope="col">Creditos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">ABV32190</th>
                                                <td>ALGORITMOS Y VISUALIZACIÓN DE DATOS</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table></div>
                        <div class="tab-pane fade"                id="vistas"         role="tabpanel" > <table class="table table-striped">
                                        <thead style="background-color: #d5b94b;color: white;border: 1px solid black;">
                                            <tr style="border: 13px solid;">
                                                <th scope="col">Codigo Materia</th>
                                                <th scope="col">Materias</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Ciclo</th>
                                                <th scope="col">Creditos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">ABV32190</th>
                                                <td>ALGORITMOS Y VISUALIZACIÓN DE DATOS</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table></div>
                        <div class="tab-pane fade"                id="Historial"      role="tabpanel"> <table class="table table-striped">
                                        <thead style="background-color: #d5b94b;color: white;border: 1px solid black;">
                                            <tr style="border: 13px solid;">
                                                <th scope="col">Codigo Materia</th>
                                                <th scope="col">Materias</th>
                                                <th scope="col">Semestre</th>
                                                <th scope="col">Ciclo</th>
                                                <th scope="col">Creditos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">ABV32190</th>
                                                <td>ALGORITMOS Y VISUALIZACIÓN DE DATOS</td>
                                                <td>2</td>
                                                <td>2</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                            </tr>
                                            <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                </div>

            </div>

        </div>
   

    </div>

    <script>


        $(document).ready(function() {

            	
            new DataTable('#example');
           
            $(document).on("click",".datos",function(){
                idbanner=$(this).attr('data-id');
                programa=$(this).attr('data-programa');
                tap=$(this).attr('data-tap');
             
                var formData = new FormData();
                formData.append('codBanner',idbanner);
                formData.append('programa',programa);
                $.ajax({
                    headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    url: "{{ route('historial.consultaHistorial') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $('#codigo').prop('disabled',true);
                    },
                    success: function(data){

                        console.log(data);

                        if(data.info=="con_datos")
                        {
                                console.log(data);

                                const materias = data.historial
                                // Convierte el objeto en un array de objetos
                                const materiasArray = $.map(materias, function(value, key) {
                                return value;
                                });

                                                    
                                // Ordena el array primero por "semestre" y luego por "ciclo"
                                materiasArray.sort(function(a, b) {
                                    if (a.semestre !== b.semestre) {
                                        return a.semestre - b.semestre;
                                    } else {
                                        return a.ciclo - b.ciclo;
                                    }
                                });

                                // Crea un objeto para agrupar las materias por semestre
                                const materiasPorSemestre = {};

                                // Agrupa las materias por semestre
                                $.each(materiasArray, function(index, materia) {
                                    const semestre = materia.semestre;

                                    if (!materiasPorSemestre[semestre]) {
                                        materiasPorSemestre[semestre] = [];
                                    }

                                    materiasPorSemestre[semestre].push(materia);
                                });

                                                        
                                // Crea la tabla y agrega las filas
                                const $tablas = $('<div class="container "><div class="row"> <table>');

                                let currentSemestre = null; // Para mantener un seguimiento del semestre actual

                                // Recorre las materias y crea filas
                                $.each(materiasArray, function(index, materia) {

                               

                                    if (materia.semestre !== currentSemestre) {
                                        // Si es un nuevo semestre, crea una nueva fila
                                       

                                       
                                        currentSemestre = materia.semestre;
                                        const $filaSemestre = 
                                            $('<tr>').append(
                                                $('<div class="card bg-primary">  <div class="card-body text-center"> <p class="card-text">').text(`Semestre ${currentSemestre}`)
                                                .attr('colspan', 4)
                                                );
                                        $tablas.append($filaSemestre);
                                    }

                                    // Agrega la materia como una columna en la fila actual
                                    const $filaMateria = $('<td style="color:white"><div class="card bg-primary">  <div class="card-body text-center"> <p class="card-text">')
                                        .text(`Código: ${materia.codigo_materia}\nNombre: ${materia.nombre_materia}\nCréditos: ${materia.creditos}\nCiclo: ${materia.ciclo}`).addClass(materia.color);
                                    $tablas.children('tr:last').append($filaMateria);
                                });

                                $("#"+tap+"").empty();
                                // Agrega la tabla al documento
                                $tablas.appendTo("#"+tap+"");
                            
                        }
                        if(data.info=="sin_datos"){

                            const $tablas = $('<div class="container "><div class="row"> <table>');

                            const $filaMateria = $('<td>')
                                        .text('En estos momentos no contamos Con información contacta con soporte');
                                    $tablas.children('tr:last').append($filaMateria);
                                    $("#"+tap+"").empty();
                                    $tablas.appendTo("#"+tap+"");
                        }
                    }
                });
            });
            

        })


        function consultarEstudiante() {
            codBanner = $('#codigo');
            if (codBanner.val() != '') {
                $('#info').html('');
                $('#programas').html('');
               
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
                    console.log(data);
                    $('#myTabs').empty();
                    $('#codigo').prop('disabled',false);
                    data.forEach(function(tab, index) {
                        // Crear la pestaña
                        var tabLink = $('<a>')
                        .addClass('nav-link datos ')
                        .attr('data-toggle', 'tab')
                        .attr('data-id',codBanner )
                        .attr('data-programa',tab.cod_programa)
                        .attr('data-tap', 'tab' + index)
                        .attr('href', '#tab' + index)
                        .text(tab.programa); // Suponiendo que cada objeto tiene una propiedad 'title'

                        // Agregar la pestaña a la lista de pestañas
                        $('#myTabs').append($('<li>').append(tabLink));

                 

                        // Crear el contenido de la pestaña
                        var tabContent = $('<div>')
                        .addClass('tab-pane fade datos')
                        .attr('id', 'tab' + index); 

                        var tabLink = $('<a>')
                        .addClass('nav-link datos ')
                        .attr('data-toggle', 'tab')
                        .attr('data-id',codBanner )
                        .attr('data-programa',tab.cod_programa)
                        .attr('data-tap', 'tab' + index)
                        .attr('href', '#tab' + index)
                        .text(tab.programa);
                        
                        $(tabContent).append()
                        // Puedes poner un mensaje mientras carga el contenido

                        // Agregar el contenido de la pestaña al contenedor
                        $('.tab-content').append(tabContent);
                        
                    });

                    // Agregar el listener para el evento de cambio de pestaña
                    $('#myTabs a').on('shown.bs.tab', function(event) {
                        var targetTab = $(event.target).attr('href');
                        cargarContenido(targetTab); // Llama a la función para cargar contenido
                    });
                    /*if(data.homologante != ''){
                        $('#programas').html('');
                        data.forEach(programa =>{

                            $('#programas').append(`<li class="nav-item active">
                                <a class="nav-link active" data-toggle="pill" href="#tap_0" role="tab" aria-controls="pills-contact" aria-selected="true">${programa.programa}</a>
                                </li>`)
                        })
                    }else{
                        $('#programas').html('');
                        $('#codigo').prop('disabled',false);
                    }*/
                }
            });
        }


        function consultaProgramas(codBanner) {
            var formData = new FormData();
            formData.append('codBanner',codBanner);
            var programas;
            $.ajax({
                headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: "{{ route('historial.consultaprogramas') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function(){
                    $('#codigo').prop('disabled',true);
                },
                success: function(data){
                    $('#codigo').prop('disabled',false);
                    programas = data;

                }
            });


        }


    </script>
    @include('layout.footer')

