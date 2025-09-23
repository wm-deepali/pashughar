<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seo;
use App\Models\Slug;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class SeoController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['seo'] = Seo::with('slugname')->orderBy('created_at','DESC')->get();
        return view('seo.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['slugs'] = Slug::get();
        return view('seo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"    => "required|unique:manage_seo",
            'meta_title' => 'required',
            "meta_keyword"    => "required",
            'meta_description' => 'required',
            'canonical' => 'required',
           ]);
        if($validator->fails()){
            return redirect()->route('manage-seo.create')->with('error', $validator->errors());
            
        }
        
        $seo = new Seo();
        $seo->name = $request->name;
        $seo->meta_title = $request->meta_title;
        $seo->meta_keyword = $request->meta_keyword;
        $seo->meta_description = $request->meta_description;
        $seo->canonical = $request->canonical;
       
        $seo->save();
        
        // Redirect back with success message
        return redirect()->route('manage-seo.index')->with('success', 'Seo details added successfully!');
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
        $data['slugs'] = Slug::get();
         $data['result'] = Seo::findOrFail($id);
         return view('seo.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $validator = Validator::make($request->all(), [
           "name"    => "required|unique:manage_seo,name,".$id,
            'meta_title' => 'required',
            "meta_keyword"    => "required",
            'meta_description' => 'required',
            'canonical' => 'required',
         ]);
        if($validator->fails()){
             return redirect()->route('manage-seo.edit', $id)->with('error', $validator->errors());
            
        }
        
        $seo = Seo::findOrFail($id);
        $seo->name = $request->name;
        $seo->meta_title = $request->meta_title;
        $seo->meta_keyword = $request->meta_keyword;
        $seo->meta_description = $request->meta_description;
        $seo->canonical = $request->canonical;
       
        $seo->save();

        
        // Redirect back with success message
        return redirect()->route('manage-seo.index')->with('success', 'Seo details updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $seo = Seo::findOrFail($id);
        $seo->delete();
        return redirect()->route('manage-seo.index')->with('success', 'Seo details deleted successfully!');
    }
}
