<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEnquiry;
use App\Models\Ad;
use App\Models\Member;
use App\Models\SubscriptionHistory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        UserActivity::create([
            'user_id' => Auth::id(),
            'ip_address' => $request->ip(),
        ]);

        // Auto-mark ads as Expired if their expire_at date has passed
        // but status is still Published.
        Ad::where('delete_status', '0')
            ->where('status', 'Published')
            ->whereNotNull('expire_at')
            ->where('expire_at', '<', now())
            ->update(['status' => 'Expired']);

        $data['enquiries'] = UserEnquiry::take(4)->latest()->get();
        $data['history']   = SubscriptionHistory::take(4)->latest()->get();
        $data['users']     = Member::where('status', 'active')->take(4)->latest()->get();
        $data['ads']       = Ad::where('delete_status', '0')->take(4)->latest()->get();

        // Recent Expired Ads list for the dashboard table
        $data['expiredAds'] = Ad::with('category')
            ->where('delete_status', '0')
            ->where('status', 'Expired')
            ->orderBy('expire_at', 'DESC')
            ->take(4)
            ->get();

        $data['countpublishedAds'] = Ad::where('delete_status', '0')->where('status', 'Published')->count();
        $data['countpendingAds']   = Ad::where('delete_status', '0')->where('status', 'Pending')->count();
        $data['countExpiredAds']   = Ad::where('delete_status', '0')->where('status', 'Expired')->count();

        $data['countAds']  = Ad::where('delete_status', '0')->where('status', '!=', 'Rejected')->count();
        $data['countusers'] = Member::where('status', 'active')->count();

        return view('home', $data);
    }
}