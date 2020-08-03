<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function get($id = null) {
        if ($id == null) {
            $services = Service::all();
            return BaseResult::withData($services);
        }
    }
}
