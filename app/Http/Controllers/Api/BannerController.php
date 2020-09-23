<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BannerController extends Controller
{
    public function get($id = null)
    {
        if ($id == null) {
            $banners = Banner::all();
            return BaseResult::withData($banners);
        } else {
            $banner = Banner::find($id);
            if ($banner) {
                return BaseResult::withData($banner);
            } else {
                return BaseResult::error(404, "Data is not found!");
            }
        }
    }
    public function create(Request $request)
    {
        $banner = new Banner();
        $banner->Title = $request->Title;
        $banner->Description = $request->Description;
        $banner->IsPublished = $request->IsPublished;
        try {
            $banner->save();
            if ($request->hasfile('Avatar')) {
                $fileName = pathinfo($request->Avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = $banner->BAN_ID . '_' . $fileName . '_' . time() . '_' . $request->Avatar->extension();
                $request->Avatar->move(public_path('data/banners'), $imageName);
                $banner->Avatar = $imageName;
                $banner->save();
            }
            return BaseResult::withData($banner);
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
        return BaseResult::withData($banner);
    }
    public function update($id, Request $request)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $banner->Title = $request->Title;
            $banner->Description = $request->Description;
            $banner->IsPublished = $request->IsPublished;
            try {
                $banner->save();
                if ($request->hasFile('Avatar')) {
                    // delete old file
                    $oldFile = $banner->Avatar;
                    if(File::exists(public_path('data/banners/'.$oldFile))){
                        File::delete(public_path('data/banners/'.$oldFile));
                    }
                    $filename = pathinfo($request->Avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    // $extension = pathinfo($request->Image->getClientOriginalName(), PATHINFO_EXTENSION);
                    $imageName = $banner->USE_ID.'_'.$filename.'_'.time().'.'.$request->Avatar->extension();
                    $request->Avatar->move(public_path('data/banners'), $imageName);
                    $banner->Avatar = $imageName;
                    $banner->save();
                }
                return BaseResult::withData($banner);
            } catch (\Exception $e) {
                return BaseResult::error(500, $e->getMessage());
            }
        }
    }
    public function delete($id) {
        $banner = Banner::find($id);
        if($banner) {
            $oldFile = $banner->Avatar;
            if(File::exists(public_path('data/banners/'.$oldFile))) {
                File::delete(public_path('data/banners/'.$oldFile));
            }
            $banner->delete();
            return BaseResult::withData($banner);
        } else return BaseResult::error(404, "Data is not found!");
    }
}
