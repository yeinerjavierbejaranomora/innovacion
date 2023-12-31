@include('layout.header')

<style>

.card_historial {
    border-radius: 2rem;
    box-shadow: 5px 5px #4a4848;
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
    .table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(255 255 255 / 66%);
}

.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #000;
    background-color: darkgray;
}

.datos{
    color: white;
    
  

}

div .show{
    padding-top: 22px;
    padding-bottom: 40px;
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

            <div class="container-fluid hidden" style="background-color:#6e707e;padding: 1%;margin-bottom: 3%;border-radius: 19px;" id="info_1">
                <div class="container mt-3" id="info" style="color:white">

                </div>
            </div>
            <div class="container-fluid hidden contenedor_interno" style="background-color: #6e707e;border-radius: 15px;padding-top: 20px;color: white;" >
                <div class="col-md-12">

                    <ul class="nav nav nav-pills" id="myTabs">
                        <!-- Pestañas se llenarán dinámicamente aquí -->
                    </ul>

                    
                    <div class="tab-content" id="tabContent">
                        <!-- Contenidos de pestañas se llenarán dinámicamente aquí -->
                    </div>
          

                </div>

      
   

            </div>



        

        </div>
    </div>

    <!-- <div class="hidden" id="taps_internos">
            


                 
                    <div class="tab-pane fade"  id="Historial"   role="tabpanel"> 
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

        </div>

    </div> -->

    <script>


        $(document).ready(function() {

            	
            new DataTable('#example');
           
            $(document).on("click",".datos",function(){
            
                $(document).find('.taps_programas').empty()
             $(document).find("#tabContent div .active ").removeClass("active show")
                idbanner=$(this).attr('data-id');
                programa=$(this).attr('data-programa');
                tap=$(this).attr('data-tap');
                tap="#"+tap;
                  $(tap).empty()
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
                                const $tablas = $('<div class="container" style="max-width: 100%;"><div class="card-deck"><div class="row"> ');


                                

                                 $li_taps_internos="";


                                $li_taps_internos+='<div class="container">'
                                $li_taps_internos+='<div class="">'
                                $li_taps_internos+='<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">'
                                $li_taps_internos+='    <li class="nav-item">'
                                $li_taps_internos+='        <a class="nav-link active taps_inter" id="pills-home-tab" data-toggle="pill" href="#malla" role="tab" aria-controls="pills-home" aria-selected="true">malla</a>'
                                $li_taps_internos+='    </li>'
                                $li_taps_internos+='    <li class="nav-item">'
                                $li_taps_internos+='        <a class="nav-link taps_inter" id="pills-profile-tab" data-toggle="pill" href="#Viendo" role="tab" aria-controls="pills-profile" aria-selected="false">Viendo en aula</a>'
                                $li_taps_internos+='    </li>'
                                $li_taps_internos+='    <li class="nav-item">'
                                $li_taps_internos+='        <a class="nav-link taps_inter" id="pills-contact-tab" data-toggle="pill" href="#proyectadas" role="tab" aria-controls="pills-contact" aria-selected="false">Materias proyectadas - programadas</a>'
                                $li_taps_internos+='    </li>'
                                $li_taps_internos+='    <li class="nav-item">'
                                $li_taps_internos+='        <a class="nav-link taps_inter" id="pills-contact-tab" data-toggle="pill" href="#por_ver" role="tab" aria-controls="pills-contact" aria-selected="false">Materias por ver</a>'
                                $li_taps_internos+='    </li>'
                                $li_taps_internos+='    <li class="nav-item">'
                                $li_taps_internos+='        <a class="nav-link taps_inter" id="pills-contact-tab" data-toggle="pill" href="#vistas" role="tab" aria-controls="pills-contact" aria-selected="false">Materias vistas</a>'
                                $li_taps_internos+='    </li>'
                                $li_taps_internos+='    <li class="nav-item">'
                                $li_taps_internos+='        <a class="nav-link taps_inter" id="pills-contact-tab" data-toggle="pill" href="#Historial" role="tab" aria-controls="pills-contact" aria-selected="false">Historial completo</a>'
                                $li_taps_internos+='    </li>'
                                $li_taps_internos+='</ul>'
                                $li_taps_internos+='<div class="tab-content" id="pills-tabContent">'
                                
                                $tap_malla= $('<div class="tab-pane fade show active inter" id="malla"  role="tabpanel" ><div class="card-deck"><table>');

                              
                                $tap_viendo=$('<div class="tab-pane fade inter" id="Viendo" role="tabpanel" ><div class="container"><div class="row"><table class="table table-striped" id="tabla_Viendo">')


                                $tap_proyectadas=$('<div class="tab-pane fade inter" id="proyectadas" role="tabpanel" ><div class="container"><div class="row"><table class="table table-striped" id="tabla_proyectadas">')

                                $tap_por_ver=$('<div class="tab-pane fade inter" id="por_ver" role="tabpanel" ><div class="container"><div class="row"><table class="table table-striped" id="tabla_por_ver">')

                                $tap_vistas=$('<div class="tab-pane fade inter" id="vistas" role="tabpanel" ><div class="container"><div class="row"><table class="table table-striped" id="tabla_vistas">')

                                $tap_Historial=$('<div class="tab-pane fade inter" id="Historial" role="tabpanel" ><div class="container"><div class="row"><table class="table table-striped" id="tabla_Historial">')
                                


                                
                                $tablas.append($li_taps_internos);

                                let currentSemestre = null; // Para mantener un seguimiento del semestre actual

                                // Recorre las materias y crea filas
                                $.each(materiasArray, function(index, materia) {

                                    if (materia.semestre !== currentSemestre) {
                                        // Si es un nuevo semestre, crea una nueva fila

                                        currentSemestre = materia.semestre;
                                        const $filaSemestre = 
                                            $('<tr style="display: flex;">').append(
                                            '<div class="card card_historial semestre" style="background-color: #dfc14e;color:#4a4848;margin-top: 0%;min-width: 100%;margin-right: 1%;"><div class="card-body"><h5 style="position: relative;top: 50%;transform: translateY(-50%);text-align: center;"><b>Semestre:</b><span id="semestre">'+materia.semestre);
                                              
                                        $tap_malla.append($filaSemestre);
                                    }
                                   
                                    // Agrega la materia como una columna en la fila actual
                                    var $filaMateria="";
                                        $filaMateria+='<td style="color:white;margin-right: 1%">';
                                        $filaMateria+='  <div class="card " style="background-color:transparent;border: none;width: 189px;padding: 2%;">'
                                        $filaMateria+='    <div class="card card_historial materias" style="height: 310px;">'
                                        $filaMateria+='      <div class="card-body" style="padding: 1.2rem;">'
                                        $filaMateria+='        <div class="" style=" display: flex;color: black;">'
                                        $filaMateria+='          <span class="'+materia.color+'" style="border-bottom: 2px solid;border-top: 2px solid;border-left:2px solid;border-top-left-radius: 30px;border-bottom-left-radius: 28px;min-width: 27px;height: 42px;">&nbsp;&nbsp;&nbsp;<br><br>'
                                        $filaMateria+='          </span>'
                                        $filaMateria+='          <h6 class="card-title" style="border-top: 2px solid;border-bottom: 2px solid;border-right: 2px solid;border-bottom-right-radius: 30px;border-top-right-radius: 30px;margin-left: 4px;height: 42px;width: 100%;">'
                                        $filaMateria+='            <b>Codigo:</b>'
                                        $filaMateria+='            <br>'
                                        $filaMateria+='            <span>'+materia.codigo_materia+'</span>'
                                        $filaMateria+='          </h6>'
                                        $filaMateria+='        </div>'
                                        $filaMateria+='        <p class="card-text" id="" style="text-align: center;color: black;">'
                                        $filaMateria+='          <span>'+materia.nombre_materia+'</span>'
                                        $filaMateria+='        </p>'
                                        $filaMateria+='        <p class="card-text" id="" style="text-align: center;color: black;">'
                                        $filaMateria+='          <span>'
                                        $filaMateria+='            <b>Calificación:</b> '+materia.calificacion+'</span> <br><b>Créditos:</b> '+materia.creditos+' </span>'
                                        $filaMateria+='        </p>'
        




                                    $tap_malla.append($filaMateria);
                                });
                                $tablas.append($tap_malla);
                                $tablas.append($tap_viendo);
                                $tablas.append($tap_proyectadas);
                                $tablas.append($tap_por_ver);
                                $tablas.append($tap_vistas);
                                $tablas.append($tap_Historial);

                                
console.log(data.historial)

                            


                                new DataTable('#tabla_proyectadas', {
                                    columns: [
                                        { title: 'Name' },
                                        { title: 'Position' },
                                        { title: 'Office' },
                                        { title: 'Extn.' },
                                        { title: 'Start date' },
                                        { title: 'Salary' }
                                    ],
                                    data: data.historial
                                });

                                new DataTable('#tabla_por_ver', {
                                    columns: [
                                        { title: 'Name' },
                                        { title: 'Position' },
                                        { title: 'Office' },
                                        { title: 'Extn.' },
                                        { title: 'Start date' },
                                        { title: 'Salary' }
                                    ],
                                    data: data.historial
                                });

                                new DataTable('#tabla_vistas', {
                                    columns: [
                                        { title: 'Name' },
                                        { title: 'Position' },
                                        { title: 'Office' },
                                        { title: 'Extn.' },
                                        { title: 'Start date' },
                                        { title: 'Salary' }
                                    ],
                                    data: data.historial
                                });

                                new DataTable('#tabla_Historial', {
                                    columns: [
                                        { title: 'Name' },
                                        { title: 'Position' },
                                        { title: 'Office' },
                                        { title: 'Extn.' },
                                        { title: 'Start date' },
                                        { title: 'Salary' }
                                    ],
                                    data: data.historial
                                });

                        

                                $(document).find(tap).append($tablas);

                              
                            
                        }
                        if(data.info=="sin_datos"){

                            const $tablas = $('<div class="container "><div class="row"> <table>');

                            const $filaMateria = $('<td>')
                                        .text('En estos momentos no contamos Con información contacta con soporte');
                                    $tablas.children('tr:last').append($filaMateria);
                                  
                                   
                        }
                    }
                });
            });



            $(document).on('click','.taps_inter',function(){
                const dataSet = [
    ['Tiger Nixon', 'System Architect', 'Edinburgh', '5421', '2011/04/25', '$320,800'],
    ['Garrett Winters', 'Accountant', 'Tokyo', '8422', '2011/07/25', '$170,750']]
               $(document).find('.inter').removeClass('active')
               $(document).find('.inter').removeClass('show')
                $id=$(this).attr('href');

                console.log( $(document).find($id))
                $(document).find($id).addClass('active');
                $(document).find($id).addClass('show');
                alert( $id);
                $tabla=$(document).find($id).dataTables();
                new DataTable($tabla, {
                                    columns: [
                                        { title: 'Name' },
                                        { title: 'Position' },
                                        { title: 'Office' },
                                        { title: 'Extn.' },
                                        { title: 'Start date' },
                                        { title: 'Salary' }
                                    ],
                                   data: dataSet
                                });


            })

            
            

        })


        function consultarEstudiante() {
            codBanner = $('#codigo');
            if (codBanner.val() != '') {
                $("#info_1").removeClass('hidden')
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
                    $('.contenedor_interno').removeClass('hidden');
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
                        .attr('id', 'tab_li' + index)
                        .text(tab.programa); // Suponiendo que cada objeto tiene una propiedad 'title'

                        // Agregar la pestaña a la lista de pestañas
                        $('#myTabs').append($('<li>').append(tabLink));

                 

                        // Crear el contenido de la pestaña
                        var tabContent = $('<div>')
                        .addClass('tab-pane fade taps_programas ')
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
                    window.setTimeout(function(){
                        elemto = $(document).find('#tab_li0')
                        elemto.addClass("active")
                    
                        $(document).find("#tab0").addClass('active show');
                     
                        elemto.click();
                    },700);
               
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

