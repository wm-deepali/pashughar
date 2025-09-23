<?php

namespace App\Http\Controllers;

use App\Mail\AdminMailForgetPassword;
use App\Models\LoginAttempt;
use App\Models\ProfileSetting;
use App\Models\SecuritySetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
    public function forgetPassword(){
        return view('auth.passwords.email');
    }
    
    public function resetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $profileSetting = ProfileSetting::first();
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);
        
        $mailData = ['token'=>$token];
        
        $mailContent =  Mail::to($profileSetting->email)->send(new AdminMailForgetPassword($mailData));

        return back()->with('status', 'We have e-mailed your password reset link! Please check your email in inbox, spam and junk folder.');
    }

    public function verifyToken($token){
        $tokenExist = DB::table('password_resets')->where('token',$token)->exists();
        if(!$tokenExist){
            return redirect()->route('admin.forget.password')->with('error','Invalid Password Change Request!!');
        }
        return view('auth.passwords.reset',['token' => $token]);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where(['token' => $request->token])->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $updatePassword->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        DB::table('password_resets')->where(['token' => $request->token])->delete();

        return redirect('/login')->with('success', 'Your password has been changed!');
    }

    public function loginAdmin(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // If the validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if user exists
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Invalid email or password'])->withInput();
        }

        // Fetch login attempt or create new if not exists
        $loginAttempt = LoginAttempt::firstOrCreate(['user_id' => $user->id]);

        // Fetch profile settings
        $profileSetting = SecuritySetting::first();
        $now = Carbon::now();

        // Check if the account is locked due to too many login attempts
        if ($loginAttempt->attempt_count >= $profileSetting->max_failed_login_admin && $loginAttempt->last_attempt_at && $loginAttempt->last_attempt_at->diffInMinutes($now) < 15) {
            $loginAttempt->update(['is_account_locked' => 1]);
            return redirect()->back()->with(['error' => 'Too many login attempts. Please try again in 15 minutes.'])->withInput();
        }

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication was successful, reset login attempts
            $loginAttempt->update(['attempt_count' => 0, 'last_attempt_at' => null, 'is_account_locked' => 0]);
            return redirect()->intended('/home');
        }

        // Authentication failed, increment login attempts
        $loginAttempt->update([
            'attempt_count' => $loginAttempt->attempt_count + 1,
            'last_attempt_at' => $now
        ]);

        // Redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid email or password'])->withInput();
    }
}
