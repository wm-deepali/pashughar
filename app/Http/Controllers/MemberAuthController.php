<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\MemberTemp;
use App\Models\Brand;
use App\Models\PurchaseEnquiry;
use App\Models\BrandCategory;
use App\Models\CategorySubscription;
use App\Models\Subscription;
use App\Models\SubscriptionFeature;
use App\Models\Category;
use App\Models\AdImage;
use App\Models\AdSpecification;
use App\Models\WalletOnlinePayment;
use App\Models\AdFeature;
use App\Models\Enquiry;
use App\Models\Review;
use App\Models\State;
use App\Models\City;
use App\Models\SubCategory;
use App\Models\InvoiceSetting;
use App\Models\MemberVerify;
use App\Models\OtherSetting;
use App\Models\WalletAmount;
use App\Models\RazorpaySetting;
use App\Models\SubscriptionHistory;
use App\Models\SubscriptionOrder;
use App\Models\Ad;
use App\Models\OTP;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;
use Session;
use Validator;
use Illuminate\Support\Str;
use DB;
use Mail;
use App\Mail\EmailVerificationEmail;
use App\Mail\MailForgotPassword;
use Carbon\Carbon;


class MemberAuthController extends Controller
{
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $exists = Member::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function getusername($id){
		$data = DB::table('members')->where('referral_code',$id)->first();
        
		$adminsetting = OtherSetting::first();
		if(isset($data)){
		    $subscription = SubscriptionHistory::where('user_id', $data->id)->whereDate('subscription_expiry', '>=', Carbon::now())->exists();
		}
		if(isset($subscription) && !$subscription && $adminsetting->is_referral_enable == '1'){
		    return response()->json(['status'=>'3']);
		}
		if(!empty($data)){
			return response()->json(['status'=>1,'name'=>$data->full_name]);
		}else {
			return response()->json(['status'=>'2']);
		}
	}
    public function sendMobileOTP(Request $request)
    {
        // Generate a six-digit OTP
        $validator = Validator::make($request->all(), [
			'mobile'		=>'required|max:10|min:10|unique:members,mobile',
		]);
		if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->first('mobile')
            ], 422);
        }
        $otp = rand(100000, 999999);
        $mobile_number = $request->mobile;
        
    
        // Assuming you have a model named OTP for managing OTPs
        OTP::create([
            'mobile' => $mobile_number,
            'otp' => $otp,
            'expiry' => now()->addMinutes(10),
            ]);
    
        $message="$otp is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
        $dlt_id = '1307161465983326774';
        $request_parameter = array(
            'authkey'   => '133780AZGqc6gKWfh63da1812P1',
            'mobiles'   => $mobile_number,
            'message'   => urlencode($message),
            'sender'    => 'WMINGO',
            'route'     => '4',
            'country'   => '91',
            'unicode'   => '1',
        );
        $url = "http://sms.webmingo.in/api/sendhttp.php?";
        foreach($request_parameter as $key=>$val)
        {
            $url.=$key.'='.$val.'&';
        }
        $url = $url.'DLT_TE_ID='.$dlt_id;
        $url =rtrim($url , "&");
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //get response
            $output = curl_exec($ch);
            curl_close($ch);
            return response()->json([
            'success' => true,
            'message' => 'Otp Successfully Send on Your mobile number!',
        ]);
            // return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function verifyOTP(Request $request)
    {
        $mobile = $request->mobile;
        $otp = $request->otp;

        $isValid = OTP::verifyOTP($mobile, $otp);
        if($isValid){
            //OTP::deleteOTP($mobile, $otp);
            return response()->json(['success'=>true,'isValid' => $isValid]);
        }else{
            return response()->json(['success'=>false,'isValid' => $isValid]);
        }
        
    }
    public function authenticate(Request $request)
    {
         if(Auth::guard('member')->check())
        {
            return view('front.dashboard');
        }
        else{
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

    
            $credentials = $request->only('email', 'password');
            $member = Member::where('email', $request->email)->first();
            if(!empty($member))
            {
                if($member->email_verified_at == NULL)
                {
                    $token = Str::random(64);
                    MemberVerify::create([
                        'member_id' => $member->id, 
                        'token' => $token
                    ]);
                    $mailData = ['token'=>$token];
                    $mailContent =  Mail::to($request->email )->send(new EmailVerificationEmail($mailData));
                    return redirect()->route('user.login')
                            ->withErrors('Your email has not been verified yet, Verification Email sent, Please check your email in inbox, spam and junk folder.');
                }
                else if($member->status != 'Active')
                {
                    return redirect()->route('user.login')
                            ->withErrors('Your account has been blocked please contact to Admin.');
                }
                else{
                    
                    if (Auth::guard('member')->attempt($credentials)) {
                        
                        $revew = DB::table('ad_reviews_temp')->where('email',$request->email)->first();
                       
                        
                         
                        
                        if(isset($revew) && !empty($revew))
                        {
                            $ad =Ad::where('id', $revew->ad_id)->first();
                            return redirect()->route('ad-details', [base64_encode($ad->id), $ad->slug])->withErrors('Please complete your review!');
                        }
                        else
                        {
                            return redirect()->route('user.dashboard')
                            ->withSuccess('You have successfully logged in!');
                        }
                        
                        
                    }
                }
            }
            else{
                return back()->withErrors(['email' => 'Invalid email'])->onlyInput('email');
            }
            
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }
        
    } 
    

    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'referralto' => 'nullable|string|max:255',
            'full_name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:members',
            'mobile' => 'required|unique:members',
            'password' => 'required|min:8'
        ]);
		if($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput();
		}
      /*  if(!$request->isValid){
            \Session::put('error','First verify your phone number..');
		    return redirect("user.login");
        } */
        $memberm = Member::where('mobile',$request->mobile)->first();
        if($memberm){
            \Session::put('error','Already Exists Mobile Number');
		return redirect("user.login");
        }

        $adminsetting=OtherSetting::first();

        $member = new Member();
        $namePart = substr(ucfirst($request->full_name), 0, 4);
        $mobilePart = rand(1000,9999);
        $user_id = $namePart . $mobilePart;

        $member->full_name = ucfirst($request->full_name);
        $member->email = $request->email;
        $member->mobile = $request->mobile;
        $member->referralto = $request->referralto;
        $member->member_id	= 'PGHAR'.date('Y').rand(1000,9999);
        $member->referral_code = $user_id;
        $member->mobile_verified_at = date('Y-m-d H:i:s');
        $member->password = Hash::make($request->password);
        $member->wallet_points 	= $adminsetting->welcome_bonus;
        $member->no_of_ads 	= 0;
        $member->membership_expiry_at = date('Y-m-d', strtotime(date('d-m-Y H:i:s') . ' + '.$adminsetting->user_expiry.' days'));
        $member->save();
        $m_id = $member->id;


        /****wallet****** */
        if ($adminsetting->welcome_bonus > 0) {
            $walletamount = new WalletAmount();
            $walletamount->points = $adminsetting->welcome_bonus;
            $walletamount->user_id = $member->id;
            $walletamount->type = 'Credit';
            $walletamount->status = "1";
            $walletamount->remaining_points = $adminsetting->welcome_bonus;
            $walletamount->description = $adminsetting->welcome_bonus." Points Eared from Welcome Bonus";
            $walletamount->save();
        }
