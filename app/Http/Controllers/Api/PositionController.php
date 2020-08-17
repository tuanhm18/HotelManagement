<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Position;
use App\Response\BaseResult;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function validatePosition(Request $request)
    {
        $rules = array(
            'Name' => 'unique:Positions,Name'
        );
        $validator = Validator::make($request->all(), $rules);
        Cookie::queue(Cookie::make("Hello", json_encode("Henry"), 60*24*365));

        if ($validator->fails()) {
            return response()->json([
                'validator' => $validator,
                'error' => 1,
                'data'=>$request->Name,
                'message'=>'This name has been used'
            ]);
        } else {
            return response()->json([
                'validator' => $validator,
                'error' => 0,
                'data'=>$request->Name,
                'message'=>'This name has not been used'
            ]);
        }
    }
    public function get($id = null)
    {
        if ($id == null) { //lay het
            $positions = Position::all();
            return BaseResult::withData($positions);
        } else {
            $position = Position::findOrFail($id);
            return BaseResult::withData($position);
        }
    }
    public function create(Request $request)
    {
        $position = new Position;
        $position->Name = $request->Name;
        $position['CreatedBy'] = Cookie::get('userFullName');
        $position['CreatedDate'] = Carbon::now();
        $position->save();
        return $position;
    }
    public function update(Request $request)
    {
        $position = Position::findOrFail($request->POS_ID);
        $position->POS_ID = $request->POS_ID;
        $position->Name = $request->Name;
        $position['UpdatedBy'] = Cookie::get('userFullName');
        $position['UpdatedDate'] = Carbon::now();
        $position->save();
        return $position;
    }
    public function delete($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();
        return $position;
    }
}
