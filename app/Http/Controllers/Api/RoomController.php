<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Room;
use App\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class RoomController extends Controller
{
    public function get($id = null) {
        if($id == null) { //lay het
            $rooms = Room::all();
            foreach ($rooms as $room) {
                $roomType = RoomType::findOrFail($room->RTYP_ID);
                $room->RoomName = $roomType->Name;
                $room->Price = $roomType->Price;
                $room->NumberOfBeds = $roomType->NumberOfBeds;
                $room->NumberOfRests = $roomType->NumberOfRests;
            }
            return BaseResult::withData($rooms);
        } else {
            $room = Room::findOrFail($id);
            return BaseResult::withData($room);
        }
    }
    public function create(Request $request) {
        $room = new Room;
        $room->ROO_ID = $request->ROO_ID;
        $room->Status = $request->Status;
        $room->RTYP_ID = $request->RTYP_ID;
        $room->IsHot = $request->IsHot;
        $room['CreatedBy'] = Cookie::get('username');
        $room['CreatedDate'] = Carbon::now();
        $room->save();
        return $room;
    }
    public function update(Request $request) {
        $room = Room::findOrFail($request->ROO_ID);
        $room->ROO_ID = $request->ROO_ID;
        $room->Status = $request->Status;
        $room->RTYP_ID = $request->RTYP_ID;
        $room->IsHot = $request->IsHot;
        $room['UpdatedBy'] = Cookie::get('username');
        $room['UpdatedDate'] = Carbon::now();
        $room->save();
        return $room;
    }
    public function delete($id) {
        $room = Room::findOrFail($id);
        $room->delete();
        return $room;
    }
}
