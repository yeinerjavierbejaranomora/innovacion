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
                                                <div class="checkbox-wrapper-26">
                                                    <input type="checkbox" id="_checkbox-26">
                                                    <label for="_checkbox-26">
                                                      <div class="tick_mark"></div>
                                                    </label>
                                                  </div>
                                                  
                                                  <style>
                                                    .checkbox-wrapper-26 * {
                                                      -webkit-tap-highlight-color: transparent;
                                                      outline: none;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 input[type="checkbox"] {
                                                      display: none;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 label {
                                                      --size: 50px;
                                                      --shadow: calc(var(--size) * .07) calc(var(--size) * .1);
                                                  
                                                      position: relative;
                                                      display: block;
                                                      width: var(--size);
                                                      height: var(--size);
                                                      margin: 0 auto;
                                                      background-color: #f72414;
                                                      border-radius: 50%;
                                                      box-shadow: 0 var(--shadow) #ffbeb8;
                                                      cursor: pointer;
                                                      transition: 0.2s ease transform, 0.2s ease background-color,
                                                        0.2s ease box-shadow;
                                                      overflow: hidden;
                                                      z-index: 1;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 label:before {
                                                      content: "";
                                                      position: absolute;
                                                      top: 50%;
                                                      right: 0;
                                                      left: 0;
                                                      width: calc(var(--size) * .7);
                                                      height: calc(var(--size) * .7);
                                                      margin: 0 auto;
                                                      background-color: #fff;
                                                      transform: translateY(-50%);
                                                      border-radius: 50%;
                                                      box-shadow: inset 0 var(--shadow) #ffbeb8;
                                                      transition: 0.2s ease width, 0.2s ease height;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 label:hover:before {
                                                      width: calc(var(--size) * .55);
                                                      height: calc(var(--size) * .55);
                                                      box-shadow: inset 0 var(--shadow) #ff9d96;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 label:active {
                                                      transform: scale(0.9);
                                                    }
                                                  
                                                    .checkbox-wrapper-26 .tick_mark {
                                                      position: absolute;
                                                      top: -1px;
                                                      right: 0;
                                                      left: calc(var(--size) * -.05);
                                                      width: calc(var(--size) * .6);
                                                      height: calc(var(--size) * .6);
                                                      margin: 0 auto;
                                                      margin-left: calc(var(--size) * .14);
                                                      transform: rotateZ(-40deg);
                                                    }
                                                  
                                                    .checkbox-wrapper-26 .tick_mark:before,
                                                    .checkbox-wrapper-26 .tick_mark:after {
                                                      content: "";
                                                      position: absolute;
                                                      background-color: #fff;
                                                      border-radius: 2px;
                                                      opacity: 0;
                                                      transition: 0.2s ease transform, 0.2s ease opacity;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 .tick_mark:before {
                                                      left: 0;
                                                      bottom: 0;
                                                      width: calc(var(--size) * .1);
                                                      height: calc(var(--size) * .3);
                                                      box-shadow: -2px 0 5px rgba(0, 0, 0, 0.23);
                                                      transform: translateY(calc(var(--size) * -.68));
                                                    }
                                                  
                                                    .checkbox-wrapper-26 .tick_mark:after {
                                                      left: 0;
                                                      bottom: 0;
                                                      width: 100%;
                                                      height: calc(var(--size) * .1);
                                                      box-shadow: 0 3px 5px rgba(0, 0, 0, 0.23);
                                                      transform: translateX(calc(var(--size) * .78));
                                                    }
                                                  
                                                    .checkbox-wrapper-26 input[type="checkbox"]:checked + label {
                                                      background-color: #07d410;
                                                      box-shadow: 0 var(--shadow) #92ff97;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 input[type="checkbox"]:checked + label:before {
                                                      width: 0;
                                                      height: 0;
                                                    }
                                                  
                                                    .checkbox-wrapper-26 input[type="checkbox"]:checked + label .tick_mark:before,
                                                    .checkbox-wrapper-26 input[type="checkbox"]:checked + label .tick_mark:after {
                                                      transform: translate(0);
                                                      opacity: 1;
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

