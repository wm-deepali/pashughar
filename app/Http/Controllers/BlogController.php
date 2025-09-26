<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\CommonController;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\Blogs;
use App\Models\Pages;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['blogs'] = Blogs::all();
        return view('blogs.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'title' => 'required|string|max:255',
            'short_description' => 'required',
            'detail_content' => 'required',
        ]);


        $thumbImage = null;
        if ($request->thumb_image) {
            $path = config('image.profile_image_path_view');
            $thumbImage = CommonController::saveImage($request->thumb_image, $path, 'bannerThumbImages');
        }

        $bannerImage = null;
        if ($request->banner_image) {
            $path = config('image.profile_image_path_view');
            $bannerImage = CommonController::saveImage($request->banner_image, $path, 'bannerImages');
        }

        $blogs = new Blogs();
        $blogs->title = $request->title;
        $blogs->slug = $request->slug ?: \Str::slug($request->title); // generate slug if not provided
        $blogs->short_description = $request->short_description;
        $blogs->detail_content = $request->detail_content;
        $blogs->thumb_image = $thumbImage;
        $blogs->thumb_alt = $request->thumb_alt;
        $blogs->banner_image = $bannerImage;
        $blogs->banner_alt = $request->banner_alt;
        $blogs->meta_title = $request->meta_title;
        $blogs->meta_keyword = $request->meta_keyword;
        $blogs->meta_description = $request->meta_description;
        $blogs->canonical = $request->canonical;
        $blogs->status = $request->status;
        $blogs->save();

        return redirect()->route('blogs.index')->with('success', 'Blog Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required',
            'detail_content' => 'required',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
        ]);

        $blogs = Blogs::where('id', $id)->first();

        $thumbImage = $blogs->thumb_image;
        if ($request->thumb_image) {
            $path = parse_url($blogs->thumb_image, PHP_URL_PATH);
            $storagePos = strpos($path, '/storage');

            $pathurl = substr($path, $storagePos + strlen('/storage'));

            if (File::exists('storage' . $pathurl)) {
                File::delete('storage' . $pathurl);
            }

            $path = config('image.profile_image_path_view');
            $thumbImage = CommonController::saveImage($request->thumb_image, $path, 'bannerThumbImages');
        }

        $bannerImage = $blogs->banner_image;
        if ($request->banner_image) {
            $path = parse_url($blogs->banner_image, PHP_URL_PATH);
            $storagePos = strpos($path, '/storage');

            $pathurl = substr($path, $storagePos + strlen('/storage'));

            if (File::exists('storage' . $pathurl)) {
                File::delete('storage' . $pathurl);
            }

            $path = config('image.profile_image_path_view');
            $bannerImage = CommonController::saveImage($request->banner_image, $path, 'bannerImages');
        }

        $blogs->title = $request->title;
        $blogs->short_description = $request->short_description;
        $blogs->slug = $request->slug ?: \Str::slug($request->title); // update slug
        $blogs->detail_content = $request->detail_content;
        $blogs->thumb_image = $thumbImage;
        $blogs->thumb_alt = $request->thumb_alt;
        $blogs->banner_image = $bannerImage;
        $blogs->banner_alt = $request->banner_alt;
        $blogs->meta_title = $request->meta_title;
        $blogs->meta_keyword = $request->meta_keyword;
        $blogs->meta_description = $request->meta_description;
        $blogs->canonical = $request->canonical;
        $blogs->status = $request->status;
        $blogs->save();

        return redirect()->route('blogs.index')->with('success', 'Blog Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blogs::where('id', $id)->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog Deleted successfully!');
    }
}
