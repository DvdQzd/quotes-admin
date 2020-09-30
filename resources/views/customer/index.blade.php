@extends('layouts.app')

@section('customer-index')
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
@endsection