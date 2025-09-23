<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;

class CommonController extends Controller
{
    public static function saveImage($image, $path, $filename)
    {
        $path  =  base_path($path);

        $image_extension    = $image->getClientOriginalExtension();
        $image_size         = $image->getSize();
        $type               = $image->getMimeType();

        $new_name           = rand(1111, 9999) . date('mdYHis') . uniqid() . '.' . $image_extension;
        $thumbnail_name     = 'thumbnail_' . rand(1111, 9999) . date('mdYHis') . uniqid() . '.' .  $image_extension;

        $image->move("storage/app/images/$filename", $new_name);

        $userImageUrl = "/storage/app/images/$filename/".$new_name;
        if($userImageUrl){
            return $userImageUrl;
        }else{
            return null;
        }
    }
}
