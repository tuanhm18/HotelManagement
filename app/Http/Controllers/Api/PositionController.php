<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Position;
use App\Response\BaseResult;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;

class PositionController extends Controller
{
    public function get($id = null) {
        if($id == null) { //lay het
            $positions = Position::all();
            return BaseResult::withData($positions);
        } else {
            $position = Position::findOrFail($id);
            return BaseResult::withData($position);
        }
    }
    public function create(Request $request) {
        $position = new Position;
        $position->Name = $request->Name;
        $position['CreatedBy'] = Cookie::get('username');
        $position['CreatedDate'] = Carbon::now();
        $position->save();
        return $position;
    }
    public function update(Request $request) {
        $position = Position::findOrFail($request->POS_ID);
        $position->POS_ID = $request->POS_ID;
        $position->FirstName = $request->FirstName;
        $position->LastName = $request->LastName;
        $position->IdentityNumber = $request->IdentityNumber;
        $position->Phone = $request->Phone;
        $position->Email = $request->Email;
        $position['UpdatedBy'] = Cookie::get('username');
        $position['UpdatedDate'] = Carbon::now();
        $position->save();
        return $position;
    }
    public function delete($id) {
        $position = Position::findOrFail($id);
        $position->delete();
        return $position;
    }
}
