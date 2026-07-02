<?php

namespace App\Http\Controllers;

use App\Models\WhatsappClick;
use App\Models\Ad;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WhatsappAnalyticsController extends Controller
{
    /**
     * Show WhatsApp Analytics - Month wise
     */
    public function index()
    {
        // Group clicks by month and ad
        $analytics = WhatsappClick::select(
                DB::raw('DATE_FORMAT(whatsapp_clicks.created_at, "%Y-%m") as month'),
                'ads.id as ad_id',
                'ads.title as ad_title',
                'ads.status as ad_status',
                'ads.user_id as seller_id',
                'seller.full_name as seller_name',
                'seller.email as seller_email',
                'seller.whatsapp_number as seller_whatsapp',
                DB::raw('GROUP_CONCAT(DISTINCT categories.name ORDER BY categories.id SEPARATOR " > ") as full_category'),
                DB::raw('COUNT(whatsapp_clicks.id) as total_clicks')
            )
            ->join('ads', 'whatsapp_clicks.ad_id', '=', 'ads.id')
            ->join('members as seller', 'ads.user_id', '=', 'seller.id')
            ->leftJoin('categories', 'ads.category_id', '=', 'categories.id')
            ->groupBy(
                'month',
                'ads.id',
                'ads.user_id',
                'seller.full_name',
                'seller.email',
                'seller.whatsapp_number',
                'ads.title',
                'ads.status'
            )
            ->orderBy('month', 'desc')
            ->get();

        return view('whatsapp-analytics.index', compact('analytics'));
    }

    /**
     * Show history page for a specific ad and month
     */
    public function history(Request $request, $adId, $month)
    {
        $ad = Ad::with('category')->findOrFail($adId);

        $history = WhatsappClick::select(
                DB::raw('DATE(whatsapp_clicks.created_at) as date'),
                DB::raw('COUNT(*) as total_clicks')
            )
            ->where('ad_id', $adId)
            ->whereYear('created_at', '=', date('Y', strtotime($month . '-01')))
            ->whereMonth('created_at', '=', date('m', strtotime($month . '-01')))
            ->groupBy(DB::raw('DATE(whatsapp_clicks.created_at)'))
            ->orderBy('date', 'desc')
            ->get();

        return view('whatsapp-analytics.history', compact('ad', 'month', 'history'));
    }

    /**
     * Show day-wise user click details for a specific ad
     */
    public function dayWise($adId, $date)
    {
        $ad = Ad::with('category')->findOrFail($adId);

        $clicks = WhatsappClick::with('user')
            ->where('ad_id', $adId)
            ->whereDate('created_at', $date)
            ->get();

        return view('whatsapp-analytics.daywise', compact('ad', 'date', 'clicks'));
    }
}
