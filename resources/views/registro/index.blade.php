@extends('layout.plantilla')
@section('title','Registro')
@section('content')
<div>
    <h3>Registro usuario</h3>
    <form action="" method="post">
        @csrf
        <div><label for="">IDBanner<input type="number" name="" id=""></label></div>
        <div><label for="">Documento</label><input type="text"></div>
        <div><label for="">Nombre completo</label><input type="text"></div>
        <div><label for="">Correo electronico</label><input type="text"></div>
        <div><label for="">Contraseña</label><input type="password"></div>
        <div><label for="">Confirmar contraseña</label><input type="password"></div>
        <div><label for="">Rol</label><select name="" id=""></select></div>
        <div><label for="">Facultad</label><select name="" id=""></select></div>
        <div><label for="">Programas</label></div>
    </form>
</div>
@endsection
