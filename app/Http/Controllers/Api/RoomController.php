<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Image;
use App\Response\BaseResult;
use App\Room;
use App\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request as FacadesRequest;

class RoomController extends Controller
{
    public function validRoomId($id)
    {
        $room = Room::where(['ROO_ID' => $id])->first();
        if ($room) return response()->json([
            'error' => false,
            'message' => 'This id has been taken'
        ]);
        else {
            return response()->json([
                'error' => true,
                'id' => $id,
                "message" => 'Valid Id'
            ]);
        }
    }
    public function getAvailable()
    {
        $rooms = Room::where(['Status' => 1])->get();
        return BaseResult::withData($rooms);
    }
    public function get($id = null)
    {
        if ($id == null) { //lay het
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
            $room->Images = Image::where(['ROO_ID' => $room->ROO_ID])->get();
            return BaseResult::withData($room);
        }
    }
    public function create(Request $request)
    {
        $room = new Room;
        $room->ROO_ID = $request->ROO_ID;
        $room->Status = $request->Status;
        $room->RTYP_ID = $request->RTYP_ID;
        $room->IsHot = $request->IsHot;
        $room->Description = $request->Description;
        $room['CreatedDate'] = Carbon::now();
        try {
            $room->save();
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
        if ($request->hasfile('Images')) {
            foreach ($request->file('Images') as $image) {
                $newImage = new Image();
                $newImage->ROO_ID = $request->ROO_ID;
                $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = $room->ROO_ID . '_' . $fileName . '_' . time() . '_' . $image->extension();
                $image->move(public_path('data/rooms'), $imageName);
                $newImage->Image = $imageName;
                $newImage->save();
            }
        }

        return BaseResult::withData($room);
    }
    public function update($id, Request $request)
    {
        $room = Room::find($id);
        $room->Status = $request->Status;
        $room->RTYP_ID = $request->RTYP_ID;
        $room->IsHot = $request->IsHot;
        $room->Description = $request->Description;
        $room['UpdatedDate'] = Carbon::now();
        try {
            $room->save();
        } catch (\Exception $e) {
            return BaseResult::error('500', $e->getMessage());
        }
        if ($request->hasfile('Images')) {
            $images = Image::where(['ROO_ID' => $room->ROO_ID])->get();
            if ($images) {
                foreach ($images as $image) {
                    $oldFile = $image->Name;
                    if (File::exists(public_path('data/rooms/' . $oldFile))) {
                        File::delete(public_path('data/rooms/' . $oldFile));
                    }
                    $image->delete();
                }
            }
            foreach ($request->file('Images') as $image) {
                $newImage = new Image();
                $newImage->ROO_ID = $id;
                $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = $room->ROO_ID . '_' . $fileName . '_' . time() . '_' . $image->extension();
                $image->move(public_path('data/rooms'), $imageName);
                $newImage->Image = $imageName;
                $newImage->save();
            }
        }
        return BaseResult::withData($room);
    }
    public function delete($id)
    {
        $room = Room::findOrFail($id);
        $images = Image::where(['ROO_ID' => $room->ROO_ID])->get();
        foreach ($images as $image) {
            if (File::exists(public_path('data/rooms/' . $image->Image))) {
                File::delete(public_path('data/rooms/' . $image->Image));
            }
            $image->delete();
        }
        $room->delete();
        return $room;
    }
}
