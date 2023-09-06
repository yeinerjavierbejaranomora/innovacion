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
                                                <div class="checkbox-wrapper-21">
                                                    <label class="control control--checkbox">
                                                      Checkbox
                                                      <input type="checkbox" />
                                                      <div class="control__indicator"></div>
                                                    </label>
                                                  </div>
                                                  
                                                  <style>
                                                    .checkbox-wrapper-21 .control {
                                                      display: block;
                                                      position: relative;
                                                      padding-left: 30px;
                                                      cursor: pointer;
                                                      font-size: 18px;
                                                    }
                                                    .checkbox-wrapper-21 .control input {
                                                      position: absolute;
                                                      z-index: -1;
                                                      opacity: 0;
                                                    }
                                                    .checkbox-wrapper-21 .control__indicator {
                                                      position: absolute;
                                                      top: 2px;
                                                      left: 0;
                                                      height: 20px;
                                                      width: 20px;
                                                      background: #e6e6e6;
                                                    }
                                                    .checkbox-wrapper-21 .control:hover input ~ .control__indicator,
                                                    .checkbox-wrapper-21 .control input:focus ~ .control__indicator {
                                                      background: #ccc;
                                                    }
                                                    .checkbox-wrapper-21 .control input:checked ~ .control__indicator {
                                                      background: #2aa1c0;
                                                    }
                                                    .checkbox-wrapper-21 .control:hover input:not([disabled]):checked ~ .control__indicator,
                                                    .checkbox-wrapper-21 .control input:checked:focus ~ .control__indicator {
                                                      background: #0e647d;
                                                    }
                                                    .checkbox-wrapper-21 .control input:disabled ~ .control__indicator {
                                                      background: #e6e6e6;
                                                      opacity: 0.6;
                                                      pointer-events: none;
                                                    }
                                                    .checkbox-wrapper-21 .control__indicator:after {
                                                      content: '';
                                                      position: absolute;
                                                      display: none;
                                                    }
                                                    .checkbox-wrapper-21 .control input:checked ~ .control__indicator:after {
                                                      display: block;
                                                    }
                                                    .checkbox-wrapper-21 .control--checkbox .control__indicator:after {
                                                      left: 8px;
                                                      top: 4px;
                                                      width: 3px;
                                                      height: 8px;
                                                      border: solid #fff;
                                                      border-width: 0 2px 2px 0;
                                                      transform: rotate(45deg);
                                                    }
                                                    .checkbox-wrapper-21 .control--checkbox input:disabled ~ .control__indicator:after {
                                                      border-color: #7b7b7b;
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

