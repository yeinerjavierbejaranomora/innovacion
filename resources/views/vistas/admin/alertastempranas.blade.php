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
                {{-- <h1 class="h3 mb-0 text-gray-800">Malla curricular del programa {{$nombre}}</h1> --}}
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="text-center col-12 align-items-center">
                                        <h5 id="tituloNiveles"><strong>Periodos Activos</strong></h5>
                                    </div>
                                    <div class="row d-sm-flex align-items-center justify-content-between mb-4">
                                        {{-- <div class="col-xl-2 text-center">
                                            <h5 id="tituloNiveles"><strong>F.Continua</strong></h5>
                                        </div> --}}
                                        <div class="col-xl-2 text-center">
                                            <h5 id="tituloNiveles"><strong>Pregrado Cuatrimestral</strong></h5>
                                            <div class="card-body periodos" style="width:100%;" id="Continua">
                                                <div class="checkbox-wrapper-29">
                                                    <label class="checkbox">
                                                      <input type="checkbox" class="checkbox__input" />  
                                                      <span class="checkbox__label"></span>
                                                      Checkbox
                                                    </label>
                                                  </div>
                                                  
                                                  <style>
                                                    .checkbox-wrapper-29 {
                                                      --size: 1rem;
                                                      --background: #fff;
                                                      font-size: var(--size);
                                                    }
                                                  
                                                    .checkbox-wrapper-29 *,
                                                    .checkbox-wrapper-29 *::after,
                                                    .checkbox-wrapper-29 *::before {
                                                      box-sizing: border-box;
                                                    }
                                                  
                                                    .checkbox-wrapper-29 input[type="checkbox"] {
                                                      visibility: hidden;
                                                      display: none;
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox__label {
                                                      width: var(--size);
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox__label:before {
                                                      content: ' ';
                                                      display: block;
                                                      height: var(--size);
                                                      width: var(--size);
                                                      position: absolute;
                                                      top: calc(var(--size) * 0.125);
                                                      left: 0;
                                                      background: var(--background);  
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox__label:after {
                                                      content: ' ';
                                                      display: block;
                                                      height: var(--size);
                                                      width: var(--size);
                                                      border: calc(var(--size) * .14) solid #000;
                                                      transition: 200ms;
                                                      position: absolute;
                                                      top: calc(var(--size) * 0.125);
                                                      left: 0;
                                                      background: var(--background);  
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox__label:after {
                                                      transition: 100ms ease-in-out;
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox__input:checked ~ .checkbox__label:after {
                                                      border-top-style: none; 
                                                      border-right-style: none;
                                                      -ms-transform: rotate(-45deg); /* IE9 */
                                                      transform: rotate(-45deg);
                                                      height: calc(var(--size) * .5);
                                                      border-color: green;
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox {
                                                      position: relative;
                                                      display: flex;
                                                      cursor: pointer;
                                                      /* Mobile Safari: */
                                                      -webkit-tap-highlight-color: rgba(0,0,0,0);   
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox__label:after:hover,
                                                    .checkbox-wrapper-29 .checkbox__label:after:active {
                                                       border-color: green; 
                                                    }
                                                  
                                                    .checkbox-wrapper-29 .checkbox__label {
                                                      margin-right: calc(var(--size) * 0.45);
                                                    }
                                                  </style>
                                                  
                                            </div>
                                        </div>
                                        <div class="col-xl-2 text-center">
                                            <h5 id="tituloNiveles"><strong>Pregrado Semestral</strong></h5>
                                        </div>
                                        <div class="col-xl-2 text-center">
                                            <h5 id="tituloNiveles"><strong>Especializacion</strong></h5>
                                        </div>
                                        {{-- <div class="col-xl-2 text-center">
                                            <h5 id="tituloNiveles"><strong>Maestria</strong></h5>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <!--Datatable-->
                            <div class="table">
                                <table id="example" class="display" style="width:100%">
                                </table>
                            </div>
                        </div>
                        <br>
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

{{-- <script>
    // * Datatable para mostrar los programas de la Facultad *
    var xmlhttp = new XMLHttpRequest();
    var url = "{{ route('facultad.getmalla', ['codigo'=>$codigo]) }}";
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            var table = $('#example').DataTable({
                "data": data.data,
                "order": [[1,'asc'],[3,'asc']],
                "columns": [{
                        data: 'codprograma', "visible": false,
                        title: 'Codigo de programa'
                    },
                    {
                        data: 'semestre',
                        title: 'Semestre'
                    },
                    {
                        data: 'ciclo',
                        title: 'Ciclo'
                    },
                    {
                        data: 'orden',
                        title: 'Orden'
                    },
                    {
                        data: 'curso',
                        title: 'Curso'
                    },
                    {
                        data: 'codigoCurso',
                        title: 'Codigo curso'
                    },
                    {
                        data: 'creditos',
                        title: 'Numero de créditos'
                    },
                    {
                        data: 'prerequisito',
                        title: 'Pre-requisitos'
                    },
                    {
                        defaultContent: "<button type='button' class='editar btn btn-secondary' data-toggle='modal' data-target='#editar_facultad' data-whatever='modal'><i class='fa-solid fa-pen-to-square'></i></button>",
                        title: 'Editar',
                        className: "text-center"
                    },
                    {
                        defaultContent: "<button type='button' class='eliminar btn btn-danger'><i class='fa-regular fa-square-minus'></i></button>",
                        title: 'Eliminar',
                        className: "text-center"
                    },
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            });
        }
    }

</script> --}}

@include('layout.footer')

