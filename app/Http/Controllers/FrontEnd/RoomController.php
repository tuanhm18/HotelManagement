<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Image;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function view($id = null) {
        if($id == null) {
            return view('frontend.rooms');
        } else {
            $room = Room::find($id);
            if($room) {
                $roomType = RoomType::find($room->RTYP_ID);
                if($roomType) $room->RoomType = $roomType;
                $images = Image::where('ROO_ID', $room->ROO_ID)->get();
                if($images) $room->Images = $images;
                return view('frontend.room-single')->with('room', $room);
            } else return abort(404);
        }
    }
    public function getRoomByRoomType($id, $name = null) {
        $roomType = RoomType::find($id);
        if($roomType) {
            $rooms = Room::where('RTYP_ID', $id)->paginate(6);
            foreach ($rooms as $room) {
                $room->RoomType = $roomType;
                $images = Image::where('ROO_ID', $room->ROO_ID)->get();
                $room->Images = $images;
                $room->RoomName = $roomType->Name;
                $room->NumberOfBeds = $roomType->NumberOfBeds;
                $room->NumberOfRests = $roomType->NumberOfRests;
            }
            return view('frontend.rooms')->with(['rooms'=>$rooms, 'roomType'=>$roomType]);
        } 
        else return view('frontend.rooms');
    }
}
