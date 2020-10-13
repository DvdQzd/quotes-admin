@extends('layouts.app')

@section('customer-index')

@if ($message) 
<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
  <div class="flex">
    <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
    <div>
      <p class="font-bold">{{ $message }}</p>
    </div>
  </div>
</div>
@endif
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
<!-- <table class="table-auto w-screen mb-20 border-collapse table-auto"> -->
<table class="responsiveTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
    <thead>
        <th class="px-4 py-2" data-priority="1">Nombre</th>
        <th class="px-4 py-2" data-priority="2">Apellido</th>
        <th class="px-4 py-2" data-priority="3">Rut</th>
        <th class="px-4 py-2" data-priority="4">Dirección</th>
        <th class="px-4 py-2" data-priority="5"></th>
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