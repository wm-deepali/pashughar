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
use App\Models\Category;
use App\Models\State;
use App\Models\City;
use App\Models\UserEnquiry;

use Mail;
use App\Mail\EmailVerificationEmail;
use App\Mail\UserEnquirySend;
use App\Mail\UserEnquirySendToAdmin;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function bulkEnquiry()
    {
        $data['categorys'] = Category::all();
        $data['states'] = State::where('status',1)->get();
        // print_R($data['states'] ->toarray()); die;
        return view('front.bulk-enquiry', $data);
    }

    public function getCites(Request $request)
    {
        $cites = City::where('state_id',$request->id)->get();
        // print_R($cites); die;
        return response()->json($cites);
    }

    public function addEnquiry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'mobile' => 'required',
            'order_qty' => 'required',
            'category_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'code' => 'required',
        ]);

        $category = Category::find($request->category_id);
        $state = State::find($request->state_id);
        $city = City::find($request->city_id);

        $enquiry  = new UserEnquiry();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->mobile = $request->mobile;
        $enquiry->telephones = $request->telephones;
        $enquiry->order_qty = $request->order_qty;
        $enquiry->detail = $request->detail;
        $enquiry->category_id = $request->category_id;
        $enquiry->state_id = $request->state_id;
        $enquiry->city_id = $request->city_id;
        $enquiry->code = $request->code;
        $enquiry->save();

        //mail Send
            $usermailData = [
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'telephones'=>$request->telephones,
                'order_qty'=>$request->order_qty,
                'detail'=>$request->detail,
                'category'=>$category->name,
                'state'=>$state->name,
                'city'=>$city->name,
                'code'=>$request->code,
            ];
            $mailContent =  Mail::to($request->email)->send(new UserEnquirySend($usermailData));

            $mailContent =  Mail::to('admin@afaraltmart.com')->send(new UserEnquirySendToAdmin($usermailData));
        //

        return redirect()->back()->with('success', 'Enquiry Send successfully!');
    }

    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
