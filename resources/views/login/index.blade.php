@extends('layout.plantilla')
@section('title', 'Registro')
@section('content')


<h3>Ingreso</h3>
<div id= "formLogin">

    <form  action="#" method="post">
        @csrf
        <label for="usuario">Usuario</label>
        <input type="text" title="usuario" placeholder="Escribe tu usuario...">
        <br>
        <label for="password">Contraseña</label>
        <input type="password" title="password" placeholder="Escribe tu contraseña...">
        <br>
        <button type="submit" value="ingresar">Ingresar</button>
        <br>    
    </form>
    <a href="#">Recuperar Contraseña</a>    
</div>

@endsection