<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\CommonController;

use Illuminate\Support\Facades\Validator;

use App\Models\ContactusContent;


class ContactusContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['abouts'] = ContactusContent::all();
        // print_r($data['comments']->toarray()); die;
        return view('contactus-content.index', $data);
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
            'mobile' => 'required',
            'email' => 'required',
            'address_line1' => 'required',
        ]);

        $about = new ContactusContent();
        $about->mobile = $request->mobile;
        $about->email = $request->email;
        $about->address_line1 = $request->address_line1;
        $about->address_line2 = $request->address_line2 ?? null;
        $about->save();

        return redirect()->route('contactus-content.index')->with('success', 'content Added successfully!');
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
            'mobile' => 'required',
            'email' => 'required',
            'address_line1' => 'required',
        ]);

        $about = ContactusContent::where('id',$id)->first();
         $about->mobile = $request->mobile;
        $about->email = $request->email;
        $about->address_line1 = $request->address_line1;
        $about->address_line2 = $request->address_line2 ?? null;
        $about->save();


        return redirect()->route('contactus-content.index')->with('success', 'content Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
