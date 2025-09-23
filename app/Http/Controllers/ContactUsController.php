<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Subscriber;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class ContactUsController extends Controller
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
        $data['contacts'] = ContactUs::all();
        return view('contactus.index',$data);
    }
    public function manageSubscriber()
    {
        //
        $data['subscribers'] = Subscriber::all();
        return view('subscriber.index',$data);
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
        $user = ContactUs::findOrFail($id);
        $user->delete();
        return redirect()->route('manage-contact-us.index')->with('success', 'Enquiry deleted successfully!');
    }
    public function deleteSubscriber(string $id)
    {
        //
        $user = Subscriber::findOrFail($id);
        $user->delete();
        return redirect()->route('manage-subscribers')->with('success', 'Subscriber deleted successfully!');
    }
}
