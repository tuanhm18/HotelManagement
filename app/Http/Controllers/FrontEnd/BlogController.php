<?php

namespace App\Http\Controllers\FrontEnd;

use App\Blog;
use App\BlogHasTag;
use App\Category;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use App\Tag;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class BlogController extends Controller
{
    public function view($id = null) {
        if($id == null) {
            return view('frontend.blogs');
        } else {
            $blog = Blog::find($id);
            if($blog) {
                $category = Category::find($blog->CAT_ID);
                if($category) $blog->Category = $category;
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
    public function getBlogByCategories($id, $Name = null) {
        $blogs = Blog::where("CAT_ID", $id)->paginate(6);
        if($blogs) return view('frontend.blogs')->with("blogs", $blogs);
        else return view("frontend.blogs");
    }
    public function getBlogByTags($id) {
        $blogHasTags = BlogHasTag::where('TAG_ID', $id)->get();
        if($blogHasTags) {
            $blogs = array();
            foreach ($blogHasTags as $blogHasTag) {
                $tags = array();
                $blog = Blog::find($blogHasTag->BLO_ID);
                if($blog) {
                    $tempBlogHasTags = BlogHasTag::where("BLO_ID", $blog->BLO_ID)->get();
                    foreach ($tempBlogHasTags as $tempBlogHasTag) {
                        $tag = Tag::find($tempBlogHasTag->TAG_ID);
                        if($tag) array_push($tags, $tag);
                    }
                    $blog->Tags = $tags;
                    array_push($blogs, $blog);
                }
            }
            $blogs = $this->paginate($blogs, 6);
            return view("frontend.blogs")->with("blogs", $blogs);
        }
        return view("frontend.blogs");
    }
    public function paginate($items, $perPage, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
}
