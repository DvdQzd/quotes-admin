<html>
<style>
table, th, td {
  border: 3px solid black;
  border-collapse: collapse;
  width: 100%;
}
</style>
<body>
<h3>Prueba mail Orden: {{ $order->id }}</h3>

<hr>

<table>
@foreach ($order->orderDetails as $detail)

  <tr>	
    <td>
      {{ $detail->product->name }}
    </td>
    <td>
      {{ $detail->width }}
    </td>
    <td>
      {{ $detail->height }}
    </td>
    <td>
      {{ $detail->price }}
    </td>
  </tr>

@endforeach

  <tr>
    <td colspan=3></td>
  </tr>

</table>

</body>
</html>
