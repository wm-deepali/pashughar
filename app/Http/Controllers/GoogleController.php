<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\MemberTemp;
use File;
use Carbon\Carbon;
use Session;

class GoogleController extends Controller
{
    public function redirectToGoogle(Request $request)
    {
        $referralCode = $request->query('referralCode');
        
        if ($referralCode) {
            $userRefName = Member::where('referral_code',$referralCode)->first();
            session(['referralCode' => $referralCode,'refUserName' => $userRefName->full_name]);
        }
        
        if(Auth::guard('member')->check())
        {
            return view('front.dashboard');
        }
        else{
            $redirectUrl = url('/').'/first/add-details'; // The URL you want to redirect to after authentication
            // Use `state` to store the URL you want to redirect to after login
            return Socialite::driver('google')->stateless()->with(['redirect_url' => $redirectUrl])->redirect();
        }
         
    }

    public function handleGoogleCallback(Request $request)
    {
         
        $googleUser = Socialite::driver('google')->stateless()->user();
        
        $user = Member::where('email', $googleUser->email)->first();
        if ($user) 
        {
            if($user && is_null($user->mobile)){
                $request->session()->flash('error','Please complete the sign up...');
                return redirect()->route('first.details');
            }
            Auth::guard('member')->login($user);
        	return redirect()->route('user.dashboard');
     
        } else {
        
             $newUser = MemberTemp::create([
                 'full_name'      => $googleUser->getName(),
                 'email'     => $googleUser->getEmail(),
                 'google_id' => $googleUser->getId(),
                 'profile_pic' => $googleUser->getAvatar(),
                 'email_verified_at' => date('Y-m-d H:i:s'),
                ]);
        
                $request->session()->put('id_tempuser',$newUser->id);
    		    return redirect()->route('first.details');
        }
    }
    
    
    
}