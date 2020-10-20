<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Phone;
use App\Models\Email;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
        $rules = [
            'name' => 'required|max:50',
            'lastName' => 'required|max:50',
            'email' => 'required|email',
            'documentId' => 'required|unique:customers',
            'address' => 'required'
        ];

        $messages = [
            'name.required' => 'El nombre es un campo obligatorio.',
            'lastName.required' => 'El apellido es un campo obligatorio.',
            'documentId.required' => 'El RUT es un campo obligatorio.',
            'email.required' => 'El Email es un campo obligatorio.',
            'address.required' => 'La direccion es un campo obligatorio.',
            'documentId.unique' => 'Rut pertenece a otro cliente.',
            'email.email' => 'Email debe tener formato xxxx@ddd.nnn'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response(json_encode($validator->errors()), 400)
                        ->header('Content-Type', 'application/json');
        }

        $customer = Customer::create($request->all());
        
        $customer->phones()->save(new Phone(['value' => $request->phone]));
        $customer->emails()->save(new Email(['value' => $request->email]));

        return response(json_encode(['result' => true]), 200)
                  ->header('Content-Type', 'application/json');
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

    public function search(Request $request) {
        $searchText = strtolower($request->searchText);
        $customers = (new Customer)->searchAutoComplete($searchText);
        return response(json_encode($customers), 200)
                  ->header('Content-Type', 'application/json');
    }
}
