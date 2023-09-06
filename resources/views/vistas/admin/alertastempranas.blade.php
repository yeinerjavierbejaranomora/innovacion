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
                                                <div class="checkbox-wrapper-49">
                                                    <div class="block">
                                                      <input data-index="0" id="cheap-49" type="checkbox" />
                                                      <label for="cheap-49"></label>
                                                    </div>
                                                  </div>

                                                  <style>
                                                    .checkbox-wrapper-49 input[type="checkbox"] {
                                                      display: none;
                                                      visibility: hidden;
                                                    }

                                                    .checkbox-wrapper-49 {
                                                      --size: 40px;
                                                    }

                                                    .checkbox-wrapper-49 .block {
                                                      position: relative;
                                                      clear: both;
                                                      float: left;
                                                    }

                                                    .checkbox-wrapper-49 label {
                                                      width: var(--size);
                                                      height: calc(var(--size) / 2);
                                                      box-sizing: border-box;
                                                      border: 3px solid;
                                                      float: left;
                                                      border-radius: 100px;
                                                      position: relative;
                                                      cursor: pointer;
                                                      transition: .3s ease;
                                                      color: black;
                                                    }
                                                    .checkbox-wrapper-49 input[type=checkbox]:checked + label {
                                                      background: #f6c23e;
                                                    }
                                                    .checkbox-wrapper-49 input[type=checkbox]:checked + label:before {
                                                      left: calc(var(--size) / 2);
                                                    }
                                                    .checkbox-wrapper-49 label:before {
                                                      transition: .3s ease;
                                                      content: '';
                                                      width: calc((var(--size) / 2) - 10px);
                                                      height: calc((var(--size) / 2) - 10px);
                                                      position: absolute;
                                                      background: white;
                                                      left: 2px;
                                                      top: 2px;
                                                      box-sizing: border-box;
                                                      border: 3px solid;
                                                      color: black;
                                                      border-radius: 100px;
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

