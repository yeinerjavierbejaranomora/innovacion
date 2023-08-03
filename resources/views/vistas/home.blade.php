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

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
                <div class="topbar-divider d-none d-sm-block"></div>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <section style="background-color: #eee;">
                <div class="container py-5">
                </div>
            </section>
        </div>
    </div>
    @include('layout.footer')
</div>