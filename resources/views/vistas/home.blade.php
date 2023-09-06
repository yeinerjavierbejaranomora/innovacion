@include('layout.header')

@auth
@switch(auth()->user()->id_rol)
@case (1)
@include('menus.menu_Decano')
@break;
@case (2)
@include('menus.menu_Director')
@break;
@case (3)
@include('menus.menu_Coordinador')
@break;
@case (4)
@include('menus.menu_Lider')
@break;
@case (5)
@include('menus.menu_Docente')
@break;
@case (6)
@include('menus.menu_Estudiante')
@break;
@case (9)
@include('menus.menu_admin')
@break;
@case (19)
@include('menus.menu_rector')
@break;
@case (20)
@include('menus.menu_Vicerrector')
@break;
@endswitch
@endauth

<style>
    .boton {
        background-color: #dfc14e;
        border-color: #dfc14e;
        color: white;
        width: 230px;
        height: 50px;
        border-radius: 10px;
        font-weight: 600;
        place-items: center;
        font-size: 25px;
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

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="text-center mb-3">
                <h2><strong>Módulos disponibles</strong></h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h4><strong>Admisiones</strong></h4>
                        </div>
                        <div class="card-body">
                            <img class="card-img-center mb-2" src="/public/assets/images/Banner.jpeg" alt="Card image cap" style="width: 100%;">
                            <p>Este módulo corresponde a la información obtenida directamente desde Banner, aquí podrás
                                encontrar un resumen de los datos obtenidos allí y filtrarlos según lo necesites, cabe recalcar
                                que la información mostrada cuenta con 1 día de retraso puesto que es actualizada diariamente.
                            </p>
                            <strong>Gráficos disponibles</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('layout.footer')
</div>