@extends('layouts.app')

@section('customer-show')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.css">
<script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridWeek',
          events: [
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14',
                color: 'red',
                url: '1',
                allDay: false

            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14',
                allDay: false
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
            { // this object will be "parsed" into an Event Object
                title: 'Cumple Alan', // a property!
                start: '2020-10-14', // a property!
                end: '2020-10-14' // a property! ** see important note below about 'end' **
            },
        ]
        });
        calendar.render();
      });

    </script>
    <div id='calendar'></div>
<div class="flex bg-gray-200">
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-6 py-2 m-2">
  Fecha de entrega
  </div>
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-12 py-2 m-2">
  {{ $order->deadline }}
  </div>
</div>
<div class="flex bg-gray-200">
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-6 py-2 m-2">
  Incluye instalación
  </div>
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-12 py-2 m-2">
  {{ $order->installation ? 'Si' : 'No' }}
  </div>
</div>
<div class="flex bg-gray-200">
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-6 py-2 m-2">
  Estado
  </div>
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-12 py-2 m-2">
  {{ $order->status }}
  </div>
</div>
<div class="flex bg-gray-200">
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-6 py-2 m-2">
  Notas
  </div>
  <div class="flex-initial text-gray-200 text-center bg-gray-400 px-12 py-2 m-2">
  {{ $order->notes }}
  </div>
</div>
<hr>
<table class="responsiveTable" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
    <thead>
        <th class="px-4 py-2" data-priority="1">Producto</th>
        <th class="px-4 py-2" data-priority="2">Ancho</th>
        <th class="px-4 py-2" data-priority="3">Alto</th>
        <th class="px-4 py-2" data-priority="4">Precio</th>
        <th class="px-4 py-2" data-priority="5"></th>
    </thead>
    <tbody>
        @foreach ( $order->orderDetails as $detail )
        <tr>
            <td class="border px-4 py-2">{{ $detail->product->name }}</td>
            <td class="border px-4 py-2">{{ $detail->width }}</td>
            <td class="border px-4 py-2">{{ $detail->height }}</td>
            <td class="border px-4 py-2">{{ $detail->price }}</td>
        </tr> 
        @endforeach
    </tbody>
</table>
@endsection