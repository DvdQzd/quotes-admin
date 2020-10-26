<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendEmail (Request $request, $id) {
      
      $order = Order::find($id);
      $orderData = $order->load(['customer', 'orderDetails.product']);
      $data['order'] = $orderData;
      $data['email'] = $request->email;
      //$toEmail = $request->email;
      $total = Self::getTotal($orderData->orderDetails);
      $pdf = PDF::loadView('mail.order_created', $data);
      try{
            Mail::send('mail.order_created', $data, function($message)use($data,$pdf) {
            $message->to($data["email"])
            ->attachData($pdf->output(), "orden.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
      //Mail::to($toEmail)->send(new OrderCreated($orderData, $total))
	//->attachData($pdf->output(), "orden.pdf");;
    }

    private static function getTotal ($orderDetails) {
      return array_sum($orderDetails->pluck('price')->all());
    }
}
