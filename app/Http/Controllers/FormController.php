<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Feature;
use App\Models\SubCategory;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class FormController extends Controller
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
        //
        $data['features'] = Feature::with('category', 'subcategory')->orderBy('created_at','DESC')->get();
        return view('form.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('created_at','DESC')->get();
        $data['features']= featcherformData();
        return view('form.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            // "features"    => "required|array|min:1",
            // 'features.*' => "required|string|distinct|min:1",
        ]);
        if($validator->fails()){
            return redirect()->route('form-features.create')->with('error', $validator->errors());
            
        }
        
       // $ffeatures = array_filter($request->features, 'strlen');
        
        $feature = new Feature();
        $feature->category_id = $request->category_id;
        $feature->subcategory_id = $request->subcategory_id ?? NULL;
        $feature->features = json_encode($request->features) ?? NULL;
        
        $feature->save();

        // Redirect back with success message
        return redirect()->route('form-features.index')->with('success', 'Features added successfully!');
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
        $data['categories'] = Category::orderBy('created_at','DESC')->get();
        $data['features']= featcherformData();
        $result=Feature::findOrFail($id);
        $data['result'] = $result;
        $data['subcategories'] = SubCategory::where('category_id',$result->category_id)->get();
        return view('form.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            // "features"    => "required|array|min:1",
            // 'features.*' => "required|string|distinct|min:1",
        ]);
        if($validator->fails()){
            return redirect()->route('form-features.edit', $id)->with('error', $validator->errors());
            
        }
        
        $feature = Feature::findOrFail($id);
        $feature->category_id = $request->category_id;
        $feature->subcategory_id = $request->subcategory_id ?? $feature->subcategory_id;
        $feature->features = json_encode($request->features) ?? $feature->features;
        
        $feature->save();

        // Redirect back with success message
        return redirect()->route('form-features.index')->with('success', 'Features updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $feature = Feature::findOrFail($id);
        
        $feature->delete();

        // Redirect back with success message
        return redirect()->route('form-features.index')->with('success', 'Features deleted successfully!');
    }
}
