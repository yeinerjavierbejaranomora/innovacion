<!-- incluimos el header para el html -->
@include('layout.header')

<!-- incluimos el menu -->
@include('menus.menu_admin')
<style>
    .checkbox-wrapper-46 input[type="checkbox"] {
      display: none;
      visibility: hidden;
    }

    .checkbox-wrapper-46 .cbx {
      margin: auto;
      -webkit-user-select: none;
      user-select: none;
      cursor: pointer;
    }
    .checkbox-wrapper-46 .cbx span {
      display: inline-block;
      vertical-align: middle;
      transform: translate3d(0, 0, 0);
    }
    .checkbox-wrapper-46 .cbx span:first-child {
      position: relative;
      width: 18px;
      height: 18px;
      border-radius: 3px;
      transform: scale(1);
      vertical-align: middle;
      border: 1px solid #9098A9;
      transition: all 0.2s ease;
    }
    .checkbox-wrapper-46 .cbx span:first-child svg {
      position: absolute;
      top: 3px;
      left: 2px;
      fill: none;
      stroke: #FFFFFF;
      stroke-width: 2;
      stroke-linecap: round;
      stroke-linejoin: round;
      stroke-dasharray: 16px;
      stroke-dashoffset: 16px;
      transition: all 0.3s ease;
      transition-delay: 0.1s;
      transform: translate3d(0, 0, 0);
    }
    .checkbox-wrapper-46 .cbx span:first-child:before {
      content: "";
      width: 100%;
      height: 100%;
      background: #f6c23e;
      display: block;
      transform: scale(0);
      opacity: 1;
      border-radius: 50%;
    }
    .checkbox-wrapper-46 .cbx span:last-child {
      padding-left: 8px;
    }
    .checkbox-wrapper-46 .cbx:hover span:first-child {
      border-color: #f6c23e;
    }

    .checkbox-wrapper-46 .inp-cbx:checked + .cbx span:first-child {
      background: #f6c23e;
      border-color: #f6c23e;
      animation: wave-46 0.4s ease;
    }
    .checkbox-wrapper-46 .inp-cbx:checked + .cbx span:first-child svg {
      stroke-dashoffset: 0;
    }
    .checkbox-wrapper-46 .inp-cbx:checked + .cbx span:first-child:before {
      transform: scale(3.5);
      opacity: 0;
      transition: all 0.6s ease;
    }

    @keyframes wave-46 {
      50% {
        transform: scale(0.9);
      }
    }
  </style>
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
                                                <div class="checkbox-wrapper-46">
                                                    <input class="inp-cbx" id="cbx-46" type="checkbox" />
                                                    <label class="cbx" for="cbx-46"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>202313</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox-wrapper-46">
                                                    <input class="inp-cbx" id="cbx-47" type="checkbox" />
                                                    <label class="cbx" for="cbx-47"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>202316</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 text-center">
                                            <h5 id="tituloNiveles"><strong>Pregrado Semestral</strong></h5>
                                            <div class="card-body periodos" style="width:100%;" id="Continua">
                                                <div class="checkbox-wrapper-46">
                                                    <input class="inp-cbx" id="cbx-48" type="checkbox" />
                                                    <label class="cbx" for="cbx-48"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>202333</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox-wrapper-46">
                                                    <input class="inp-cbx" id="cbx-49" type="checkbox" />
                                                    <label class="cbx" for="cbx-49"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>202334</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 text-center">
                                            <h5 id="tituloNiveles"><strong>Especializacion</strong></h5>
                                            <div class="card-body periodos" style="width:100%;" id="Continua">
                                                <div class="checkbox-wrapper-46">
                                                    <input class="inp-cbx" id="cbx-45" type="checkbox" />
                                                    <label class="cbx" for="cbx-45"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>202343</span>
                                                    </label>
                                                </div>
                                                <div class="checkbox-wrapper-46">
                                                    <input class="inp-cbx" id="cbx-44" type="checkbox" />
                                                    <label class="cbx" for="cbx-44"><span>
                                                            <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </svg></span><span>202344</span>
                                                    </label>
                                                </div>
                                            </div>
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

