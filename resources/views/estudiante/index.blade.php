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

            <div class="container-fluid">
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

    </div>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
     
          
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
            </tr>
        </tfoot>
    </table>

    <div class="col-md-12">
            
            <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="pill" id="Malla_li_1" href="#Malla_1" role="tab" aria-controls="pills-home" aria-selected="true">Malla</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="pill" id="programadas_li_1" href="#programadas_1" role="tab" aria-controls="pills-home" aria-selected="true">Materias en Aula</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="pill" id="programadas_li_1" href="#programadas_1" role="tab" aria-controls="pills-home" aria-selected="true">Materias planeadas - proyectdas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" id="por_ver_li_1" href="#por_ver_1" role="tab" aria-controls="pills-profile" aria-selected="false">Materias por ver</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" id="vistas_li_1" href="#vistas_1" role="tab" aria-controls="pills-contact" aria-selected="false">Materias vistas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" id="completo_li_1" href="#completo_1" role="tab" aria-controls="pills-contact" aria-selected="false">Historial completo</a>
                </li>
            </ul>
            
            <div class="tab-content">

                <div class="tab-pane fade active show " id="Malla_1" role="tabpanel" aria-labelledby="pills-home-tab">
                   
                    <table id="tabla_1" class="table table-striped table-bordered" style="width:100%">
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade  " id="programadas_1" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="materias_programadas_1_wrapper" class="dataTables_wrapper">
                        <div class="dataTables_length" id="materias_programadas_1_length">
                           
                            <thead>
                                <tr style="background-color: #ffb700;">
                                    <th style="width: 10%!important;" class="sorting" tabindex="0" aria-controls="materias_programadas_1" rowspan="1" colspan="1" aria-label="codMateria: Activar para ordenar la columna de manera ascendente">codMateria</th>
                                    <th style="width: 80%!important;" class="sorting" tabindex="0" aria-controls="materias_programadas_1" rowspan="1" colspan="1" aria-label="Materias: Activar para ordenar la columna de manera ascendente">Materias</th>
                                    <th style="width: 10%!important;" class="text-center sorting sorting_asc" tabindex="0" aria-controls="materias_programadas_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Semestre: Activar para ordenar la columna de manera descendente">Semestre</th>
                                    <th style="width: 10%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_programadas_1" rowspan="1" colspan="1" aria-label="Ciclo: Activar para ordenar la columna de manera ascendente">Ciclo</th>
                                    <th style="width: 10%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_programadas_1" rowspan="1" colspan="1" aria-label="Creditos: Activar para ordenar la columna de manera ascendente">Creditos</th></tr>
                            </thead>
                            <tbody>
                                
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right" class="text-center" rowspan="1">Total creditos programados:</th>
                                    <th id="total_materias_programadas_1" class="text-center" rowspan="1" colspan="1"> 9</th>
                                </tr>
                            </tfoot>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="por_ver_1" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div id="materias_por_ver_1_wrapper" class="dataTables_wrapper">
                        <div class="dataTables_length" id="materias_por_ver_1_length">

                        <thead>
                            <tr style="background-color: #ffb700;">
                                <th style="width: 5%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_por_ver_1" rowspan="1" colspan="1" aria-label="codMateria: Activar para ordenar la columna de manera ascendente">codMateria</th>
                                <th style="width: 50%!important;" class="sorting" tabindex="0" aria-controls="materias_por_ver_1" rowspan="1" colspan="1" aria-label="Materias: Activar para ordenar la columna de manera ascendente">Materias</th>
                                <th style="width: 5%!important;" class="text-center sorting sorting_asc" tabindex="0" aria-controls="materias_por_ver_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Semestre: Activar para ordenar la columna de manera descendente">Semestre</th>
                                <th style="width: 5%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_por_ver_1" rowspan="1" colspan="1" aria-label="Ciclo: Activar para ordenar la columna de manera ascendente">Ciclo</th>
                                <th style="width: 5%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_por_ver_1" rowspan="1" colspan="1" aria-label="Creditos: Activar para ordenar la columna de manera ascendente">Creditos</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                     
                        <tfoot>
                            <tr><th colspan="4" style="text-align:right" class="text-center" rowspan="1">Total creditos por ver:</th><th id="total_por_ver_1" class="text-center" rowspan="1" colspan="1"> 6</th></tr>
                        </tfoot>
                        
                    </table>
                    
                </div>
                </div>
                <div class="tab-pane fade" id="vistas_1" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div id="materias_vistas_1_wrapper" class="dataTables_wrapper"><div class="dataTables_length" id="materias_vistas_1_length"><label>Mostrar <select name="materias_vistas_1_length" aria-controls="materias_vistas_1" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> registros</label></div><div id="materias_vistas_1_filter" class="dataTables_filter"><label>Buscar:<input type="search" class="" placeholder="" aria-controls="materias_vistas_1"></label></div><table id="materias_vistas_1" class="table table-striped table-bordered dataTable" style="width: 100%;" aria-describedby="materias_vistas_1_info">
                        <thead>
                            <tr style="background-color: #ffb700;"><th style="width: 3%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_vistas_1" rowspan="1" colspan="1" aria-label="codMateria: Activar para ordenar la columna de manera ascendente">codMateria</th><th style="width: 50%!important;" class="sorting" tabindex="0" aria-controls="materias_vistas_1" rowspan="1" colspan="1" aria-label="Materias: Activar para ordenar la columna de manera ascendente">Materias</th><th style="width: 3%!important;" class="text-center sorting sorting_asc" tabindex="0" aria-controls="materias_vistas_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Semestre: Activar para ordenar la columna de manera descendente">Semestre</th><th style="width: 3%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_vistas_1" rowspan="1" colspan="1" aria-label="Ciclo: Activar para ordenar la columna de manera ascendente">Ciclo</th><th style="width: 3%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_vistas_1" rowspan="1" colspan="1" aria-label="Creditos: Activar para ordenar la columna de manera ascendente">Creditos</th><th style="width: 3%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_vistas_1" rowspan="1" colspan="1" aria-label="Nota: Activar para ordenar la columna de manera ascendente">Nota</th></tr>
                        </thead>
                        <tbody>
                        
                        <tr class="odd"><td class="  text-center">TRSP22100</td><td>Electiva integral-BUEN VIVIR CAMINO HACIA EL DESARROLLO SOSTENIBLE</td><td class="text-center sorting_1">1</td><td class="  text-center">1</td><td class="  text-center">2</td><td class="  text-center">4,70</td></tr><tr class="even"><td class="  text-center">ABV32100</td><td>GESTIÓN DE CONOCIMIENTO Y BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">1</td><td class="  text-center">3</td><td class="  text-center">4,30</td></tr><tr class="odd"><td class="  text-center">TFI32100</td><td>COMPETENCIAS Y PROCESOS INVESTIGATIVOS</td><td class="text-center sorting_1">1</td><td class="  text-center">12</td><td class="  text-center">2</td><td class="  text-center">4,20</td></tr><tr class="even"><td class="  text-center">ABV32110</td><td>COMPUTACIÓN EN LA NUBE PARA BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">2</td><td class="  text-center">3</td><td class="  text-center">4,50</td></tr><tr class="odd"><td class="  text-center">ABV32120</td><td>COMPUTACIÓN DE ALTO DESEMPEÑO PARA BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">2</td><td class="  text-center">3</td><td class="  text-center">4,30</td></tr><tr class="even"><td class="  text-center">ABV32130</td><td>COMPUTACIÓN COGNITIVA PARA BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">2</td><td class="  text-center">3</td><td class="  text-center">4,90</td></tr></tbody>

                        <tfoot>
                            <tr><th colspan="4" style="text-align:right" class="text-center" rowspan="1">Total creditos Vistos:</th><th id="total_materias_vistas_1" class="text-center" rowspan="1" colspan="1"> 16</th></tr>
                            
                        </tfoot>
                        
                    </table><div class="dataTables_info" id="materias_vistas_1_info" role="status" aria-live="polite">Mostrando registros del 1 al 6 de un total de 6 registros</div><div class="dataTables_paginate paging_simple_numbers" id="materias_vistas_1_paginate"><a class="paginate_button previous disabled" aria-controls="materias_vistas_1" data-dt-idx="0" tabindex="-1" id="materias_vistas_1_previous">Anterior</a><span><a class="paginate_button current" aria-controls="materias_vistas_1" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="materias_vistas_1" data-dt-idx="2" tabindex="-1" id="materias_vistas_1_next">Siguiente</a></div></div>
                </div>
                <div class="tab-pane fade" id="completo_1" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div id="materias_1_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="materias_1_length"><label>Mostrar <select name="materias_1_length" aria-controls="materias_1" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> registros</label></div><div class="dt-buttons">          <button class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="materias_1" type="button"><span>Excel</span></button> <button class="dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="materias_1" type="button"><span>CSV</span></button> <button class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="materias_1" type="button"><span>PDF</span></button> <button class="dt-button buttons-print" tabindex="0" aria-controls="materias_1" type="button"><span>Print</span></button> <button class="dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="materias_1" type="button"><span>Copy</span></button> </div><div id="materias_1_filter" class="dataTables_filter"><label>Buscar:<input type="search" class="" placeholder="" aria-controls="materias_1"></label></div><table id="materias_1" class="table table-striped table-bordered dataTable no-footer" style="width: 100%;" aria-describedby="materias_1_info">
                        <thead>
                            <tr style="background-color: #ffb700;"><th style="width: 10%!important;" class="sorting" tabindex="0" aria-controls="materias_1" rowspan="1" colspan="1" aria-label="codMateria: Activar para ordenar la columna de manera ascendente">codMateria</th><th style="width: 80%!important;" class="sorting" tabindex="0" aria-controls="materias_1" rowspan="1" colspan="1" aria-label="Materias: Activar para ordenar la columna de manera ascendente">Materias</th><th style="width: 10%!important;" class="text-center sorting sorting_asc" tabindex="0" aria-controls="materias_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Semestre: Activar para ordenar la columna de manera descendente">Semestre</th><th style="width: 3%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_1" rowspan="1" colspan="1" aria-label="Ciclo: Activar para ordenar la columna de manera ascendente">Ciclo</th><th style="width: 10%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_1" rowspan="1" colspan="1" aria-label="Cursada: Activar para ordenar la columna de manera ascendente">Cursada</th><th style="width: 10%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_1" rowspan="1" colspan="1" aria-label="Materia Por ver: Activar para ordenar la columna de manera ascendente">Materia Por ver</th><th style="width: 10%!important;" class="text-center sorting" tabindex="0" aria-controls="materias_1" rowspan="1" colspan="1" aria-label="Programada en periodo actual: Activar para ordenar la columna de manera ascendente">Programada en periodo actual</th></tr>
                        </thead>
                        <tbody>
                    
                        <tr class="odd"><td>TRSP22100</td><td>Electiva integral-BUEN VIVIR CAMINO HACIA EL DESARROLLO SOSTENIBLE</td><td class="text-center sorting_1">1</td><td class="  text-center">1</td><td class="  text-center">4,70</td><td class="  text-center"></td><td class="  text-center"></td></tr><tr class="even"><td>ABV32100</td><td>GESTIÓN DE CONOCIMIENTO Y BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">1</td><td class="  text-center">4,30</td><td class="  text-center"></td><td class="  text-center"></td></tr><tr class="odd"><td>TFI32100</td><td>COMPETENCIAS Y PROCESOS INVESTIGATIVOS</td><td class="text-center sorting_1">1</td><td class="  text-center">12</td><td class="  text-center">4,20</td><td class="  text-center"></td><td class="  text-center"></td></tr><tr class="even"><td>ABV32110</td><td>COMPUTACIÓN EN LA NUBE PARA BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">2</td><td class="  text-center">4,50</td><td class="  text-center"></td><td class="  text-center"></td></tr><tr class="odd"><td>ABV32120</td><td>COMPUTACIÓN DE ALTO DESEMPEÑO PARA BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">2</td><td class="  text-center">4,30</td><td class="  text-center"></td><td class="  text-center"></td></tr><tr class="even"><td>ABV32130</td><td>COMPUTACIÓN COGNITIVA PARA BIG DATA</td><td class="text-center sorting_1">1</td><td class="  text-center">2</td><td class="  text-center">4,90</td><td class="  text-center"></td><td class="  text-center"></td></tr><tr class="odd"><td>ABV32190</td><td>ALGORITMOS Y VISUALIZACIÓN DE DATOS</td><td class="text-center sorting_1">2</td><td class="  text-center">2</td><td class="  text-center"></td><td class="  text-center"></td><td class="  text-center">Programada</td></tr><tr class="even"><td>ABV32180</td><td>PARADIGMAS PARA EL ALMACENAMIENTO Y PROCESAMIENTO DE BIG DATA</td><td class="text-center sorting_1">2</td><td class="  text-center">1</td><td class="  text-center"></td><td class="  text-center">Pendiente</td><td class="  text-center"></td></tr><tr class="odd"><td>ABV32160</td><td>OPCIÓN DE GRADO</td><td class="text-center sorting_1">2</td><td class="  text-center">12</td><td class="  text-center"></td><td class="  text-center"></td><td class="  text-center">Programada</td></tr><tr class="even"><td>ABV32170</td><td>MÉTODOS ESTADÍSTICOS Y ALGORITMOS PARA EL ANÁLISIS DE DATOS</td><td class="text-center sorting_1">2</td><td class="  text-center">1</td><td class="  text-center"></td><td class="  text-center">Pendiente</td><td class="  text-center"></td></tr><tr class="odd"><td>ABV32140</td><td>ELEC PROF: ADQUISICIÓN DE DATOS DAQ OR DAS IOT</td><td class="text-center sorting_1">2</td><td class="  text-center">2</td><td class="  text-center"></td><td class="  text-center"></td><td class="  text-center">Programada</td></tr><tr class="even"><td>ABV32150</td><td>ELEC PROF: CIENCIA DE DATOS PARA LA TOMA DE DECISIONES ESTRATÉGICAS</td><td class="text-center sorting_1">2</td><td class="  text-center">2</td><td class="  text-center"></td><td class="  text-center"></td><td class="  text-center">Programada</td></tr></tbody>
                        
                    </table><div class="dataTables_info" id="materias_1_info" role="status" aria-live="polite">Mostrando registros del 1 al 12 de un total de 12 registros</div><div class="dataTables_paginate paging_simple_numbers" id="materias_1_paginate"><a class="paginate_button previous disabled" aria-controls="materias_1" data-dt-idx="0" tabindex="-1" id="materias_1_previous">Anterior</a><span><a class="paginate_button current" aria-controls="materias_1" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="materias_1" data-dt-idx="2" tabindex="-1" id="materias_1_next">Siguiente</a></div></div>
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
                                                $('<th>').text(`Semestre ${currentSemestre}`)
                                                .attr('colspan', 4)
                                                );
                                        $tablas.append($filaSemestre);
                                    }

                                    // Agrega la materia como una columna en la fila actual
                                    const $filaMateria = $('<td style="color:white">')
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

