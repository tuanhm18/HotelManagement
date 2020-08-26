<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\RoomType;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function view() {
       return view('frontend.site');
    }
}
