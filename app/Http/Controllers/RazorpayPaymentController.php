<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Categories;
use App\Models\InvoiceSetting;
use App\Models\WalletAmount;
use App\Models\OtherSetting;
use App\Models\Subcategories;
use App\Models\Subscription;
use App\Models\SubscriptionFeature;
use App\Models\CategorySubscription;
use App\Models\SubscriptionOrder;
use App\Models\Member;
use App\Models\RazorpaySetting;
use Session;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Post;
use App\Exports\PostExport;
use App\Exports\SubscriptionExport;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
use App\Models\Event;
use App\Models\StoreEvent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Mail\ActivationAccount;
use Razorpay\Api\Api;
use Exception;

class RazorpayPaymentController extends Controller
{
	public function createOrder($amount, $email)
    {
		if(Auth::guard('member')->check())
        {
            $authEmail = Auth::guard('member')->user()->email;
			if($authEmail == $email)
			{
				$setting            = RazorpaySetting::first();
        		$api                = new Api($setting->key_id, $setting->secret_id);
				
				$order = $api->order->create(array('receipt' => '123', 'amount' => $amount*100, 'currency' => 'INR', 'notes'=> []));
				if($order)
				{
					//dd($order->id);
					return response()->json([
						"success" => true,
						"key"=>$setting->key_id,
						"order"=>$order->id
					]);
				}
				else{
					return response()->json([
						"success" => false,
						"msgText"=>'Order Not created'
					]);
				}
			}
		}
	}
    public function store(Request $request)
    {
        $input              = $request->all();
		
        $subscription_id    = $request->id;
        $setting            = RazorpaySetting::first();
        $api                = new Api($setting->key_id, $setting->secret_id);
        $payment            = $api->payment->fetch($input['razorpay_payment_id']);
        
        $user_id 	        = Auth::guard('member')->user()->id;
        //$rand 		        = mt_rand(1500, 5000);
        $result 		    = DB::table('subscriptions')->where('id',$subscription_id)->get();
		$no_of_ads 		    = $result[0]->no_of_ads;
		$ads_validity 	    = $result[0]->ad_validity;
		$categorysubscriptions 	    = CategorySubscription::where('subscription_id',$subscription_id)->pluck('category_id');
		foreach ($categorysubscriptions as $categoryId) {
			$category_id_data[] = $categoryId;
		}
		$category_id = implode(", ", $category_id_data);
		$package_validity 	= $result[0]->subscription_validity;
		$dates 	            = date("d-m-Y");	
		$date   	        = date_create($dates);
		date_add($date,date_interval_create_from_date_string($package_validity."days"));
		$subscription_expiry = date_format($date,"Y-m-d");
		
		$paymentmethod  = 'online';
		$payment_status = 'Completed';
		$transaction_id = $input['razorpay_payment_id'];

		$mrp = $result[0]->mrp;
		$offered_price = $result[0]->offer_price;
		$discount_amount = $result[0]->discount;
		$adminsetting = OtherSetting::first();
		$adminsetting2 = InvoiceSetting::first();
		$user = Member::findOrFail($user_id);

		if($adminsetting2->state == $user->state){
			$gst_type  = "CGST + SGST";
			$gst_percent  = $adminsetting2->cgst + $adminsetting2->sgst;
			$total_gst = $offered_price * ($adminsetting2->cgst + $adminsetting2->sgst)/100;
		}else{
			$gst_type  = "IGST";
			$gst_percent  = $adminsetting2->igst;
			$total_gst = $offered_price * ($adminsetting2->igst)/100;
		}
		
        if(count($input)>0  && !empty($input['razorpay_payment_id'])) {
			
            try {
                //$response           = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
                $subscriber_exists  = DB::table('subscription_orders')->where('user_id',$user_id)->where('category_id',$category_id)->exists();
                
		        if($subscriber_exists)
		        {
			        DB::table('subscription_orders')->where('user_id',$user_id)->where('category_id',$category_id)->update(array('user_id'=>$user_id,'subscription_id'=>$request->id,'transaction_id'=>$transaction_id,'payment_method'=>$paymentmethod,'payment_status'=>$payment_status,'used_ads'=>'0','remaining_ads'=>$no_of_ads,'subscription_validity'=>$ads_validity,'category_id'=>$category_id,'delete_status'=>'0','status'=>'0'));

		        }else
		        {
			        $userprofile					= new SubscriptionOrder;
    			    $userprofile->user_id 					= $user_id;
        			$userprofile->subscription_id 			= $request->id;
        			$userprofile->transaction_id			= $transaction_id;
        			$userprofile->payment_method			= $paymentmethod;
        			$userprofile->payment_status			= $payment_status;
        			$userprofile->used_ads					= '0';
        			$userprofile->remaining_ads				= $no_of_ads;
        			$userprofile->subscription_expiry 	=   $subscription_expiry;
        			$userprofile->subscription_validity		= $package_validity;
        			$userprofile->category_id   			= $category_id;
        			$userprofile->delete_status				= '0';
        			$userprofile->status 					= '0';
        			$userprofile->save();
					//dd($userprofile);
		        }
		        

		        $data = DB::table('subscription_history')->insert(
			        array(
        				'user_id'				=> $user_id,
        				'subscription_id'		=> $request->id,
						'order_number'			=>$payment->order_id,
        				'transaction_id'		=> $transaction_id,
        				'payment_method'		=> $paymentmethod,
        				'payment_status'		=> $payment_status,
        				'used_ads'				=> '0',
        				'remaining_ads'			=> $no_of_ads,
						'mrp'					=> $mrp,
						'discount_amount'		=> $discount_amount,
						'offered_price'			=> $offered_price,
						'gst_type'				=> $gst_type,
						'gst_amount'			=> $total_gst,
						'order_amount_with_gst'	=> number_format($offered_price, 2) + number_format($total_gst, 2),
						'wallet_used_amount'	=> ($offered_price + $total_gst) - ($payment->amount/100),
        				'subscription_expiry'	=> $subscription_expiry,
        				'subscription_validity'	=> $package_validity,
        				'category_id'			=> $category_id,
        				'delete_status'			=> '0',
        				'status'				=> '0'
        			));

					$user->no_of_ads = $user->no_of_ads + $no_of_ads;
					$user->user_type ='Paid';
					$user->expiry_date = $subscription_expiry;
					$user->active_subscription_id=$request->id;
					$user->wallet_points =$user->wallet_points - ((($offered_price + $total_gst) - ($payment->amount/100))*$adminsetting->point_value);
					$user->used_wallet_points =$user->used_wallet_points + ((($offered_price + $total_gst) - ($payment->amount/100))*$adminsetting->point_value);
					$user->save();
					
					$user = Member::findOrFail($user_id);
					$wAmount = (($offered_price + $total_gst) - ($payment->amount/100))*$adminsetting->point_value;
					if($wAmount > 0)
					{
						$WalletAmount = new WalletAmount();
						$WalletAmount->points = $user->wallet_points;
						$WalletAmount->user_id = $user->id;
						$WalletAmount->type = 'Debit';
						$WalletAmount->status = "1";
						$WalletAmount->remaining_points = $wAmount;
						$WalletAmount->description = $result[0]->name." purchased using wallet";
						$WalletAmount->save();
					}
					

            } catch (Exception $e) {
				dd($e->getMessage());
				return response()->json([
					"success" => false,
					"msgText"=>$e->getMessage()
				]);
            }
        }
		return response()->json([
			"success" => true,
			"msgText"=>'Payment successful'
		]); 
        
    }
}