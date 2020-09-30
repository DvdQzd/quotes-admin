@extends('layouts.app')

@section('customer-show')

<div class="container">
    <table class="table-auto w-screen mb-10">
        <tbody>
            <tr>
                <th class="border px-2 py-2">Nombre</th>
                <td class="border px-4 py-2">{{ $customer->name }}</td>
            </tr>
            <tr>
                <th class="border px-2 py-2">Apellido</th>
                <td class="border px-4 py-2">{{ $customer->lastName }}</td>
            </tr>
            <tr>
                <th class="border px-2 py-2">Rut</th>
                <td class="border px-4 py-2">{{ $customer->documentId }}</td>
            </tr>
            <tr>
                <th class="border px-2 py-2">Teléfonos</th>
                <td class="border px-4 py-2">
                    @foreach ($customer->phones as $phone)
                        {{ $phone->value }} <br>
                    @endforeach 
                </td>
            </tr>
            <tr>
                <th class="border px-2 py-2">Emails</th>
                <td class="border px-4 py-2">
                    @foreach ($customer->emails as $email)
                        {{ $email->value }} <br>
                    @endforeach 
                </td>
            </tr>
            <tr>
                <th class="border px-2 py-2">Dirección</th>
                <td class="border px-4 py-2">{{ $customer->address }}</td>
            </tr>
            <tr>
                <th class="border px-2 py-2">Fecha de creación</th>
                <td class="border px-4 py-2">{{ $customer->created_at }}</td>
            </tr>
            <tr>
                <th class="border px-2 py-2">Última modificación</th>
                <td class="border px-4 py-2">{{ $customer->updated_at }}</td>
            </tr>
        </tbody>
    </table>

    <p class="text-center">Órdenes de {{ $customer->name }}</p>
    <table class="table-auto w-screen mb-10">
        <thead>
            <th class="px-4 py-2">Fecha de entrega</th>
            <th class="px-4 py-2">Incluye instalación</th>
            <th class="px-4 py-2">Estado</th>
            <th class="px-4 py-2">Notas</th>
            <th class="px-4 py-2"></th>
        </thead>
        <tbody>
        @foreach( $customer->orders as $order )
        <tr>
            <td class="border px-4 py-2">{{ $order->deadline }}</td>
            <td class="border px-4 py-2">{{ $order->installation ? 'Si' : 'No' }}</td>
            <td class="border px-4 py-2">{{ $order->status }}</td>
            <td class="border px-4 py-2">{{ $order->notes }}</td>
            <td class="border px-4 py-2">
                <a 
                class="bg-transparent hover:bg-gray-500 hover:text-white py-1 px-4 border border-gray-500 hover:border-transparent rounded" 
                href="/order/{{ $order->id }}">
                    Detalles
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>

@endsection