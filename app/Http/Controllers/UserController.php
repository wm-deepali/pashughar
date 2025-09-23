<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\Subscription;
use App\Models\SubCategory;
use App\Models\SubscriptionHistory;
use App\Models\SubscriptionOrder;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\State;
use App\Models\City;
use App\Models\Ad;
use App\Models\AdFeature;
use App\Models\Enquiry;
use App\Models\Review;
use App\Models\AdImage;
use App\Models\AdSpecification;
use App\Models\Member;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class UserController extends Controller
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
        $data['users'] = Member::all();
        return view('users.index',$data);
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
        try {
            $user = Member::with('ads', 'cityname', 'statename', 'countryname','activeSubscription')->where('id', $id)->first();
            return response()->json([
                "msgCode" => "200",
                "html" => view('users.preview-user')->with('user',$user)->render(),
            ]);
        } catch(\Exception $ex) {
            return response()->json([
                'msgCode' => '400',
                'msgText' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Member::with('ads')->where('id', $id)->first();
        $data['states']=State::where('country_id',1)->get();
        if($user->state !='')
        {
            $data['cities']=City::where('state_id',$user->state)->get();
        }
        //
        
        $data['user'] = $user;
        return view('users.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = Member::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'full_name'=>'required',
            'email' => 'required|email|unique:members,email,'.$id,
            'mobile' => 'required|unique:members,mobile,'.$id,
            'status'=>'required',
        ]);
        if($validator->fails()){
            return redirect()->route('manage-users.edit', $id)
            ->with('error', $validator->errors());
        }
        else{
            
             if ($request->has('password')) {
                 if($request->password !='')
                 {
                     $user->password = Hash::make($request->password);
                 }
             }
            if ($request->hasFile('profile_pic')) {
                if ($user->profile_pic) {
                    Storage::delete($user->profile_pic);
                }

                // Store the new image
                $path = $request->file('profile_pic')->store('members', 'public');
                $user->profile_pic = $path;
            }
            
            

            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->status=$request->status;
            $user->address=$request->address;
            $user->state=$request->state;
            $user->city=$request->city;
            $user->zipcode=$request->zipcode;
            $user->remark=$request->remark;
            $user->country = 1;
            $user->save();
            return redirect()->route('manage-users.index')
                ->with('success', 'User Updated successfully');
            
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = Member::findOrFail($id);
        $ads = Ad::where('user_id', $id)->get();
        if(isset($ads) && count($ads)>0)
        {
            foreach($ads as $ad)
            {
                AdFeature::where('ad_id',$ad->id)->delete();
                AdImage::where('ad_id',$ad->id)->delete();
                Enquiry::where('ad_id',$ad->id)->delete();
                Review::where('ad_id',$ad->id)->delete();
                AdSpecification::where('ad_id',$ad->id)->delete();
            }
            $ads->each->delete();
        }
        $subscriptionhis = SubscriptionHistory::where('user_id', $id)->delete();
        $subscriptionorder = SubscriptionOrder::where('user_id', $id)->delete();
        $user->delete();
        return redirect()->route('manage-users.index')->with('success', 'User deleted successfully!');
    }
    
    public function userSubscriptions()
    {
        //
        $data['usersubscriptions'] = SubscriptionHistory::with('customers', 'subscriptions')->orderBy('created_at','DESC')->get();
        return view('users.manage-user-subscriptions',$data);
    }
    
    public function orderDetails(string $id)
    {
        //
        $subscription = SubscriptionHistory::with('subscriptions')->where('id', $id)->first();
        if(isset($subscription) && !empty($subscription))
        {
            $orderId = $subscription->order_number;
            $totalAds = Ad::where('plan_id', $orderId)->count();
            $pendingAds = Ad::where('plan_id', $orderId)->where('status','Pending')->count();
            $publishedAds = Ad::where('plan_id', $orderId)->where('status','Published')->count();
            
            $data['totalAds'] = $totalAds;
            
            $data['publishedAds'] = $publishedAds;
            $data['pendingAds'] = $pendingAds;
        }
        
        $data['subscription'] = $subscription;
        return view('users.order-details',$data);
    }
}
