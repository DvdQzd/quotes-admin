@extends('layouts.app')

@section('customer-index')

<div class="flex items-center bg-gray-200 h-24">
    <a 
    class="hover:bg-gray-500 hover:text-white py-1 px-6 border border-gray-500 hover:border-transparent rounded" 
    href="/customer/create">
        Nuevo Cliente
    </a>
</div>
<div class="flex items-center bg-gray-200 h-24">
    <input class="bg-gray-100 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        id="searchText"
        type="text"
        placeholder="Ingresa nombre, apellido o rut para buscar cliente"
        autofocus
    >
</div>
<div class="container ">
<table class="table-auto w-screen mb-20">
    <thead>
        <th class="px-4 py-2">Nombre</th>
        <th class="px-4 py-2">Apellido</th>
        <th class="px-4 py-2">Rut</th>
        <th class="px-4 py-2">Dirección</th>
        <th class="px-4 py-2"></th>
    </thead>
    <tbody>
        @foreach( $customers as $customer )
        <tr>
            <td class="border px-4 py-2">{{ $customer->name }}</td>
            <td class="border px-4 py-2">{{ $customer->lastName }}</td>
            <td class="border px-4 py-2">{{ $customer->documentId }}</td>
            <td class="border px-4 py-2">{{ $customer->address }}</td>
            <td class="border px-4 py-2">
                <a 
                class="bg-transparent hover:bg-gray-500 hover:text-white py-1 px-4 border border-gray-500 hover:border-transparent rounded" 
                href="/customer/{{ $customer->id }}">
                    Detalles
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>
  <div class="fixed bottom-0 w-screen">
    {{ $customers->render() }}
  </div>
  <script>
    var input = document.getElementById("searchText");
    input.addEventListener("keyup", function(event) {
    console.log(event.keyCode);
    if (event.keyCode === 13) {
        event.preventDefault();
        searchText = input.value;
        self.location.href = `http://${location.hostname}:${location.port}/customer/search/${searchText}`;
    }
    });
    </script>
@endsection