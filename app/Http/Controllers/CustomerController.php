<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Phone;
use App\Models\Email;
use Illuminate\Http\Request;

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
            $customers = Customer::paginate(15);
        } else {
            $searchText = strtolower($searchText);
            $customers = Customer::whereRaw(
                            "LOWER(CONCAT(customers.name, ' ',customers.\"lastName\")) LIKE ?",
                            ["%{$searchText}%"])
                            ->orWhere('documentId', 'like', "%{$searchText}%")
                            ->paginate(15);
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
    public function store(Request $request)
    {
        $customer = Customer::create([
            'name' => $request->name,
            'lastName' => $request->lastName,
            'documentId' => $request->documentId,
            'address' => $request->address
        ]);
        
        $customer->phones()->save(new Phone(['value' => $request->phone]));
        $customer->emails()->save(new Email(['value' => $request->email]));
        
        return $this->index('Cliente ingresado correctamente');
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
