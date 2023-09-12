<?php

namespace App\Http\Controllers;

use App\Http\Requests\customerRequest;
use App\Http\Resources\customerjson;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(customerRequest $request)
    {

        $customer = new Customer($request->all());
        if (Customer::where('user_id', Auth::user()->id)->exists()) {
            // $customer->user_id = Auth::user()->id;
            return response()->json(['status' => false, 'message' => 'this client is already register in profile'], 400);
        } else {
            $customer->user_id = Auth::user()->id;

            if ($customer->save()) {
                return response()->json(['status' => true], 200);
            }
        }

        return response()->json(['status' => false], 400);
    }

    /*
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(customerRequest $request, $slug)
    {
        $customer = Customer::where('slug', $slug)->first();

        if ($customer) {
            $customer->update($request->only(['id_number', 'Whatsapp_number', 'birthDate', 'address', 'gender']));
            // $status = $customer->user()->update(['email', 'name', 'role', 'image', 'city_id', 'phone_number']);
            $user = User::where('id', $customer->user_id)->first();
            $status = $user->update($request->only([['email', 'name', 'role', 'image', 'city_id', 'phone_number']]));
            if ($status) {
                return response()->json(['status' => true], 200);
            }
        }

        return response()->json(['status' => false], 400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $status = Customer::where('slug', $slug)->delete();
        if ($status) {
            return response()->json(['status' => true], 200);
        }
        return response()->json(['status' => false], 400);
    }
    public function data_profile($slug)
    {
        $customer = Customer::where('slug', $slug)->with('user')->with('user.city')->get();

        if ($customer) {
            $customer = customerjson::collection($customer);
            return  $customer;
            // response()->json(['message' => $customer], 200);
        } else {
            return response()->json(['message' => 'empty data client'], 400);
        }
    }
}
