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

use App\Models\Pages;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pages'] = Pages::all();
        return view('pages.index', $data);
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
            'name' => 'required|string|max:255',
            'heading' => 'required',
            'detail_content' => 'required',
        ]);

        $page = new Pages();
        $page->name = $request->name;
        $page->heading = $request->heading;
        $page->detail_content = $request->detail_content;
        $page->meta_title = $request->meta_title;
        $page->meta_keyword = $request->meta_keyword;
        $page->meta_description = $request->meta_description;
        $page->canonical = $request->canonical;
        $page->status = $request->status;
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page Added successfully!');
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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'heading' => 'required',
            'detail_content' => 'required',
        ]);

        $page = Pages::where('id', $id)->first();
        $page->name = $request->name;
        $page->heading = $request->heading;
        $page->detail_content = $request->detail_content;
        $page->meta_title = $request->meta_title;
        $page->meta_keyword = $request->meta_keyword;
        $page->meta_description = $request->meta_description;
        $page->canonical = $request->canonical;
        $page->status = $request->status;
        $page->save();

        return redirect()->route('pages.index')->with('success', 'Page Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Pages::where('id', $id)->delete();
        return redirect()->route('pages.index')->with('success', 'Page Deleted successfully!');
    }

    public function addEditorImage(Request $request)
    {
        $path  = config('image.profile_image_path_view');
        $link = CommonController::saveImage($request->image, $path , 'editorImages');
        return response()->json(['url' => $link]);
    }

    public function deleteEditorImage(Request $request)
    {
        $path = parse_url($request->url, PHP_URL_PATH);
        $storagePos = strpos($path, '/storage');

        $pathurl = substr($path, $storagePos + strlen('/storage'));

        if(File::exists('storage'.$pathurl))
        {
            File::delete('storage'.$pathurl);
        }
        return response()->json(['status' => true, 'msg' => 'Image delete from storage.']);
    }
}
