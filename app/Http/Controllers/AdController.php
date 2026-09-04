<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategorySubscription;
use App\Models\Subscription;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Member;
use App\Models\BrandCategory;
use App\Models\Ad;

use App\Models\SubscriptionHistory;
use App\Models\SubscriptionOrder;
use App\Models\AdFeature;
use App\Models\AdImage;
use App\Models\Review;
use App\Models\Enquiry;
use App\Models\PurchaseEnquiry;
use App\Models\AdSpecification;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class AdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Auto-mark ads as Expired if their expire_at date has passed
        Ad::where('status', 'Published')
            ->whereNotNull('expire_at')
            ->where('expire_at', '<', now())
            ->update(['status' => 'Expired']);

        // Active tab (default: Published)
        $status = $request->get('status', 'Published');
        $allowedStatus = ['Pending', 'Published', 'Expired', 'Rejected'];
        if (!in_array($status, $allowedStatus)) {
            $status = 'Published';
        }

        $query = Ad::with('AdImage', 'brandCategory', 'category', 'subcategory', 'brand', 'user', 'adFeature')
            ->where('status', $status);

        // Filters
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('subcategory_id')) {
            $query->where('subcategory_id', $request->subcategory_id);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $data['ads'] = $query->orderBy('created_at', 'DESC')->get();
        $data['activeStatus'] = $status;

        // Counts for tab badges
        $data['pendingAdsCount'] = Ad::where('status', 'Pending')->count();
        $data['publishedAdsCount'] = Ad::where('status', 'Published')->count();
        $data['expiredAdsCount'] = Ad::where('status', 'Expired')->count();
        $data['rejectedAdsCount'] = Ad::where('status', 'Rejected')->count();

        // Filter dropdown data
        $data['categories'] = Category::orderBy('name')->get();
        $data['subcategories'] = SubCategory::orderBy('name')->get();

        // Keep filter values sticky in the form
        $data['filters'] = $request->only(['category_id', 'subcategory_id', 'date_from', 'date_to']);

        return view('ads.index', $data);
    }

    /**
     * Extend the expiry date of an Ad and republish it.
     */
    public function extendExpiryDate(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'expire_at' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $ad = Ad::findOrFail($id);
        $ad->expire_at = $request->expire_at;
        $ad->status = 'Published'; // ad becomes visible again
        $ad->admin_edited_at = date('Y-m-d H:i:s');
        $ad->save();

        return redirect()->route('manage-ads.index', ['status' => 'Expired'])
            ->with('success', 'Expiry date extended. Ad is now Published again.');
    }

    public function selleradsEnquiries($id = "")
    {

        if (isset($id) && $id != "") {
            $data['enquiries'] = PurchaseEnquiry::where('ad_id', $id)->where('type', 'Direct Enquriy')->orderBy('created_at', 'DESC')->get();
        } else {
            $data['enquiries'] = PurchaseEnquiry::orderBy('created_at', 'DESC')->get();
        }

        return view('ads.enquiries', $data);
    }
    public function buyNowEnquiries($id = "")
    {

        if (isset($id) && $id != "") {
            $data['enquiries'] = PurchaseEnquiry::where('ad_id', $id)->where('type', 'Book Now')->orderBy('created_at', 'DESC')->get();
        } else {
            $data['enquiries'] = PurchaseEnquiry::orderBy('created_at', 'DESC')->get();
        }

        return view('ads.buy-now-enquiries', $data);
    }
    public function adreviews()
    {

        $data['enquiries'] = Review::orderBy('created_at', 'DESC')->get();


        return view('ads.reviews', $data);
    }

    public function adAnalytics()
    {
        //
        $data['ads'] = Ad::with('AdImage', 'brandCategory', 'category', 'subcategory', 'brand', 'user', 'adFeature', 'subscription')->where('status', 'Published')->orderBy('created_at', 'DESC')->get();
        return view('ads.analytics', $data);
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
            $ad = Ad::with('AdImage', 'brandCategory', 'category', 'subcategory', 'brand', 'user', 'adFeature', 'adSpecification')->where('id', $id)->first();
            return response()->json([
                "msgCode" => "200",
                "html" => view('ads.preview-ad')->with('ad', $ad)->render(),
            ]);
        } catch (\Exception $ex) {
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
        //
        $ad = Ad::with('AdImage', 'adFeature', 'adSpecification')->where('id', $id)->first();
        $data['ad'] = $ad;
        $data['features'] = featcherformData();
        $data['categories'] = Category::orderBy('created_at', 'DESC')->get();
        $data['subcategories'] = SubCategory::where('category_id', $ad->category_id)->orderBy('created_at', 'DESC')->get();
        $data['brandcategories'] = BrandCategory::orderBy('created_at', 'DESC')->get();
        $data['brands'] = Brand::where('brand_category_id', $ad->brand_category)->orderBy('created_at', 'DESC')->get();
        return view('ads.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */

    public function manageAdsStatusUpdate(Request $request, string $id)
    {
        $ad = Ad::findOrFail($id);
        $ad->status = $request->status;
        $ad->admin_edited_at = date('Y-m-d H:i:s');
        $ad->published_date = $request->status == 'Published' ? date('Y-m-d H:i:s') : NULL;
        $ad->save();
        return redirect()->route('manage-ads.index')
            ->with('success', 'Ad Updated successfully');
    }
    public function update(Request $request, string $id)
    {
        //
        $ad = Ad::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',

        ]);
        if ($validator->fails()) {
            return redirect()->route('manage-ads.edit', $id)
                ->with('error', $validator->errors());
        } else {

            if ($request->hasFile('image')) {

                $prevImage = AdImage::where('ad_id', $id)->get();
                if (isset($prevImage) && count($prevImage) > 0) {
                    foreach ($prevImage as $pimage) {
                        Storage::disk('public')->delete($pimage->image);
                    }
                }
                AdImage::where('ad_id', $id)->delete();
                foreach ($request->file('image') as $image) {
                    $path = $image->store('ad_image', 'public');
                    AdImage::create([
                        'ad_id' => $id,
                        'image' => $path,
                    ]);

                }
            }

            $slug = Str::slug($request->title);
            $ad->title = $request->title;
            $ad->slug = $slug;
            $ad->category_id = $request->category_id;
            $ad->subcategory_id = $request->subcategory_id;

            $ad->price = $request->price;
            $ad->price_type = $request->price_type ?? 0;
            $ad->description = $request->description;
            $ad->location = $request->location;
            $ad->author_name = $request->author_name;
            $ad->author_email = $request->author_email;
            $ad->author_mobile = $request->author_mobile;
            $ad->author_address = $request->author_address;
            $ad->status = $request->status;

            // SEO fields with fallback if left empty
            $ad->meta_title = $request->filled('meta_title')
                ? Str::limit($request->meta_title, 255, '')
                : Str::limit($request->title, 255, '');

            $ad->meta_keyword = $request->filled('meta_keyword')
                ? $request->meta_keyword
                : null;

            $ad->meta_description = $request->filled('meta_description')
                ? Str::limit($request->meta_description, 255)
                : Str::limit("{$request->title} - Buy now on PashuGhar at ₹{$request->price}. Location: {$request->author_address}. Contact seller directly.", 255);

            $ad->published_date = $request->status == 'Published' ? date('Y-m-d H:i:s') : NULL;
            $ad->admin_edited_at = date('Y-m-d H:i:s');
            $ad->save();
            $age_approx = $request->has('age_approx') ? 'yes' : '';

            $request->merge(["age_approx" => $age_approx]);
            $data = $request->except('_method', '_token', 'title', 'category_id', 'subcategory_id', 'brand_category', 'brand_id', 'price', 'description', 'tags', 'author_name', 'author_email', 'author_mobile', 'author_address', 'email_alert', 'image', 'status', 'expire_at', 'price_type', 'location', 'specifications', 'meta_title', 'meta_keyword', 'meta_description');


            AdFeature::where('ad_id', $ad->id)->delete();
            $featureData = featcherformData();
            $fetKeys = array_keys($featureData);

            foreach ($data as $key => $setval) {
                if (in_array($key, $fetKeys)) {
                    AdFeature::create([
                        'ad_id' => $id,
                        'features_name' => $key,
                        'features' => $setval,
                    ]);
                }

            }

            AdSpecification::where('ad_id', $ad->id)->delete();
            if ($request->has('specifications')) {
                foreach ($request->specifications as $k => $specification) {
                    AdSpecification::create([
                        'ad_id' => $id,
                        'specification' => $specification,
                    ]);

                }
            }
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $path = $image->store('ad_image', 'public');// Example storage locatio
                    AdImage::create([
                        'ad_id' => $id,
                        'image' => $path,
                    ]);

                }
            }
            return redirect()->route('manage-ads.index')
                ->with('success', 'Ad Updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ad = Ad::findOrFail($id);
        if (!empty($ad)) {
            $user_id = $ad->user_id;
            $sub_id = $ad->plan_id;
            $member = Member::findOrFail($user_id);
            if (!empty($member)) {
                $member->no_of_ads = $member->no_of_ads + 1;
                $member->save();
            }

            $history = SubscriptionHistory::where('id', $sub_id)->first();
            if (!empty($history)) {
                $history->used_ads = $history->used_ads - 1;
                $history->remaining_ads = $history->remaining_ads + 1;
                $history->save();
                $order = SubscriptionOrder::where('order_number', $history->order_number)->first();
                if (!empty($order)) {
                    $order->used_ads = $order->used_ads - 1;
                    $order->remaining_ads = $order->remaining_ads + 1;
                    $order->save();
                }
            }

            $prevImage = AdImage::where('ad_id', $id)->get();
            if (isset($prevImage) && count($prevImage) > 0) {
                foreach ($prevImage as $pimage) {
                    Storage::disk('public')->delete($pimage->image);
                }
            }
            AdFeature::where('ad_id', $id)->delete();
            AdImage::where('ad_id', $id)->delete();
            Enquiry::where('ad_id', $id)->delete();
            Review::where('ad_id', $id)->delete();
            AdSpecification::where('ad_id', $id)->delete();
            $ad->delete();
        }

        return redirect()->route('manage-ads.index')->with('success', 'Ad deleted successfully!');
    }
    public function deleteEnquiry(string $id)
    {

        $enquiry = Enquiry::findOrFail($id);

        $ad = Ad::findOrFail($enquiry->ad_id);

        if (!empty($ad)) {
            $ad->total_enquiry = $ad->total_enquiry - 1;
            $ad->save();
        }


        $enquiry->delete();

        return redirect()->route('seller-ads-enquiries')->with('success', 'Enquiry deleted successfully!');
    }
    public function deletereview(string $id)
    {

        $review = Review::findOrFail($id);

        $ad = Ad::findOrFail($review->ad_id);

        if (!empty($ad)) {
            $ad->total_review = $ad->total_review - 1;
            $ad->save();
        }


        $review->delete();

        return redirect()->route('ad-reviews')->with('success', 'Review deleted successfully!');
    }

    public function showEnquiry(string $id)
    {
        //
        try {
            $enquiry = PurchaseEnquiry::findOrFail($id);
            return response()->json([
                "msgCode" => "200",
                "html" => view('ads.view-enquiry')->with('enquiry', $enquiry)->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'msgCode' => '400',
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
    public function deletebuyNowEnquiry(string $id)
    {

        $enquiry = PurchaseEnquiry::findOrFail($id);
        $enquiry->delete();

        return redirect()->route('buy-now-enquiries')->with('success', 'Enquiry deleted successfully!');
    }

    public function showbuyNowEnquiry(string $id)
    {
        //
        try {
            $enquiry = PurchaseEnquiry::findOrFail($id);
            return response()->json([
                "msgCode" => "200",
                "html" => view('ads.view-buy-now-enquiry')->with('enquiry', $enquiry)->render(),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'msgCode' => '400',
                'msgText' => $ex->getMessage(),
            ]);
        }
    }
}