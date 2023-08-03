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