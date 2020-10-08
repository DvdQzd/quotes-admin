@extends('layouts.app')

@section('customer-create')
<form action="/customer" method="post">
    {{ csrf_field() }}
    Nombre: <input type="text" name="name"><br>
    Apellido: <input type="text" name="lastName"><br>
    Rut: <input type="text" name="documentId"><br>
    Dirección: <input type="text" name="address"><br>
    Teléfono: <input type="text" name="phone"><br>
    Email: <input type="text" name="email"><br>
    <button type="submit">Guardar</button>
</form>
@endsection