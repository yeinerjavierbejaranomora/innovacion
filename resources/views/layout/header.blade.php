<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    


    <title>@yield('title')</title>

	<!-- ponemos los estilos y complementos necesarios para las paginas -->
    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">

	<!-- Custom fonts for this template-->
	<link href="{{asset('public/general/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('public/general/css/sb-admin-2.min.css')}}" rel="stylesheet">


 
</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

    @include('layout.menu')

	@yield('content')


	<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy;Universidad Iberoamericana 2023</span>
        </div>
    </div>
</footer>

    <!--===============================================================================================-->
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('public/general/vendor/jquery/jquery.min.js')}}"></script>

    <script src="{{asset('public/general/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('public/general/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('public/general/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('public/general/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('public/general/js/demo/chart-area-demo.js')}}"></script>

    <script src="{{asset('public/general/js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>