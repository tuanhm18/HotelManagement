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

    public function validRoomTypeName($name)
    {
        $roomType = RoomType::where(['Name'=>$name])->first();
        if ($roomType) return response()->json([
            'error' => false,
            'message' => 'This name has been taken'
        ]);
        else {
            return response()->json([
                'error' => true,
                'Name' => $name,
                "message" => 'Valid name'
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
        try {
            $roomType->save();
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
        return BaseResult::withData($roomType);
    }

    public function update(Request $request, $id)
    {
        $roomType = RoomType::find($id);
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
