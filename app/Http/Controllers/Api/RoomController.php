<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function get($id = null) {
        if($id == null) {
            $rooms = Room::all();
            return BaseResult::withData($rooms);
        }
    }
}
