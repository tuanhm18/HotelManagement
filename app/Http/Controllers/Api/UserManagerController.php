<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserManagerController extends Controller
{
    public function validateUserName($username) {
        $user = User::where(['username'=>$username])->get();
        if($user) {
            return response()->json([
               "isValid"=>false,
               "error"=>1
            ]);
        } else {
            return response()->json([
                "isValid"=>true,
                "error"=>0
             ]);
        }
    }
    public function get($id = null) {
        if($id == null) {
            return BaseResult::withData(User::all());
        } else {
            $user = User::findOrFail($id);
            return BaseResult::withData($user);
        }
    }
    public function create(Request $request) {
        $user = new User();
        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;
        $user->Role = $request->Role;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
        if ($request->hasFile('Avatar')) {
            $fileName = pathinfo($request->Avatar->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = $user->USE_ID.'_'.$fileName.'_'.time().'_'.$request->Avatar->extension();
            $request->Avatar->move(public_path('data/users'), $imageName);
            $user->Avatar = $imageName;
            $user->save();
        }
        return BaseResult::withData($user);
    }
    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->FirstName = $request->FirstName;
        $user->LastName = $request->LastName;    
        $user->Role = $request->Role;
        $user->username = $request->username;
        $user->save();
        if ($request->hasFile('Avatar')) {
            // delete old file
            $oldFile = $user->Avatar;
            if(File::exists(public_path('data/users/'.$oldFile))){
                File::delete(public_path('data/users/'.$oldFile));
            }
            $filename = pathinfo($request->Avatar->getClientOriginalName(), PATHINFO_FILENAME);
            // $extension = pathinfo($request->Image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = $user->USE_ID.'_'.$filename.'_'.time().'.'.$request->Avatar->extension();
            $request->Avatar->move(public_path('data/users'), $imageName);
            $user->Avatar = $imageName;
            $user->save();
        }
        return BaseResult::withData($request->USE_ID);
    }
    public function delete($id) {
        $user = User::findOrFail($id);
        $oldFile = $user->Avatar;
        if(File::exists(public_path('data/users/'.$oldFile))) {
            File::delete(public_path('data/users/'.$oldFile));
        }
        $user->delete();
        return BaseResult::withData($user);
    }
}
