<?php

namespace App\Http\Controllers\Api;

use App\BlogHasTag;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getBlogTags($id) {
        $tags = BlogHasTag::where('BLO_ID', $id)->get();
        foreach ($tags as $tag) {
            $tempTag = Tag::find($tag->TAG_ID);
            if($tempTag) {
                $tag->Name = $tempTag->Name;
            }
        }
        return BaseResult::withData($tags);
    }
    public function get($id = null) {
        if($id == null) {
            $tags = Tag::all();
            return BaseResult::withData($tags);
        } else {
            $tag = Tag::find($id);
            if($tag) return BaseResult::withData($tag);
            else return BaseResult::error(404, "Data is not found");
        }
    }
}
