<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\Subscription;
use App\Models\SubscriptionFeature;
use App\Models\SubscriptionHistory;
use App\Models\SubscriptionOrder;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class SubscriptionController extends Controller
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
        $data['subscriptions'] = Subscription::with('categorysubscription')->orderBy('created_at','DESC')->get();
        return view('subscription.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['categories'] = Category::orderBy('created_at','DESC')->get();
        return view('subscription.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            "category_id"    => "required|array|min:1",
            'category_id.*' => "required|distinct|min:1",
            'no_of_ads' => 'required|integer',
            "name"    => "required|unique:subscriptions",
            'subscription_validity' => 'required|integer',
            'ad_validity' => 'required|integer',
            'mrp' => 'required',
            'discount' => 'required',
            'offer_price' => 'required',
            'detail' => 'required',
            'status' => 'required|integer',
        ]);
        if($validator->fails()){
            return redirect()->route('subscriptions.create')->with('error', $validator->errors());
            
        }
        
        $subscription = new Subscription();
        $subscription->no_of_ads = $request->no_of_ads ?? 0;
        $subscription->name = $request->name ?? NULL;
        $subscription->subscription_validity = $request->subscription_validity ?? 0;
        $subscription->ad_validity = $request->ad_validity ?? 0;
        $subscription->mrp = $request->mrp ?? 0;
        $subscription->discount = $request->discount ?? 0;
        $subscription->offer_price = $request->offer_price ?? 0;
        $subscription->mrp = $request->mrp ?? 0;
        $subscription->detail = $request->detail ?? NULL;
        $subscription->status = $request->status ?? 0;
        $subscription->icon = $request->icon;
        
        $subscription->save();
        $id = $subscription->id;
        if(!empty($request->category_id))
        {
            for($i=0;$i<count($request->category_id);$i++){
                CategorySubscription::create([
                    'category_id'=>$request->category_id[$i],
                    'subscription_id'=>$id,
                ]);
            }
        }

        if(!empty($request->feature))
        {
            for($i=0;$i<count($request->feature);$i++){
                SubscriptionFeature::create([
                    'feature'=>$request->feature[$i],
                    'subscription_id'=>$id,
                    'is_available'=>$request->is_available[$i]
                ]);
            }
        }

        // Redirect back with success message
        return redirect()->route('subscriptions.index')->with('success', 'Subscription added successfully!');
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
        $selectedcategories = array();
        $data['categories'] = Category::orderBy('created_at','DESC')->get();
        $data['result'] = Subscription::findOrFail($id);
        $data['features'] = SubscriptionFeature::where('subscription_id', $id)->get();
        $categorysubscriptions = CategorySubscription::where('subscription_id',$id)->get();
        if(isset($categorysubscriptions) && count($categorysubscriptions)>0)
        {
            foreach($categorysubscriptions as $res)
            {
                $selectedcategories[]=$res->category_id;
            }
        }
        
        $data['selectedcategories'] = $selectedcategories;
        return view('subscription.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            "category_id"    => "required|array|min:1",
            'category_id.*' => "required|distinct|min:1",
            "feature"    => "required|array|min:1",
            'no_of_ads' => 'required|integer',
            "name"    => "required|unique:subscriptions,name,".$id,
            'subscription_validity' => 'required|integer',
            'ad_validity' => 'required|integer',
            'mrp' => 'required',
            'discount' => 'required',
            'offer_price' => 'required',
            'detail' => 'required',
            'status' => 'required|integer',
        ]);
        if($validator->fails()){
            return redirect()->route('subscriptions.edit', $id)->with('error', $validator->errors());
            
        }
        
        $subscription = Subscription::findOrFail($id);

        $subscription->no_of_ads = $request->no_of_ads;
        $subscription->name = $request->name;
        $subscription->subscription_validity = $request->subscription_validity;
        $subscription->ad_validity = $request->ad_validity;
        $subscription->mrp = $request->mrp;
        $subscription->discount = $request->discount;
        $subscription->offer_price = $request->offer_price;
        $subscription->detail = $request->detail;
        $subscription->status = $request->status;
        $subscription->icon = $request->icon;
        
        $subscription->save();

        CategorySubscription::where('subscription_id',$id)->delete();

        if(!empty($request->category_id))
        {
            for($i=0;$i<count($request->category_id);$i++){
                CategorySubscription::create([
                    'category_id'=>$request->category_id[$i],
                    'subscription_id'=>$id,
                ]);
            }
        }
        SubscriptionFeature::where('subscription_id',$id)->delete();
        if(!empty($request->feature))
        {
            for($i=0;$i<count($request->feature);$i++){
                SubscriptionFeature::create([
                    'feature'=>$request->feature[$i],
                    'subscription_id'=>$id,
                    'is_available'=>$request->is_available[$i]
                ]);
            }
        }

        // Redirect back with success message
        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subscription = Subscription::findOrFail($id);
        CategorySubscription::where('subscription_id',$id)->delete();
        SubscriptionFeature::where('subscription_id',$id)->delete();
        $subscription->delete();
        return redirect()->route('subscriptions.index')->with('success', 'Subscription deleted successfully!');
    }
    
    
    public function approvedPayments()
    {
        //
        $data['subscriptionshis'] = SubscriptionHistory::with('customers', 'subscriptions')->where('payment_status', 'Completed')->orderBy('created_at','DESC')->get();
        return view('subscription.approved-payments',$data);
    }
    public function pendingPayments()
    {
        //
        $data['subscriptionshis'] = SubscriptionHistory::with('customers', 'subscriptions')->where('payment_status', '!=','Completed')->orderBy('created_at','DESC')->get();
        return view('subscription.pending-payments',$data);
    }
    public function approvepaymentStatus(string $id)
    {
        //
        $subscription = SubscriptionHistory::findOrFail($id);
        if(!empty($subscription))
        {
            $transactionId = $subscription->transaction_id;
            $subscription->approval_date = date('Y-m-d H:i:s');
            $subscription->payment_status = 'Completed';
            $subscription->save();
            
            $order = SubscriptionOrder::where('transaction_id',$transactionId)->first();
            if(!empty($order))
            {
                $order->approval_date = date('Y-m-d H:i:s');
                $order->payment_status = 'Completed';
                $order->save();
            }
             return redirect()->route('transactions.approved-payments')->with('success', 'Payment approved successfully!');
        }
        else
        {
             return redirect()->route('transactions.pending-payments')->with('error', 'Payment not found!');
        }
        
       
    }
     public function rejectpaymentStatus(string $id)
    {
        //
        $subscription = SubscriptionHistory::findOrFail($id);
        if(!empty($subscription))
        {
            $transactionId = $subscription->transaction_id;
            $subscription->payment_status = 'Rejected';
            $subscription->save();
            
            $order = SubscriptionOrder::where('transaction_id',$transactionId)->first();
            if(!empty($order))
            {
                $order->payment_status = 'Rejected';
                $order->save();
            }
             return redirect()->route('transactions.pending-payments')->with('success', 'Payment rejected successfully!');
        }
        else
        {
             return redirect()->route('transactions.pending-payments')->with('error', 'Payment not found!');
        }
        
       
    }
}
