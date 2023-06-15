@extends('layout.plantilla')
@section('title', 'Registro')
@section('content')

<div>
    <form action="#" method="post">
        @csrf
        <label for="usuario">Usuario</label>
        <input type="text" title="usuario">

        <label for="password">Contraseña</label>
        <input type="text"title="password">

        <button type="submit" value="ingresar" class="button btn-primary">Ingresar</button>
        
    </form>
</div>

@endsection