/*
        $memberOTP = OTP::where('mobile',$member->mobile)->first();
		$memberOTP->member_id = $member->id;
		$memberOTP->save();*/
		$token = Str::random(64);
        MemberVerify::create([
              'member_id' => $member->id, 
              'token' => $token
        ]);
    
        $mailData = ['token'=>$token];
        $mailContent =  Mail::to($request->email )->send(new EmailVerificationEmail($mailData));
        $this->addFreeSubscription($member->id);
        if(isset($request->referralto) && $request->referralto !='')
        {
            $this->addReferralPoints($request->referralto, $member->member_id);
        }
        return redirect()->route('user.login')
        ->withSuccess('Verification Email sent, Please check your email in inbox, spam and junk folder.');
    }

    public function verifyAccount($token)
    {
        $verifyUser = MemberVerify::where('token', $token)->first();
        
       // echo "<pre/>"; print_r($verifyUser); die('sjbfvkjber');
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->member;
              
            if(!$user->email_verified_at) {
                $verifyUser->member->email_verified_at = date('Y-m-d H:i:s');
                $verifyUser->member->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
        
        \Session::put('success',$message);
        return redirect()->route('user.login');
        
    }


    public function addRequiredDetails(Request $request){
      
        $user_id = session()->get('id_tempuser');
        $data['user'] = MemberTemp::findOrFail($user_id);
        return view('front.add-details',$data);
    }

    public function storeRequiredDetails(Request $request){
        // dd($request->all());
        $request->validate([
            'referralto' => 'nullable|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        // Retrieve the customer ID from the session
        $user_id = session()->get('id_tempuser');
        
        $member_temp = MemberTemp::find($user_id);
        // echo"<pre>";print_r($customer_temp);die();
        if (!$user_id) {
            return redirect()->back()->with('error', 'User not found in session.');
        }
       /* 
        if(!$request->isValid){
            \Session::put('error','First verify your mobile number..');
		    return redirect()->back();
        }
*/
        $adminsetting=OtherSetting::first();
        $namePart = substr(ucfirst($request->full_name), 0, 4);
        $mobilePart = rand(1000,9999);
        $user_id = $namePart . $mobilePart;
        
        $member = Member::create([
                 'full_name'      => $member_temp->full_name,
                 'email'     => $member_temp->email,
                 'google_id' => $member_temp->google_id,
                 'profile_pic' => $member_temp->profile_pic,
                 'mobile_verified_at' => date('Y-m-d H:i:s'),
                 'email_verified_at' => date('Y-m-d H:i:s'),
                
                ]);
             
        $member = Member::find($member->id);
        if (!$member) {
            return redirect()->back()->with('error', 'User not found.');
        }
        
        
        $member->password = Hash::make($request->password);
       
        $member->mobile = $request->mobile;
        $member->referralto = $request->referralto;
        $member->member_id	= 'PGHAR'.date('Y').rand(1000,9999);
        $member->referral_code = $user_id;
        $member->wallet_points 	= $adminsetting->welcome_bonus;
        $member->no_of_ads 	= 0;
        $member->membership_expiry_at = date('Y-m-d', strtotime(date('d-m-Y H:i:s') . ' + '.$adminsetting->user_expiry.' days'));
        $member->save();


        /****wallet****** */
        if ($adminsetting->welcome_bonus > 0) {
            $walletamount = new WalletAmount();
            $walletamount->points = $adminsetting->welcome_bonus;
            $walletamount->user_id = $member->id;
            $walletamount->type = 'Credit';
            $walletamount->status = "1";
            $walletamount->remaining_points = $adminsetting->welcome_bonus;
            $walletamount->description = $adminsetting->welcome_bonus." Points Eared from Welcome Bonus";
            $walletamount->save();
        }
        $this->addFreeSubscription($member->id);
        if(isset($request->referralto) && $request->referralto !='')
        {
            $this->addReferralPoints($request->referralto, $member->member_id);
        }
        Auth::guard('member')->login($member);
        return redirect()->route('user.dashboard');
    }

    public function showForgetPasswordForm()
    {
        return view('front.forgot-password');
    }
    
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
          'email' => 'required|email|exists:members',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
        
        $mailData = ['token'=>$token];
        
    	$mailContent =  Mail::to($request->email )->send(new MailForgotPassword($mailData));

        return back()->with('success', 'We have e-mailed your password reset link! Please check your email in inbox, spam and junk folder.');
    }
    
    public function showResetPasswordForm($token) 
    { 
        return view('front.forget-password-link', ['token' => $token]);
    }
    
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where(['token' => $request->token])->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = Member::where('email', $updatePassword->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        
        DB::table('password_resets')->where(['token' => $request->token])->delete();

        return redirect()->route('user.login')->with('success', 'Your password has been changed!');
    }


    public function sendOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_number'=>'required|digits:10|exists:members,mobile',
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'code' => 422,
                'errors'=>$validator->errors(),
            ]);
        }
        $mobile_number = $request->mobile_number;
        
         $otp = substr(str_shuffle("0123456789"), 0, 4);
         Member::where('mobile', $mobile_number)->update(['otp'=>$otp]);
         $message="$otp is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
                $dlt_id = '1307161465983326774';
                $request_parameter = array(
                    'authkey'   => '133780AZGqc6gKWfh63da1812P1',
                    'mobiles'   => $mobile_number,
                    'message'   => urlencode($message),
                    'sender'    => 'WMINGO',
                    'route'     => '4',
                    'country'   => '91',
                    'unicode'   => '1',
                );
                $url = "http://sms.webmingo.in/api/sendhttp.php?";
                foreach($request_parameter as $key=>$val)
                {
                    $url.=$key.'='.$val.'&';
                }
                $url = $url.'DLT_TE_ID='.$dlt_id;
                $url =rtrim($url , "&");
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    //get response
                    $output = curl_exec($ch);
                    curl_close($ch);
                    return response()->json([
                    'success' => true,
                    'message' => 'Otp Successfully Send on Your mobile number!',
                ]);
                    // return true;
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
    }
    public function verifymobilenumber(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_number'=>'required|digits:10|exists:members,mobile',
            'otp'=>'required',
        ],[
            'otp.exists'=>'Enter Correct Otp']);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'code' => 422,
                'errors'=>$validator->errors(),
            ]);
        }
        $member = Member::where('mobile',$request->mobile_number)->where('otp',$request->otp)->first();
        if($member){
            $member->update(['mobile_verified_at'=>date('Y-m-d H:i:s')]);

            //Auth::guard('member')->login($member);
            return response()->json([
                    'success' => true,
                    'message' => 'Succesfully Verified Otp, login to continue',
                ]);
        }else{
             return response()->json([
                    'profile' => 0,
                    'success' => false,
                    'message' => 'Incorrect Otp',
                ]);
        }
        
        
    }


    public function sendUSerOtp(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_number'=>'required|digits:10',
            'password' => 'required|min:6'
        ]);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'code' => 422,
                'errors'=>$validator->errors(),
            ]);
        }
        $mobile_number = $request->mobile_number;
        $password = $request->password;
        $user_id = Auth::guard('member')->user()->id;
        
         $otp = substr(str_shuffle("0123456789"), 0, 4);
         Member::where('id', $user_id)->update(['mobile'=>$mobile_number, 'password' => Hash::make($request->password), 'otp'=>$otp]);
         $message="$otp is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";
                $dlt_id = '1307161465983326774';
                $request_parameter = array(
                    'authkey'   => '133780AZGqc6gKWfh63da1812P1',
                    'mobiles'   => $mobile_number,
                    'message'   => urlencode($message),
                    'sender'    => 'WMINGO',
                    'route'     => '4',
                    'country'   => '91',
                    'unicode'   => '1',
                );
                $url = "http://sms.webmingo.in/api/sendhttp.php?";
                foreach($request_parameter as $key=>$val)
                {
                    $url.=$key.'='.$val.'&';
                }
                $url = $url.'DLT_TE_ID='.$dlt_id;
                $url =rtrim($url , "&");
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    //get response
                    $output = curl_exec($ch);
                    curl_close($ch);
                    return response()->json([
                    'success' => true,
                    'message' => 'Otp Successfully Send on Your mobile number!',
                ]);
                    // return true;
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
    }
    public function verifyUsermobilenumber(Request $request){
        $validator = Validator::make($request->all(), [
            'mobile_number'=>'required|digits:10|exists:members,mobile',
            'otp'=>'required',
        ],[
            'otp.exists'=>'Enter Correct Otp']);
        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'code' => 422,
                'errors'=>$validator->errors(),
            ]);
        }
        $member = Member::where('mobile',$request->mobile_number)->where('otp',$request->otp)->first();
        if($member){
            $member->update(['mobile_verified_at'=>date('Y-m-d H:i:s')]);

            Auth::guard('member')->login($member);
            return response()->json([
                    'success' => true,
                    'message' => 'Succesfully Verified Mobile number',
                ]);
        }else{
             return response()->json([
                    'profile' => 0,
                    'success' => false,
                    'message' => 'Incorrect Otp',
                ]);
        }
        
        
    }
    public function dashboard()
    {
        if(Auth::guard('member')->check())
        {
            $user_id = Auth::guard('member')->user()->id;
            $data['user'] = Member::findOrFail($user_id);
            
            $data['history'] = SubscriptionHistory::with('subscriptions')->where('user_id', $user_id)->orderBy('created_at','DESC')->first();
            
            $ads = Ad::where('user_id', $user_id)->get()->pluck('id');
            if(isset($ads) && !empty($ads))
            {
                $data['reviews'] = Review::whereIn('ad_id', $ads)->orderBy('created_at','DESC')->paginate(5);
            }
            
            
            return view('front.dashboard', $data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    } 
    public function profile()
    {
        if(Auth::guard('member')->check())
        {
            $user_id = Auth::guard('member')->user()->id;
            $data['user'] = Member::with('cityname','statename','countryname')->where('id', $user_id)->first();
            return view('front.profile', $data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    } 
    public function adPost()
    {
        if(Auth::guard('member')->check())
        {
            if(Auth::guard('member')->user()->no_of_ads > 0)
            {
                $userid = Auth::guard('member')->user()->id;
                
                $subscriber_history_check  = DB::table('subscription_history')->where('user_id',$userid)->whereDate('subscription_expiry','>=',date('Y-m-d'))->where('payment_status', 'Completed')->where('remaining_ads','>', 0)->first();
                if(!empty($subscriber_history_check))
                {
                    $categories =$subscriber_history_check->category_id;
                    $categoryArr = explode(', ', $categories);
                    //$data['categories'] = Category::all();
                    $data['categories'] = Category::whereIn('id', $categoryArr)->get();
                    $data['brandcategories'] = BrandCategory::all();
                    $data['subscriptions'] = Subscription::where('status',1)->orderBy('offer_price', 'asc')->get();
                     $data['brand'] = Brand::all();
                    return view('front.post-your-ad', $data);
                }
                else{
                    return redirect()->route('user.buy-subscription')->withErrors('Our Team is reviewing your payment detail once it is verified we will notify you on your email, thank you for your patience.');
                }
                
            }
            else{
                return redirect()->route('user.buy-subscription');
            }
            
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }
    public function EditAdPost($id)
    { 
        if(Auth::guard('member')->check())
        {
            $adId = base64_decode($id);
            if($adId !='')
            {
                $userid = Auth::guard('member')->user()->id;
                $ad = Ad::with('AdImage', 'adFeature','adSpecification')->where('user_id',$userid)
                            ->where('id',$adId)
                            ->where('delete_status','0')->first();

                if(!empty($ad))
                {
                    $subscriber_history_check  = DB::table('subscription_history')->where('user_id',$userid)->orderBy('id', 'desc')->where('id', $ad->plan_id)->first();
                    
                        $categories =$subscriber_history_check->category_id;
                        $categoryArr = explode(', ', $categories);
                        $data['categories'] = Category::whereIn('id', $categoryArr)->get();
                        //Category::orderBy('created_at','DESC')->get();
                        $data['subcategories'] = SubCategory::where('category_id', $ad->category_id)->orderBy('created_at','DESC')->get();
                        $data['brandcategories'] = BrandCategory::orderBy('created_at','DESC')->get();
                         $data['brands'] = Brand::where('brand_category_id', $ad->category_id)->orderBy('created_at','DESC')->get();
                        // $data['brands'] = Brand::where('brand_category_id', $ad->brand_category)->orderBy('created_at','DESC')->get();
                        $data['ad'] = $ad;
                        $data['features']= featcherformData();
                        return view('front.edit-post', $data);
                   
                }
                else{
                    return redirect()->route('user.dashboard')
                    ->withErrors('Ad not found!');
                } 
            }
            else{
                return redirect()->route('user.dashboard');
            } 
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }

    public function checkout($id){
        if(Auth::guard('member')->check())
        {
            $userid = Auth::guard('member')->user()->id;
            $data['user'] = Member::with('countryname','cityname','statename')->where('id', $userid)->first();
            $data['states']=State::where('country_id',1)->get();
            $data['orderId']=$id;

            $data['subscription']= Subscription::where('status',1)->orderby('offer_price','DESC')->findOrFail(decrypt($id));
            $categorysubscriptions = CategorySubscription::where('subscription_id',(decrypt($id)))->pluck('category_id');
            $data['categorysubscriptions']=$categorysubscriptions;
            
            $subscription = SubscriptionHistory::where('user_id', $userid)
                    ->whereDate('subscription_expiry', '>=', Carbon::now())
                    ->exists();
            if($subscription)
            {
                $subscriptionhistorypending = SubscriptionHistory::where('user_id', $userid)->whereDate('subscription_expiry', '>=', Carbon::now())->where('payment_status', 'Pending')->exists();
                
                $subscriptionhistory = SubscriptionHistory::where('user_id',$userid)->where('remaining_ads','>', 0)->where('payment_status', 'Completed')->exists();
                
                if($subscriptionhistorypending)
                {
                    return redirect()->back()->withErrors('Our Team is reviewing your payment detail once it is verified we will notify you on your email, thank you for your patience.');
                }
                else if($subscriptionhistory)
                {
                    return redirect()->back()->withErrors('Ads are already available to publish in your active subscription. Please use all the ads in the bucket first.');
                }
            }

            $adminsetting = OtherSetting::first();
            $adminsetting2 = InvoiceSetting::first();
            $data['bankdetail'] = WalletOnlinePayment::first();
            $user = Member::findOrFail($userid);

            if($adminsetting2->state == $user->state){
                $data['gst_type']  = "CGST + SGST";
                $data['gst_percent']  = $adminsetting2->cgst + $adminsetting2->sgst;
                $data['total_gst'] = $data['subscription']->offer_price * ($adminsetting2->cgst + $adminsetting2->sgst)/100;
            }else{
                $data['gst_type']  = "IGST";
                $data['gst_percent']  = $adminsetting2->igst;
                $data['total_gst'] = $data['subscription']->offer_price * ($adminsetting2->igst)/100;
            }
            $totalAmount = $data['subscription']->offer_price + $data['total_gst'];
            $data['wallet'] = $user->wallet_points/$adminsetting->point_value;
            $data['admin_wallet_limit']  = $adminsetting->wallet_limit;
            $data['usable_wallet_amount'] = $data['subscription']->offer_price * ($data['admin_wallet_limit'])/100;
            $data['remainingWalletBalance'] = max(0,$data['wallet']-$data['usable_wallet_amount']);
            
    
            $data['razorpay_key']  = RazorpaySetting::first();
            $data['total'] = number_format($totalAmount, 2);
            return view('front.checkout',$data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }


    public function free_subscription(Request $request){
        if(Auth::guard('member')->check())
        {
            $validator = Validator::make($request->all(), [
                'id'=>'required',
                'payment_method' => 'required',
                'amount'=>'required',
                'transaction_id'=>'required',
                'payment_date'=>'required',
                'screenshot'=>'required',
            ]);
            $orderId = $request->orderId;
            if($validator->fails()){
                return redirect()->route('user.checkout',$orderId)
                ->withErrors('All fields are required!');
            }
            if($request->has('address'))
            {
                $user_id = Auth::guard('member')->user()->id;
                $user = Member::findOrFail($user_id);
    
                $user->city = $request->city;
                $user->address = $request->address;
                $user->state = $request->state;
                $user->country = 1;
                $user->zipcode = $request->zipcode;
             
                $user->save();
            }
            $user_id = Auth::guard('member')->user()->id;
            $subscription_id    = $request->id;
            $paid_amount    = $request->amount;
            
            $rand 		        = mt_rand(1500, 5000);
            
            $result 		    = DB::table('subscriptions')->where('status',1)->where('id',$subscription_id)->get();
            $subscriptionTT = $result[0];
            $adminsetting = OtherSetting::first();
		    $adminsetting2 = InvoiceSetting::first();
            $user = Member::findOrFail($user_id);
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
            $paymentmethod  = $request->payment_method;
            $remark  = $request->remark;
            if($request->hasFile('screenshot'))
            {
                $path = $request->file('screenshot')->store('screenshot', 'public');// Example storage locatio
                $screenshot = $path;
            }
            else
            {
                $screenshot = '';
            }
            $payment_status = 'Pending';
            $mrp = $result[0]->mrp;
            $offered_price = $result[0]->offer_price;
            $discount_amount = $result[0]->discount;
            if($adminsetting2->state == $user->state){
                $gst_type  = "CGST + SGST";
                $gst_percent  = $adminsetting2->cgst + $adminsetting2->sgst;
                $total_gst = $offered_price * ($adminsetting2->cgst + $adminsetting2->sgst)/100;
            }else{
                $gst_type  = "IGST";
                $gst_percent  = $adminsetting2->igst;
                $total_gst = $offered_price * ($adminsetting2->igst)/100;
            }
            
            $transaction_id = $request->transaction_id;
            
            $subscriber_exists  = DB::table('subscription_orders')->where('user_id',$user_id)->where('category_id',$category_id)->exists();
            $subscriber_history_check  = DB::table('subscription_history')->where('user_id',$user_id)->whereDate('subscription_expiry','>=',date('Y-m-d'))->exists();
            if($subscriber_history_check==true){
                
                $subscriber_history_free  = DB::table('subscription_history')->where('user_id',$user_id)->where('payment_method', 'free')->where('remaining_ads','>', 0)->exists();
                if($subscriber_history_free){
                    return redirect()->route('user.checkout',$orderId)
                    ->withErrors('You are already subscribed to a free subscription..');
                    
                    
                }
                
                $subscriptionhistorypending = SubscriptionHistory::where('user_id', $user_id)->whereDate('subscription_expiry', '>=', Carbon::now())->where('payment_status', 'Pending')->exists();
                
                $subscriptionhistory = SubscriptionHistory::where('user_id',$user_id)->where('remaining_ads','>', 0)->where('payment_status', 'Completed')->exists();
                
                if($subscriptionhistorypending)
                {
                    return redirect()->back()->withErrors('Our Team is reviewing your payment detail once it is verified we will notify you on your email, thank you for your patience.');
                }
                else if($subscriptionhistory)
                {
                    return redirect()->back()->withErrors('Ads are already available to publish in your active subscription. Please use all the ads in the bucket first.');
                }
                
                 
            }
            $o_number = $transaction_id;
            $subscriber_exists  = DB::table('subscription_orders')->where('user_id',$user_id)->where('category_id',$category_id)->exists();
                
            if($subscriber_exists)
            {
                DB::table('subscription_orders')->where('user_id',$user_id)->where('category_id',$category_id)->update(array('user_id'=>$user_id,'subscription_id'=>$request->id,'transaction_id'=>$transaction_id,'payment_method'=>$paymentmethod,'payment_status'=>$payment_status,'used_ads'=>'0','remaining_ads'=>$no_of_ads,'subscription_validity'=>$ads_validity,'category_id'=>$category_id,'delete_status'=>'0','status'=>'0','order_number'=>$o_number));

            }else
            {
                $userprofile					= new SubscriptionOrder;
                $userprofile->user_id 					= $user_id;
                $userprofile->subscription_id 			= $request->id;
                $userprofile->transaction_id			= $transaction_id;
                $userprofile->order_number              = $o_number;
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
                    'order_number'			=>$o_number,
                    'transaction_id'		=> $transaction_id,
                    'payment_method'		=> $paymentmethod,
                    'payment_date'		    => $request->payment_date,
                    'remark'		        => $remark,
                    'screenshot'		    => $screenshot,
                    'payment_status'		=> $payment_status,
                    'used_ads'				=> '0',
                    'remaining_ads'			=> $no_of_ads,
                    'mrp'					=> $mrp,
                    'discount_amount'		=> $discount_amount,
                    'offered_price'			=> $offered_price,
                    'gst_type'				=> $gst_type,
                    'gst_amount'			=> $total_gst,
                    'paid_amount'			=> $paid_amount,
                    'order_amount_with_gst'	=> number_format($offered_price, 2) + number_format($total_gst, 2),
                    'wallet_used_amount'	=> ($offered_price + $total_gst)-$paid_amount,
                    'subscription_expiry'	=> $subscription_expiry,
                    'subscription_validity'	=> $package_validity,
                    'category_id'			=> $category_id,
                    'delete_status'			=> '0',
                    'status'				=> '0'
                ));

                $user->no_of_ads = $user->no_of_ads + $no_of_ads;
                if($offered_price ==0)
                {
                    $user->user_type ='Free';
                    
                    $user->is_buy_free_subscription =1;
                }
                else{
                    $user->user_type ='Paid';
                }
                $user->active_subscription_id=$request->id;
                $user->expiry_date = $subscription_expiry;
                
                $user->wallet_points =$user->wallet_points - ((($offered_price + $total_gst) - $paid_amount)*$adminsetting->point_value);
					$user->used_wallet_points =$user->used_wallet_points + ((($offered_price + $total_gst) - ($paid_amount))*$adminsetting->point_value);
					$user->save();
					
                
                $user->save();
                $user = Member::findOrFail($user_id);
                $wAmount = (($offered_price + $total_gst) - ($paid_amount))*$adminsetting->point_value;
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
    
            
            return redirect()->route('user.thankyou')
            ->withSuccess('Payment submitted Successfully.');
            


           
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }
    
    public function saveaddressinfo(Request $request)
    {
        
        if(Auth::guard('member')->check())
        {
            $validator = Validator::make($request->all(), [
                'city'=>'required',
                'address' => 'required',
                'state'=>'required',
                'country'=>'required',
                'zipcode'=>'required',
            ]);
            $orderId = $request->orderId;
            if($validator->fails()){
                return redirect()->route('user.checkout',$orderId)
                ->withErrors('All fields are required!');
            }
            
            $user_id = Auth::guard('member')->user()->id;
            $user = Member::findOrFail($user_id);

            $user->city = $request->city;
            $user->address = $request->address;
            $user->state = $request->state;
            $user->country = 1;
            $user->zipcode = $request->zipcode;
         
            $user->save();
            return redirect()->route('user.checkout',$orderId)
            ->withSuccess('Address save successfully.');
        }
       
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }

    public function saveAdPost(Request $request)
    {
        
        if(Auth::guard('member')->check())
        {
            if(Auth::guard('member')->user()->no_of_ads > 0)
            {
                $user_id = Auth::guard('member')->user()->id;
                $user_sub_id = Auth::guard('member')->user()->active_subscription_id;
                $subscriber_history_check  = DB::table('subscription_history')->where('subscription_id',$user_sub_id)->where('user_id',$user_id)->whereDate('subscription_expiry','>=',date('Y-m-d'))->where('payment_status', 'Completed')->where('remaining_ads','>', 0)->first();
                if(!empty($subscriber_history_check))
                {
                    $subscription = Subscription::findOrFail($subscriber_history_check->subscription_id);
                    if(!empty($subscription))
                    {   
                        $package_validity 	= $subscription->ad_validity;
                        $dates 	            = date("d-m-Y");	
                        $date   	        = date_create($dates);
                        date_add($date,date_interval_create_from_date_string($package_validity."days"));
                        $expiry = date_format($date,"Y-m-d");

                        $validator = Validator::make($request->all(), [
                            'title'=>'required',
                            'category_id' => 'required',
                            'price'=>'required',
                            'description'=>'required',
                            // 'brand_category'=>'required',
                            'image'=>'required',
                            'location'=>'required',
                            'meta_title' => 'required|string|max:255',
                            'meta_keyword' => 'required|string|max:255',
                            'meta_description' => 'required|string',
                        ]);
                        if($validator->fails()){
                            return redirect()->route('user.post-your-ad')
                            ->withErrors('All fields are required!');
                        }
                        $ad = new Ad();
                        $slug = Str::slug($request->title);
                        $ad->title = $request->title;
                        $ad->slug = $slug;
                        $ad->subscription_id = $subscriber_history_check->subscription_id;
                        $ad->plan_id = $subscriber_history_check->id;
                        $ad->category_id = $request->category_id;
                        $ad->subcategory_id = $request->subcategory_id ?? NULL;
                        $ad->brand_category = $request->brand_category ?? NULL;
                        $ad->brand_id = $request->brand_id ?? NULL;
                        $ad->price = $request->price ?? 0;
                        $ad->price_type = $request->price_type ?? 0;
                        $ad->description = $request->description;
                        $ad->location = $request->location;
                        $ad->expire_at = $expiry;
                        
                        $ad->meta_title = $request->meta_title;
                        $ad->meta_keyword = $request->meta_keyword;
                        $ad->meta_description = $request->meta_description;
                        
                        $ad->author_name = $request->author_name ?? Auth::guard('member')->user()->full_name;
                        $ad->author_email = $request->author_email ?? Auth::guard('member')->user()->email;
                        $ad->author_mobile = $request->author_mobile ?? Auth::guard('member')->user()->mobile;
                        $ad->author_address = $request->author_address ?? NULL;
                        $ad->email_alert = isset($request->email_alert) ?'yes':'no';
                        $ad->status='Pending';
                        $ad->user_id = Auth::guard('member')->user()->id;
                        $ad->save();
                        $id=$ad->id;
                       $age_approx = $request->has('age_approx') ? 'yes' : '';
                
                        $request->merge(["age_approx"=> $age_approx]);
                        $data = $request->except('_method', '_token', 'title','category_id','subcategory_id','brand_category','brand_id','price','description','tags','author_name','author_email','author_mobile','author_address','email_alert', 'image', 'status', 'expire_at', 'price_type', 'location', 'specifications', 'meta_title', 'meta_keyword', 'meta_description');
                        
                        $featureData = featcherformData();
                        $fetKeys = array_keys($featureData);
                        
                        foreach($data as $key => $setval){
                            if(in_array($key, $fetKeys))
                            {
                                AdFeature::create([
                                'ad_id'=>$id,
                                'features_name'=>$key,
                                'features'=>$setval,
                                ]);
                            }
                            
                        }
                        
                        
                        if($request->hasFile('image'))
                        {
                            foreach($request->file('image') as $image)
                            {
                                $path = $image->store('ad_image', 'public');// Example storage locatio
                                AdImage::create([
                                    'ad_id'=>$id,
                                    'image'=>$path,
                                ]);

                            }
                        }
                        if($request->has('specifications'))
                        {
                            
                            foreach($request->specifications as $k=>$specification)
                            {
                                AdSpecification::create([
                                    'ad_id'=>$id,
                                    'specification'=>$specification,
                                ]);

                            }
                        }
                        $subscriber_history = SubscriptionHistory::findOrFail($subscriber_history_check->id);
                        $subscriber_history->used_ads = $subscriber_history->used_ads+1;
                        $subscriber_history->remaining_ads = $subscriber_history->remaining_ads-1; 
                        $subscriber_history->save(); 
                    
                        $user = Member::findOrFail($user_id);
                        $user->no_of_ads = $user->no_of_ads-1;
                        $user->save(); 

                        $subscriber_order  = SubscriptionOrder::where('user_id',$user_id)->where('subscription_id',$user_sub_id)->whereDate('subscription_expiry','>=',date('Y-m-d'))->first();
                        if(!empty($subscriber_order)){
                            $subscriber_order->used_ads = $subscriber_order->used_ads+1;
                            $subscriber_order->remaining_ads = $subscriber_order->remaining_ads-1; 
                            $subscriber_order->save(); 
                        }

                        return redirect()->route('user.my-ads')
                        ->withSuccess('You have successfully Post Ad!');
                    }
                    else{
                        return redirect()->route('user.post-your-ad')
                    ->withErrors('Subscription not found!');
                    }  
                }
                else{
                    return redirect()->route('user.post-your-ad')
                ->withErrors('Subscription Expired!');
                }
            
            }
            else{
                return redirect()->route('user.post-your-ad')
                ->withErrors('Ads bucket zero');
            }
        }
    
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }
    public function updateAdPost(Request $request, $adId)
    {
        $id = base64_decode($adId);
        if(Auth::guard('member')->check())
        {
            $userid = Auth::guard('member')->user()->id;
            $ad = Ad::where('user_id',$userid)
                        ->where('id',$id)
                        ->where('delete_status','0')->first();

            if(!empty($ad))
            {
                $validator = Validator::make($request->all(), [
                    'title'=>'required',
                    'category_id' => 'required',
                    'price'=>'required',
                    'description'=>'required',
                    'meta_title' => 'required|string|max:255',
                    'meta_keyword' => 'required|string|max:255',
                    'meta_description' => 'required|string',
                ]);
                if($validator->fails()){
                    return redirect()->route('user.edit-ad-post', base64_encode($id))
                    ->withErrors('All fields are required!');
                }
                        
                $slug = Str::slug($request->title);
                $ad->title = $request->title;
                $ad->slug = $slug;
                $ad->category_id = $request->category_id;
                $ad->subcategory_id = $request->subcategory_id ?? $ad->subcategory_id;
                $ad->brand_category = $request->brand_category ?? $ad->brand_category;
                $ad->brand_id = $request->brand_id ?? $ad->brand_id;
                $ad->price = $request->price ?? 0;
                $ad->description = $request->description;
                $ad->price_type = $request->price_type;
                $ad->location = $request->location;
                $ad->author_name = $request->author_name ?? Auth::guard('member')->user()->full_name;
                $ad->author_email = $request->author_email ?? Auth::guard('member')->user()->email;
                $ad->author_mobile = $request->author_mobile ?? Auth::guard('member')->user()->mobile;
                $ad->author_address = $request->author_address ?? Auth::guard('member')->user()->address;
                $ad->email_alert = 'no';
                
                $ad->meta_title = $request->meta_title;
                $ad->meta_keyword = $request->meta_keyword;
                $ad->meta_description = $request->meta_description;
                
                $ad->save();
                
                $age_approx = $request->has('age_approx') ? 'yes' : '';
                
                $request->merge(["age_approx"=> $age_approx]);

                $data = $request->except('_method', '_token', 'title','category_id','subcategory_id','brand_category','brand_id','price','description','tags','author_name','author_email','author_mobile','author_address','email_alert', 'image', 'status', 'expire_at', 'price_type', 'location', 'specifications', 'meta_title', 'meta_keyword', 'meta_description');
                
                
                AdFeature::where('ad_id',$ad->id)->delete();
                $featureData = featcherformData();
                $fetKeys = array_keys($featureData);
                
                foreach($data as $key => $setval){
                    if(in_array($key, $fetKeys))
                    {
                        AdFeature::create([
                        'ad_id'=>$id,
                        'features_name'=>$key,
                        'features'=>$setval,
                        ]);
                    }
                    
                }
                AdSpecification::where('ad_id',$ad->id)->delete();
                if($request->has('specifications'))
                {
                    foreach($request->specifications as $k=>$specification)
                    {
                        AdSpecification::create([
                            'ad_id'=>$id,
                            'specification'=>$specification,
                        ]);

                    }
                }
                if($request->hasFile('image'))
                {
                    foreach($request->file('image') as $image)
                    {
                        $path = $image->store('ad_image', 'public');// Example storage locatio
                        AdImage::create([
                            'ad_id'=>$id,
                            'image'=>$path,
                        ]);

                    }
                }
                
                return redirect()->route('user.my-ads')
                ->withSuccess('You have successfully updated Ad!');
                        
                
            }
            else{
                return redirect()->route('user.post-your-ad')
                ->withErrors('Ad not found');
            }
        }
    
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }
    public function myAds()
    {
        if(Auth::guard('member')->check())
        {
            $userid = Auth::guard('member')->user()->id;
            $data['ads'] = Ad::with('AdImage', 'brandCategory', 'category', 'subcategory', 'brand', 'user', 'adFeature','reviews')->where('user_id', $userid)->orderBy('created_at','DESC')->paginate(8);
            return view('front.my-post',$data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }
    }
    public function AdEnquiry($adId)
    {
        if(Auth::guard('member')->check())
        {
            $id = base64_decode($adId);
            $userid = Auth::guard('member')->user()->id;
            //$data['enquiries'] = Enquiry::where('ad_id', $id)->orderBy('created_at','DESC')->paginate(8);
             $data['enquiries'] = PurchaseEnquiry::where('ad_id', $id)->orderBy('created_at','DESC')->paginate(10);
            
            $data['ad'] = Ad::where('id', $id)->where('user_id', $userid)->first();
            return view('front.ad-enquiry',$data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }
    }
    public function settings()
    {
        if(Auth::guard('member')->check())
        {
            $data['states']=State::where('country_id',1)->get();
            if(Auth::guard('member')->user()->state !='')
            {
                $data['cities']=City::where('state_id',Auth::guard('member')->user()->state)->get();
            }
            return view('front.setting', $data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }
    }
    public function myWallet()
    {
        if(Auth::guard('member')->check())
        {
            $user_id = Auth::guard('member')->user()->id;
            $data['user'] = Member::findOrFail($user_id);
            $data['wallets'] = WalletAmount::where('user_id', $user_id)->orderBy('created_at','DESC')->get();
            return view('front.my-wallet',$data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }
    }
    public function mySubscription()
    {
        if(Auth::guard('member')->check())
        {
            $user_id = Auth::guard('member')->user()->id;
            $data['user'] = Member::findOrFail($user_id);
            $data['history'] = SubscriptionHistory::with('subscriptions')->where('user_id', $user_id)->orderBy('created_at','DESC')->paginate(10);
            return view('front.my-subscriptions',$data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }
    }
    public function buySubscription()
    {
        if(Auth::guard('member')->check())
        {
            $data['subscriptions'] = Subscription::where('status',1)->orderBy('offer_price','asc')->get();
            return view('front.buy-subscription', $data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }
    }

    public function saveSettings(Request $request)
    {
        
        if(Auth::guard('member')->check())
        {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:250',
                'city'=>'required',
                'address' => 'required',
                'state'=>'required',
                'country'=>'required',
                'zipcode'=>'required',
            ]);
            
            if($validator->fails()){
                return redirect()->route('user.settings')
                ->withErrors('All fields are required!');
            }
            
            $user_id = Auth::guard('member')->user()->id;
            $user = Member::findOrFail($user_id);

            $user->full_name = $request->full_name;
            $user->city = $request->city;
            $user->address = $request->address;
            $user->state = $request->state;
            $user->country = 1;
            $user->zipcode = $request->zipcode;

            if($request->hasFile('profile_pic'))
            {
                $path = $request->file('profile_pic')->store('members', 'public');// Example storage locatio
                $user->profile_pic = $path;
            }
            $user->save();

            return redirect()->route('user.settings')
            ->withSuccess('Profile updated successfully.');
        }
       
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }
    public function deleteAd($adId)
    {
        $id = base64_decode($adId);
        if(Auth::guard('member')->check())
        {
            $userid = Auth::guard('member')->user()->id;
            $ad = Ad::where('user_id',$userid)
                        ->where('id',$id)
                        ->where('delete_status','0')->first();

            if(!empty($ad))
            {
                $ad = Ad::findOrFail($id);
                       
                $user_id = $ad->user_id;
                $sub_id = $ad->plan_id;
                
                $member = Member::findOrFail($user_id);
                if(!empty($member))
                {
                    $member->no_of_ads = $member->no_of_ads+1;
                    $member->save();
                }
    
                $history = SubscriptionHistory::where('id', $sub_id)->first();
                if(!empty($history))
                {
                    $history->used_ads = $history->used_ads-1;
                    $history->remaining_ads = $history->remaining_ads+1;
                    $history->save();
                    
                    $order = SubscriptionOrder::where('order_number', $history->order_number)->first();
                    if(!empty($order))
                    {
                        $order->used_ads = $order->used_ads-1;
                        $order->remaining_ads = $order->remaining_ads+1;
                        $order->save();
                    }
                }
                
                
           
                $prevImage = AdImage::where('ad_id',$id)->get();
                if(isset($prevImage) && count($prevImage)>0)
                {
                    foreach($prevImage as $pimage)
                    {
                        Storage::disk('public')->delete($pimage->image);
                    }
                }
                AdFeature::where('ad_id',$id)->delete();
                AdImage::where('ad_id',$id)->delete();
                Enquiry::where('ad_id',$id)->delete();
                Review::where('ad_id',$id)->delete();
                AdSpecification::where('ad_id',$id)->delete();
                $ad->delete();
        
                return redirect()->route('user.my-ads')
                ->withSuccess('Ad deleted successfully!');
                        
                
            }
            else{
                return redirect()->route('user.post-your-ad')
                ->withErrors('Ad not found');
            }
        }
       
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }  
    }

    public function addFreeSubscription($user_id)
    {
        $user = Member::findOrFail($user_id);
        $rand = mt_rand(1500, 5000);
        $result = DB::table('subscriptions')->where('status',1)->where('offer_price',0)->first();
        if(!empty($result))
        {
            $adminsetting = OtherSetting::first();
            $adminsetting2 = InvoiceSetting::first();
            $no_of_ads  = $result->no_of_ads;
            $ads_validity = $result->ad_validity;
            $categorysubscriptions 	    = CategorySubscription::where('subscription_id',$result->id)->pluck('category_id');
            foreach ($categorysubscriptions as $categoryId) {
                $category_id_data[] = $categoryId;
            }
            $category_id = implode(", ", $category_id_data);
            $package_validity 	= $result->subscription_validity;
            $dates 	            = date("d-m-Y");	
            $date   	        = date_create($dates);
            date_add($date,date_interval_create_from_date_string($package_validity."days"));
            $subscription_expiry = date_format($date,"Y-m-d");
            $paymentmethod  = 'free';
            $payment_status = 'Completed';
            $mrp = $result->mrp;
            $offered_price = $result->offer_price;
            $discount_amount = $result->discount;
            if($adminsetting2->state == $user->state){
                $gst_type  = "CGST + SGST";
                $gst_percent  = $adminsetting2->cgst + $adminsetting2->sgst;
                $total_gst = $offered_price * ($adminsetting2->cgst + $adminsetting2->sgst)/100;
            }else{
                $gst_type  = "IGST";
                $gst_percent  = $adminsetting2->igst;
                $total_gst = $offered_price * ($adminsetting2->igst)/100;
            }
        
            $transaction_id = $rand;
            $o_number = 'Free'.$transaction_id;
            $userprofile					= new SubscriptionOrder;
            $userprofile->user_id 					= $user_id;
            $userprofile->subscription_id 			= $result->id;
            $userprofile->transaction_id			= $transaction_id;
            $userprofile->order_number              = $o_number;
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


            
            $data = DB::table('subscription_history')->insert(
                array(
                    'user_id'				=> $user_id,
                    'subscription_id'		=> $result->id,
                    'order_number'			=>$o_number,
                    'transaction_id'		=> $transaction_id,
                    'payment_method'		=> $paymentmethod,
                    'payment_status'		=> $payment_status,
                    'payment_date'		    => date('Y-m-d'),
                    'remark'		        => '',
                    'screenshot'		    => '',
                    'paid_amount'		    => 0,
                    'used_ads'				=> '0',
                    'remaining_ads'			=> $no_of_ads,
                    'mrp'					=> $mrp,
                    'discount_amount'		=> $discount_amount,
                    'offered_price'			=> $offered_price,
                    'gst_type'				=> $gst_type,
                    'gst_amount'			=> $total_gst,
                    'order_amount_with_gst'	=> number_format($offered_price, 2) + number_format($total_gst, 2),
                    'wallet_used_amount'	=> ($offered_price + $total_gst),
                    'subscription_expiry'	=> $subscription_expiry,
                    'subscription_validity'	=> $package_validity,
                    'category_id'			=> $category_id,
                    'delete_status'			=> '0',
                    'status'				=> '0'
                ));
            
            $user->no_of_ads = $user->no_of_ads + $no_of_ads;
            if($offered_price ==0)
            {
                $user->user_type ='Free';
                
                $user->is_buy_free_subscription =1;
            }
            else{
                $user->user_type ='Paid';
            }
            $user->active_subscription_id=$result->id;
            $user->expiry_date = $subscription_expiry;
            $user->save();

        } 
    }
    public function addReferralPoints($referral, $memberId)
    {
        $member = Member::where('member_id', $memberId)->first();
        $user = Member::where('referral_code', $referral)->whereDate('expiry_date', '>=', Carbon::now())->first();
        if(!empty($user))
        {
            $adminsetting=OtherSetting::first();
            if ($adminsetting->is_referral_enable == "1" && $adminsetting->referral_points > 0)
            {
                $user->wallet_points 	= $user->wallet_points + $adminsetting->referral_points;
                $user->save();
                $walletamount = new WalletAmount();
                $walletamount->points = $adminsetting->referral_points;
                $walletamount->user_id = $user->id;
                $walletamount->type = 'Credit';
                $walletamount->status = "1";
                $walletamount->remaining_points = $user->wallet_points;
                $walletamount->description = $adminsetting->referral_points." Points Earned from Referral by ". ucfirst($member->full_name)."(".$memberId.")";
                $walletamount->save();
            }
        }
    }
    public function logout()
    {
        if(Auth::guard('member')->check()) // this means that the admin was logged in.
        {
            Auth::guard('member')->logout();
            return redirect()->route('user.login');
        }
    }
    public function allPurchaseEnquiry()
    {
        if(Auth::guard('member')->check())
        {
            $data = [];
            $userid = Auth::guard('member')->user()->id;
            $allads = Ad::where('user_id',$userid)->get()->pluck('id');
            if(isset($allads) && !empty($allads))
            {
                $data['enquiries'] = PurchaseEnquiry::whereIn('ad_id', $allads)->orderBy('created_at','DESC')->paginate(10);
            }
            return view('front.my-enquiry',$data);
        }
        else{
            return redirect()->route('user.login')
            ->withErrors('Please login to access the dashboard.');
        }
      
    }
}
