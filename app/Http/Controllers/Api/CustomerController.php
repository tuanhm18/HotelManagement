<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{
    public function get($id = null) {
        if($id == null) { //lay het
            $customers = Customer::all();
           
            return BaseResult::withData($customers);
        } else {
            $customer = Customer::findOrFail($id);
            return BaseResult::withData($customer);
        }
    }
    public function create(Request $request) {
        $customer = new Customer;
        $customer->CUS_ID = $request->CUS_ID;
        $customer->FirstName = $request->FirstName;
        $customer->LastName = $request->LastName;
        $customer->IdentityNumber = $request->IdentityNumber;
        $customer->Phone = $request->Phone;
        $customer->Email = $request->Email;
        $customer->save();
        return $customer;
    }
    public function update(Request $request) {
        $customer = Customer::findOrFail($request->CUS_ID);
        $customer->CUS_ID = $request->CUS_ID;
        $customer->FirstName = $request->FirstName;
        $customer->LastName = $request->LastName;
        $customer->IdentityNumber = $request->IdentityNumber;
        $customer->Phone = $request->Phone;
        $customer->Email = $request->Email;
        $customer->save();
        return $customer;
    }
    public function delete($id) {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return $customer;
    }
}
