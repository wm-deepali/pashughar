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
use App\Models\Comments;
use App\Models\Faqs;
use App\Models\Abouts;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['abouts'] = Abouts::all();
        // print_r($data['comments']->toarray()); die;
        return view('about.index', $data);
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
            'heading' => 'required|string|max:255',
            'short_description' => 'required',
            'detail_content' => 'required',
        ]);

        $about = new Abouts();
        $about->heading = $request->heading;
        $about->short_description = $request->short_description;
        $about->detail_content = $request->detail_content;
        $about->status = $request->status ?? 0;
        $about->save();

        return redirect()->route('abouts.index')->with('success', 'About Added successfully!');
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
            'heading' => 'required|string|max:255',
            'short_description' => 'required',
            'detail_content' => 'required',
        ]);

        $about = Abouts::where('id',$id)->first();
        $about->heading = $request->heading;
        $about->short_description = $request->short_description;
        $about->detail_content = $request->detail_content;
        $about->status = $request->status ?? 0;
        $about->save();

        return redirect()->route('abouts.index')->with('success', 'About Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
