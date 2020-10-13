<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Phone;
use App\Models\Email;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($searchText, $message = null)
    {
        if (!$searchText) {
            $customers = Customer::paginate(10);
        } else {
            $searchText = strtolower($searchText);
            $customers = (new Customer)->search($searchText);
        }
        
        return view('customer.index', [
            'customers' => $customers,
            'header' => 'Clientes',
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
        return view('customer.create', ['header' => 'Nuevo cliente']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer $request)
    {
        $customer = Customer::create($request->validated());
        
        $customer->phones()->save(new Phone(['value' => $request->phone]));
        $customer->emails()->save(new Email(['value' => $request->email]));
        
        return $this->index(null,'Cliente ingresado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer.show', [
            'customer' => $customer->load(['orders', 'phones', 'emails']),
            'header' => "Detalles de {$customer->name} {$customer->lastName}"
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
