<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\ServiceBill;
use Illuminate\Http\Request;

class ServiceBillController extends Controller
{
    public function get($id = null) {
        if($id == null) {
            $serviceBills = ServiceBill::all();
            return BaseResult::withData($serviceBills);
        } else {
            $serviceBill = ServiceBill::findOrFail($id);
            return BaseResult::withData($serviceBill);
        }
    }
    public function create(Request $request) {
        $serviceBill = new ServiceBill();
        
    }
}
