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

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['faqs'] = Faqs::all();
        // print_r($data['comments']->toarray()); die;
        return view('faq.index', $data);
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
            'qustion' => 'required|string|max:255',
            'answer' => 'required',
        ]);

        $faq = new Faqs();
        $faq->qustion = $request->qustion;
        $faq->answer = $request->answer;
        $faq->status = $request->status ?? 0;
        $faq->save();

        return redirect()->route('faq.index')->with('success', 'Faq Added successfully!');
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
            'qustion' => 'required|string|max:255',
            'answer' => 'required',
        ]);

        $faq = Faqs::where('id',$id)->first();
        $faq->qustion = $request->qustion;
        $faq->answer = $request->answer;
        $faq->status = $request->status ?? 0;
        $faq->save();

        return redirect()->route('faq.index')->with('success', 'Faq Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Faqs::where('id',$id)->delete();
        return redirect()->route('faq.index')->with('success', 'Faq Deleted successfully!');
    }
}
