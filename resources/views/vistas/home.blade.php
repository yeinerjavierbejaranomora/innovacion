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
    #seccion{
        border-radius: 10%;
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
            <section id="seccion" style="background-color: #eee;">
                <div class="container py-5">
                    <div class="text-center">
                        <h2>Informes disponibles</h2>
                    </div>


                </div>
            </section>
        </div>
    </div>
    @include('layout.footer')
</div>