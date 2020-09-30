<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class FriendlyUrl extends Model
{
    public static function convertToFriendlyUrl($url)
    {
        $url = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $url);
        $url = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $url);
        $url = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $url);
        $url = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $url);
        $url = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $url);
        $url = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $url);
        $url = preg_replace("/(đ)/", 'd', $url);
        $url = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $url);
        $url = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $url);
        $url = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $url);
        $url = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $url);
        $url = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $url);
        $url = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $url);
        $url = preg_replace("/(Đ)/", 'D', $url);
        $url = preg_replace("/(-|&|:|\.|,|#|\(|\)|$|%|\?)/", '', $url);
        $url = preg_replace("/(_|\/)/", '-', $url);
        $url = preg_replace("/( +)/", '-', $url);                        
        return strtolower($url);
    
    }
}
