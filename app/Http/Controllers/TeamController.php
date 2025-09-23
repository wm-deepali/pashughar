<?php

namespace App\Http\Controllers;

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

use App\Models\UserEnquiry;
use App\Models\Teams;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['teams'] = Teams::all();
        // print_r($data['enquries']->toarray()); die;
        return view('teams.index', $data);
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
            'designation' => 'required',
        ]);

        $image = null;
        if($request->image)
        {
            $path  = config('image.profile_image_path_view');
            $image = CommonController::saveImage($request->image, $path , 'teamImage');
        }

        $team  = new Teams();
        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->image = $image;
        $team->status = $request->status ?? 0;
        $team->save();


        return redirect()->route('teams.index')->with('success', 'Team Added successfully!');
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
            'name' => 'required|string|max:255',
            'designation' => 'required',
        ]);

        $team  = Teams::where('id',$id)->first();

        $image = $team->image;
        if($request->image)
        {
            $path = parse_url($team->image, PHP_URL_PATH);
            $storagePos = strpos($path, '/storage');

            $pathurl = substr($path, $storagePos + strlen('/storage'));

            if(File::exists('storage'.$pathurl))
            {
                File::delete('storage'.$pathurl);
            }

            $path  = config('image.profile_image_path_view');
            $image = CommonController::saveImage($request->image, $path , 'teamImage');
        }

        $team->name = $request->name;
        $team->designation = $request->designation;
        $team->image = $image;
        $team->status = $request->status ?? 0;
        $team->save();


        return redirect()->route('teams.index')->with('success', 'Team Updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Teams::where('id',$id)->delete();
        return redirect()->route('teams.index')->with('success', 'Team Deleted successfully!');
    }
}
