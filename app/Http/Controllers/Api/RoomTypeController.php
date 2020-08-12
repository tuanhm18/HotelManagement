<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\RoomType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function get($id = null) {
        if ($id == null) {
            $roomTypes = RoomType::all();
            return BaseResult::withData($roomTypes);
        } else{
            $roomType = RoomType::findOrFail($id);
            return BaseResult::withData($roomType);
        }
    }

    public function create (Request $request){
        $roomType = new RoomType;
        $roomType->NumberOfBeds = $request->NumberOfBeds;
        $roomType->NumberOfRests = $request->NumberOfRests;
        $roomType->Price = $request->Price;
        $roomType->Name = $request->Name;
        $roomType['CreatedDate'] = Carbon::now();
        $roomType->save();
        return $roomType; 
    }

    public function update(Request $request){
        $roomType = RoomType::findOrFail($request->RTYP_ID);
        $roomType->RTYP_ID = $request->RTYP_ID;
        $roomType->NumberOfBeds = $request->NumberOfBeds;
        $roomType->NumberOfRests = $request->NumberOfRests;
        $roomType->Price = $request->Price;
        $roomType->Name = $request->Name;

        $roomType['UpdatedDate'] = Carbon::now();
        $roomType->save();
        return $roomType; 
    }

    public function delete($id){
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();
        return $roomType;
    }
}
