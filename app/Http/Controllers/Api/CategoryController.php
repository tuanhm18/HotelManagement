<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Response\BaseResult;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function get($id = null) {
        if($id == null) {
            $categories = Category::all();
            return BaseResult::withData($categories);
        } else {
            $category = Category::find($id);
            if($category) return BaseResult::withData($category);
            else return BaseResult::error(404, "Data is not found");
        }
    }
    public function create(Request $request) {
        $category = new Category;
        $category->Name = $request->Name;
        try {
            $category->save();
            return BaseResult::withData($category);
        } catch (\Exception $e) {
            return BaseResult::error(500, $e->getMessage());
        }
    }
}
