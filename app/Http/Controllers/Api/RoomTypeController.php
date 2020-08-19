<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\RoomType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class RoomTypeController extends Controller
{

    public function validateRoomType(Request $request)
    {
        if ($request->RTYP_ID != 0) {
            $roomType = RoomType::findOrFail($request->RTYP_ID);
            if ($roomType) {
                if ($roomType->Name == $request->Name) {
                    return  response()->json([
                        'error' => 0,
                        'data' => $request->Name,
                        'message' => ''
                    ]);
                }
            }
        }
        $rules = array(
            'Name' => 'unique:RoomType,Name'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'validator' => $validator,
                'error' => 1,
                'data' => $request->Name,
                'message' => 'This name has been used'
            ]);
        } else {
            return response()->json([
                'validator' => $validator,
                'error' => 0,
                'data' => $request->Name,
                'message' => 'This name has not been used'
            ]);
        }
    }

    public function get($id = null)
    {
        if ($id == null) {
            $roomTypes = RoomType::all();
            return BaseResult::withData($roomTypes);
        } else {
            $roomType = RoomType::findOrFail($id);
            return BaseResult::withData($roomType);
        }
    }

    public function create(Request $request)
    {
        $roomType = new RoomType;
        $roomType->NumberOfBeds = $request->NumberOfBeds;
        $roomType->NumberOfRests = $request->NumberOfRests;
        $roomType->Price = $request->Price;
        $roomType->Name = $request->Name;
        $roomType['CreatedDate'] = Carbon::now();
        $roomType->save();
        return $roomType;
    }

    public function update(Request $request)
    {
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

    public function delete($id)
    {
        $roomType = RoomType::findOrFail($id);
        $roomType->delete();
        return $roomType;
    }
}
