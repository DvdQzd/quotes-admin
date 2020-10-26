<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;
use App\Mail\OrderCreated;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message = null)
    {
        $orders = Order::with('customer')
		    ->orderBy('id', 'desc')
                    ->paginate(5);
        return view('order.index', [
            'orders' => $orders,
            'header' => 'Ordenes',
            'message' => $message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	$products = Product::all();
	return view('order.create', [
	  'header' => 'Nueva orden',
	  'products' => $products
	]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	$details = [];
	for($i = 0; $i < count($request->details['products']); $i++) {
	  $details[$request->details['products'][$i]] = [
	    'width' => $request->details['widths'][$i],
	    'height' => $request->details['heights'][$i]
	  ];
	}


	$detailInstances = [];
	foreach ($details as $product_id => $values) {
	  $detailInstances[] = new OrderDetail([
	    'product_id' => $product_id,
	    'width' => $values['width'],
	    'height' => $values['height'],
	    'price' => getFinalPrice(
	      $values['width'],
	      $values['height'],
	      (new Product)->getPrice($product_id),
	      5) // TODO: factor getter
	  ]); 
	} 


	$order = new Order;
	$order->deadline = $request->deadline;
	$order->installation = $request->installation;
	$order->notes = $request->notes;
	$order->status = $request->status;
	$order->customer_id = $request->customer_id;

	$order->status = 'pending';

	$order->save();
	$order->orderDetails()->saveMany($detailInstances);


	return $this->index('Orden ingresada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order.show', [
            'order' => $order->load(['customer', 'orderDetails.product']),
            'header' => "Detalles de la orden #{$order['id']}"
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

}
