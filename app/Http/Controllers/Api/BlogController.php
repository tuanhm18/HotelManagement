<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\BlogHasTag;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BlogController extends Controller
{
    public function get($id = null)
    {
        if ($id == null) {
            $blogs = Blog::all();
            return BaseResult::withData($blogs);
        } else {
            $blog = Blog::find($id);
            if ($blog) return BaseResult::withData($blog);
            else return BaseResult::error(404, "Data is not found");
        }
    }
    public function create(Request $request)
    {
        $blog = new Blog();
        $blog->Title = $request->Title;
        $blog->Description = $request->Description;
        $blog->Details = $request->Details;
        $blog->IsHot = $request->IsHot == "on" ? 1 : 0;
        $blog->IsPublished = $request->IsPublished == "on" ? 1 : 0;
        $blog->CAT_ID = $request->CAT_ID;
        try {
            $blog->save();
            foreach ($request->Tags as $tag) {
                if (!is_numeric($tag)) {
                    $newTag = new Tag();
                    $newTag->Name = $tag;
                    $newTag->save();
                    $blogHasTag = new BlogHasTag();
                    $blogHasTag->BLO_ID = $blog->BLO_ID;
                    $blogHasTag->TAG_ID = $newTag->TAG_ID;
                    $blogHasTag->save();
                } else {
                    $blogHasTag = new BlogHasTag();
                    $blogHasTag->BLO_ID = $blog->BLO_ID;
                    $blogHasTag->TAG_ID = $tag;
                    $blogHasTag->save();
                }
            }
            if ($request->hasfile('Avatar')) {
                $fileName = pathinfo($request->Avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = $blog->BLO_ID . '_' . $fileName . '_' . time() . '_' . $request->Avatar->extension();
                $request->Avatar->move(public_path('data/blogs'), $imageName);
                $blog->Avatar = $imageName;
                $blog->save();
            }
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
        return BaseResult::withData($blog);
    }
    public function update(Request $request, $id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            $blog->Title = $request->Title;
            $blog->Description = $request->Description;
            $blog->Details = $request->Details;
            $blog->IsHot = $request->IsHot;
            $blog->IsPublished = $request->IsPublished;
            $blog->CAT_ID = $request->CAT_ID;
            $blog->UpdatedDate = Carbon::now();
            try {
                $blog->save();
                $blogHasTags = BlogHasTag::where('BLO_ID', $blog->BLO_ID)->get();
                foreach ($blogHasTags as $tag) {
                    try {
                        $tag->delete();
                    } catch (\Exception $e) {
                        return BaseResult::error(500, $e->getMessage());
                    }
                }
                foreach ($request->Tags as $tag) {
                    if (!is_numeric($tag)) {
                        $newTag = new Tag();
                        $newTag->Name = $tag;
                        $newTag->save();
                        $blogHasTag = new BlogHasTag();
                        $blogHasTag->BLO_ID = $blog->BLO_ID;
                        $blogHasTag->TAG_ID = $newTag->TAG_ID;
                        $blogHasTag->save();
                    } else {
                        $blogHasTag = new BlogHasTag();
                        $blogHasTag->BLO_ID = $blog->BLO_ID;
                        $blogHasTag->TAG_ID = $tag;
                        $blogHasTag->save();
                    }
                }
                if ($request->hasfile('Avatar')) {
                    $oldFile = $blog->Avatar;
                    if (File::exists(public_path('data/blogs/' . $oldFile))) {
                        File::delete(public_path('data/blogs/' . $oldFile));
                    }
                    $fileName = pathinfo($request->Avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $blog->DIS_ID . '_' . $fileName . '_' . time() . '_' . $request->Avatar->extension();
                    $request->Avatar->move(public_path('data/blogs'), $imageName);
                    $blog->Avatar = $imageName;
                    $blog->save();
                }
            } catch (\Exception $e) {
                return BaseResult::error(500, $e->getMessage());
            }
            return BaseResult::withData($blog);
        }
    }
}
