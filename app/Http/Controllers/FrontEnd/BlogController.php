<?php

namespace App\Http\Controllers\FrontEnd;

use App\Blog;
use App\BlogHasTag;
use App\Category;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function view($id = null) {
        if($id == null) {
            return view('frontend.blogs');
        } else {
            $blog = Blog::find($id);
            if($blog) {
                $category = Category::find($blog->CAT_ID);
                if($category) $blog->CategoryName = $category->Name;
                $blogHasTags = BlogHasTag::where('BLO_ID',$blog->BLO_ID)->get();
                $tags = array();
                foreach ($blogHasTags as $blogHasTag) {
                    $tag = Tag::find($blogHasTag->TAG_ID);
                    if($tag) array_push($tags, $tag);
                }
                $blog->Tags = $tags;
                return view('frontend.blog-single')->with('blog', $blog);
            }
            else return BaseResult::error(404, "Data is not found");
        }
    }
}
