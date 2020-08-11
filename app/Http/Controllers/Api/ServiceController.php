<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class ServiceController extends Controller
{
    public function get($id = null) {
        if ($id == null) {
            $services = Service::all();
            return BaseResult::withData($services);
        } else{
            $service = Service::findOrFail($id);
            return BaseResult::withData($service);
        }
    }

    public function create (Request $request){
        $service = new Service;
        $service->Name = $request->Name;
        $service->Price = $request->Price;
        $service['CreatedDate'] = Carbon::now();
        $service->save();
        return $service; 
    }

    public function update(Request $request){
        $service = Service::findOrFail($request->SER_ID);
        $service->SER_ID = $request->SER_ID;
        $service->Name = $request->Name;
        $service->Price = $request->Price;
        $request['UpdatedDate'] = Carbon::now();
        $service->save();
        return $service;
    }

    public function delete($id){
        $service = Service::findOrFail($id);
        $service->delete();
        return $service;
    }
}
