<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{
    public function validCustomerIdentity($identity)
    {
        $customer = Customer::where(['IdentityNumber' => $identity])->first();
        if ($customer) return response()->json([
            'error' => false,
            'message' => 'This identity has been taken'
        ]);
        else {
            return response()->json([
                'error' => true,
                'IdentityNumber' => $identity,
                "message" => 'Valid Identity'
            ]);
        }
    }

    public function get($id = null)
    {
        if ($id == null) { //lay het
            $customers = Customer::all();

            return BaseResult::withData($customers);
        } else {
            $customer = Customer::findOrFail($id);
            return BaseResult::withData($customer);
        }
    }
    public function create(Request $request)
    {
        $customer = new Customer;
        $customer->CUS_ID = $request->CUS_ID;
        $customer->FirstName = $request->FirstName;
        $customer->LastName = $request->LastName;
        $customer->IdentityNumber = $request->IdentityNumber;
        $customer->Phone = $request->Phone;
        $customer->Email = $request->Email;
        try {
            $customer->save();
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
        return BaseResult::withData($customer);
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        if ($customer) {
            $customer->FirstName = $request->FirstName;
            $customer->LastName = $request->LastName;
            $customer->IdentityNumber = $request->IdentityNumber;
            $customer->Phone = $request->Phone;
            $customer->Email = $request->Email;
            $customer->save();
        } else {
            return BaseResult::error(404, "Data is not found!");
        }
        return BaseResult::withData($customer);
    }
    public function delete($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return $customer;
    }
}
