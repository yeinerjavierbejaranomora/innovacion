@extends('layout.plantilla')
@section('title', 'Registro')
@section('content')


<h3>Ingreso</h3>
<div id= "formLogin">
    
    <form  action="#" method="post">
        @csrf
        <label for="usuario">Usuario</label>
        <input type="text" title="usuario">
        <br>
        <label for="password">Contraseña</label>
        <input type="password" title="password">
        <br>
        <button type="submit" value="ingresar">Ingresar</button>
        <br>    
    </form>
    <a href="#">Recuperar Contraseña</a>    
</div>

@endsection