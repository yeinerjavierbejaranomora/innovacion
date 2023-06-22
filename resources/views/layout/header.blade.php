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
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Custom styles for this template-->
    <link href="{{asset('public/general/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!--{{-- <script src="{{asset('public/general/vendor/jquery/jquery.min.js')}}"></script> --}}-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    {{-- Datatale --}}
  
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>



</head>

<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">



	<!--@yield('content')-->

