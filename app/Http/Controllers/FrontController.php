<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Ad;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\Subscription;
use App\Models\Review;
use App\Models\Enquiry;
use App\Models\PurchaseEnquiry;
use App\Models\ContactUs;
use App\Models\ContactusContent;
use App\Models\AdFeature;
use App\Models\Feature;
use App\Models\ProfileSetting;
use App\Models\SubCategory;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use Validator;
use DB;
use Mail;
use App\Models\State;
use App\Models\City;
use App\Mail\EnquiryEmail;
use App\Mail\SubscriberEmail;
use App\Mail\CustomerInquiryEmail;
use App\Models\Pages;
use App\Models\Blogs;
use App\Models\Comments;
use App\Models\CustomerInquiry;
use App\Models\Faqs;
use App\Models\Abouts;
use App\Models\Teams;
use App\Rules\ReCaptcha;

class FrontController extends Controller
{
    public function index()
    {
        $data['suggestCategories'] = Category::with('subcategory', 'ads')->where('bottom_categories', 'yes')->get();
        $data['pageCategories'] = Category::with('subcategory', 'ads')->where('bottom_categories', 'yes')->take(8)->get();
        $data['subscriptions'] = Subscription::where('status', 1)->orderBy('offer_price', 'asc')->get();
        $data['featureAds'] = Ad::with('AdImage')
            ->wherehas('category')
            ->where('delete_status', '0')
            ->where('status', 'Published')
            ->where(function ($q) {
                $q->whereNull('expire_at')->orWhere('expire_at', '>=', now());
            })
            ->type('featured')
            ->take(4)
            ->get();

        $data['recommendAds'] = Ad::with('AdImage', 'category')
            ->wherehas('category')
            ->where('delete_status', '0')
            ->where('status', 'Published')
            ->where(function ($q) {
                $q->whereNull('expire_at')->orWhere('expire_at', '>=', now());
            })
            ->type('recommend')
            ->take(5)
            ->get();

        $data['trendingAds'] = Ad::with('AdImage')
            ->wherehas('category')
            ->where('delete_status', '0')
            ->where('status', 'Published')
            ->where(function ($q) {
                $q->whereNull('expire_at')->orWhere('expire_at', '>=', now());
            })
            ->type('trending')
            ->take(6)
            ->get();
        $data['faqs'] = Faqs::where('status', 1)->where('is_show_home', "yes")->get();
        // print_r($data['pageCategories']->toarray()); die;
        // dd($data['recommendAds']->toArray());
        return view('front.index', $data);
    }

    public function pagedetail($slug)
    {
        $data['page'] = Pages::where('slug', $slug)->first();
        return view('front.page-detail', $data);
    }

    public function contactuspage()
    {
        $data['contact'] = ContactusContent::first();
        return view('front.contact', $data);
    }

    public function blog()
    {
        $data['blogs'] = Blogs::where('status', 1)->get();
        return view('front.blog', $data);
    }

    public function blogdetail($slug)
    {
        $data['blog'] = Blogs::with([
            'comments' => function ($query) {
                $query->where('approve', 1); // Fetch comments where status is 1
            }
        ])->where('slug', $slug)->first();
        // Previous blog (created before current blog)
        $data['previous'] = Blogs::where('id', '<', $data['blog']->id)
            ->orderBy('id', 'desc')
            ->first();

        // Next blog (created after current blog)
        $data['next'] = Blogs::where('id', '>', $data['blog']->id)
            ->orderBy('id', 'asc')
            ->first();

        $data['blogs'] = Blogs::where('slug', '!=', $slug)->get();
        // print_r($data['blog']->toarray()); die;
        return view('front.blog-details', $data);
    }

    public function addComment(Request $request)
    {
        $comment = new Comments();
        $comment->blog_id = $request->blog_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('success', 'Comment Added successfully!');
    }

    public function faqs()
    {
        $data['faqs'] = Faqs::where('status', 1)->get();
        return view('front.faqs', $data);
    }

    public function about()
    {
        $data['about'] = Abouts::first();
        // print_r($data['about']); die;
        return view('front.about', $data);
    }

    public function getAdsBySearch(Request $request)
    {
        $inputValue = $request->inputValue;
        $ad = null;
        if ($inputValue) {
            $ad = Ad::where('title', 'like', '%' . $inputValue . '%')->where('status', 'Published')->with('category')->get();
        }
        return response()->json($ad);
    }

    public function ourTeam()
    {
        $data['teams'] = Teams::where('status', 1)->get();
        return view('front.our-team', $data);
    }
    public function categoryList()
    {
        $data['categories'] = Category::get();
        $data['subscriptions'] = Subscription::where('status', 1)->orderBy('offer_price', 'asc')->get();
        $data['canonical'] = route('list-categories');
        return view('front.categories', $data);
    }

    public function categoryDetail(Request $request, $slug)
    {
        $min = null;
        $max = null;
        $perPage = 10;
        $type = 'all';
        if ($request->has('type'))
            $type = $request->query('type');
        if ($request->has('perPage'))
            $perPage = $request->query('perPage');
        if ($request->has('min'))
            $min = $request->query('min');
        if ($request->has('max'))
            $max = $request->query('max');

        $data['category'] = Category::with('subcategory')->where('slug', $slug)->first();

        $query = Ad::with('AdImage')
            ->where('delete_status', '0')
            ->where('status', 'Published')
            ->where(function ($q) {
                $q->whereNull('expire_at')->orWhere('expire_at', '>=', now());
            })
            ->type($type)
            ->search($min, $max);

        if ($request->subcatid) {
            $query->whereIn('subcategory_id', $request->subcatid);
        } else {
            $query->where('category_id', $data['category']->id);
        }
        $data['ads'] = $query->paginate($perPage)->withQueryString();

        $data['categories'] = Category::all();
        // canonical always points to the clean category URL, ignoring filter/sort/paging query params
        $data['canonical'] = route('category-details', $data['category']->slug);

        return view('front.categories-details', $data);
    }

    public function subCategoryDetail(Request $request, $categorySlug, $subSlug)
    {
        $min = null;
        $max = null;
        $perPage = 10;
        $type = 'all';
        if ($request->has('type'))
            $type = $request->query('type');
        if ($request->has('perPage'))
            $perPage = $request->query('perPage');
        if ($request->has('min'))
            $min = $request->query('min');
        if ($request->has('max'))
            $max = $request->query('max');

        $data['category'] = Category::with('subcategory')->where('slug', $categorySlug)->firstOrFail();
        $subcategory = $data['category']->subcategory->where('slug', $subSlug)->first();

        if (!$subcategory) {
            abort(404);
        }

        $query = Ad::with('AdImage')
            ->where('delete_status', '0')
            ->where('status', 'Published')
            ->where(function ($q) {
                $q->whereNull('expire_at')->orWhere('expire_at', '>=', now());
            })
            ->where('subcategory_id', $subcategory->id)
            ->type($type)
            ->search($min, $max);

        $data['ads'] = $query->paginate($perPage)->withQueryString();
        $data['categories'] = Category::all();
        $data['currentSubcategory'] = $subcategory;
        $data['canonical'] = route('subcategory-details', [$categorySlug, $subSlug]);

        // reuse the same categories-details view, just scoped to a subcategory
        return view('front.categories-details', $data);
    }

    public function adDetail($category_name, $slug)
    {
        $ad = Ad::where('slug', $slug)->where('delete_status', '0')->first();

        if (empty($ad)) {
            abort(404);
        }

        $ad->views = $ad->views + 1;
        $ad->save();

        $data['ad'] = Ad::with('category', 'subcategory', 'brand', 'user', 'adFeature', 'AdImage', 'reviews', 'adSpecification')
            ->where('slug', $slug)
            ->where('delete_status', '0')
            ->first();

        $data['adCount'] = Ad::where('delete_status', '0')->where('status', 'Published')->where('user_id', $ad->user_id)->count();
        $data['states'] = State::where('country_id', 1)->get();

        return view('front.ad-details', $data);
    }

    public function purchaseSubscription()
    {
        $data['subscriptions'] = Subscription::where('status', 1)->orderBy('offer_price', 'asc')->get();
        return view('front.our-subscription', $data);
    }

    public function cities_by_state(Request $request)
    {
        $id = $request->state_id;
        $city = DB::table('cities')->where('state_id', $id)->get();
        //dd($city);
        $response = '';
        if (isset($city)) {
            $response = '<option value="">Select City </option>';
            foreach ($city as $row) {
                $response .= '<option value=' . $row->id . '>' . $row->name . '</option>';
            }
        } else {
            $response .= '<option value="">No City Found </option>';
        }

        return response()->json($response);
    }



    public function saveContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => 'All fields are required',
            ]);
        }
        $contact = new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();
        $adminsetting = ProfileSetting::first();

        $mailContent = Mail::to($adminsetting->email)->send(new EnquiryEmail($contact));

        if ($mailContent) {
            return response()->json([
                'success' => true,
                'message' => 'enquiry save Succesfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ]);
        }
    }


    public function allAds(Request $request)
    {
        $min = null;
        $max = null;
        $perPage = 10;
        $search = null;
        $type = 'all';
        if ($request->has('type'))
            $type = $request->query('type');
        if ($request->has('perPage'))
            $perPage = $request->query('perPage');
        if ($request->has('min'))
            $min = $request->query('min');
        if ($request->has('max'))
            $max = $request->query('max');
        if ($request->has('search'))
            $search = $request->query('search');
        $data['ads'] = Ad::whereHas('category')->with('AdImage', 'category')->where('delete_status', '0')->where('status', 'Published')->type($type)->search($min, $max)->SearchData($search)->paginate($perPage)->withQueryString();

        $data['categories'] = Category::get();
        return view('front.ad-list', $data);
    }
    public function search(Request $request)
    {
        $min = null;
        $max = null;
        $search = null;
        $perPage = 10;
        $type = 'all';
        $type = 'all';
        if ($request->has('type'))
            $type = $request->query('type');
        if ($request->has('perPage'))
            $perPage = $request->query('perPage');
        if ($request->has('min'))
            $min = $request->query('min');
        if ($request->has('max'))
            $max = $request->query('max');
        if ($request->has('search'))
            $search = $request->query('search');
        $data['ads'] = Ad::with('AdImage')->where('delete_status', '0')->where('status', 'Published')->type($type)->search($min, $max)->SearchData($search)->paginate($perPage)->withQueryString();
        return redirect()->route('list-all-ads', ['search' => $search]);
    }

    public function saveadRreview(Request $request)
    {
        $request->validate([
            're_name' => 'required',
            're_email' => 'required|email',
            're_mobile' => 'required|digits:10|numeric',
            'quote.*' => 'required',
            'ratings' => 'required',
            'review' => 'required',
            'g-recaptcha-response' => 'required'
        ], [
            're_name.required' => 'Name field is required!',
            're_email.required' => 'Email field is required!',
            're_mobile.required' => 'The mobile field is required!',
            're_mobile.digits' => 'The mobile field must be 10 digits',
            're_mobile.numeric' => 'The mobile field must be a number!',
            'quote.required' => 'The rate for field is required!',
        ]);

        if (Auth::guard('member')->check()) {
            $member_id = Auth::guard('member')->user()->id;

            $existReview = Review::where('member_id', $member_id)
                ->where('ad_id', $request->ad_id)->first();

            $ad = Ad::find($request->ad_id);

            if (!$ad) {
                return response()->json(['success' => false, 'message' => 'Ad not found']);
            }

            if ($existReview) {
                return response()->json(['success' => false, 'message' => 'Review already exists']);
            }

            // Save review
            $ad->increment('total_review');

            $review = new Review();
            $review->member_id = $member_id;
            $review->ad_id = $request->ad_id;
            $review->name = $request->re_name;
            $review->email = $request->re_email;
            $review->mobile = $request->re_mobile;
            $review->quote = implode(",", $request->quote) ?? "";
            $review->rating = $request->ratings;
            $review->review = $request->review;
            $review->save();

            DB::table('ad_reviews_temp')
                ->where('ad_id', $request->ad_id)
                ->where('email', $request->re_email)
                ->delete();

            return response()->json(['success' => true, 'message' => 'Review saved successfully']);
        } else {
            DB::table('ad_reviews_temp')->insert([
                'ad_id' => $request->ad_id,
                'name' => $request->re_name,
                'email' => $request->re_email,
                'mobile' => $request->re_mobile,
                'quote' => implode(",", $request->quote) ?? "",
                'rating' => $request->ratings,
                'review' => $request->review,
            ]);

            return response()->json([
                'success' => false,
                'redirect' => route('user.login'),
                'message' => 'Register user only can Rate & Review, please signup/login to continue'
            ]);
        }
    }

    public function saveadEnquiry(Request $request)
    {

        $ad = Ad::findOrFail($request->en_ad_id);


        if (!empty($ad)) {
            if (isset($request->message) && $request->message != "") {
                $ad->total_enquiry = $ad->total_enquiry + 1;
                $ad->save();
                $enquiry = new PurchaseEnquiry();

                $enquiry->ad_id = $request->en_ad_id;
                $enquiry->type = $request->e_type;
                $enquiry->name = $request->e_name;
                $enquiry->email = $request->e_email;
                $enquiry->detail = $request->message;
                $enquiry->mobile_number = $request->e_mobile_number;
                $enquiry->telegram_id = $request->e_telegram_id;
                $enquiry->country = $request->e_country;
                $enquiry->state = $request->e_state;
                $enquiry->city = $request->e_city ?? "";
                $enquiry->status = 'Pending';


                $enquiry->save();

                return redirect()->route('ad-details', [base64_encode($ad->id), $ad->slug])->withSuccess('Enquiry post successfully.');
            } else {
                return redirect()->route('ad-details', [base64_encode($ad->id), $ad->slug])->withErrors('Enquiry details field required!');
            }

        } else {
            return redirect()->route('ad-details', [base64_encode($ad->id), $ad->slug])->withErrors('Ad not found!');
        }
    }
    public function saveSubscribers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_email' => 'required|unique:subscribers,email',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => 'Eamil already subscribed',
            ]);
        }
        $subscriber = new Subscriber();

        $subscriber->email = $request->news_email;

        $subscriber->save();

        $mailContent = Mail::to($request->news_email)->send(new SubscriberEmail());

        if ($mailContent) {
            return response()->json([
                'success' => true,
                'message' => 'Subscribe Succesfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ]);
        }
    }

    public static function getfeature($ad, $features_name)
    {
        $feature = AdFeature::where('ad_id', $ad)->where('features_name', $features_name)->first();
        if (!empty($feature)) {
            if ($features_name == 'brand') {
                $brand = BrandCategory::where('id', $feature->features)->first();
                return $brand->name ?? '';
            }
            if ($features_name == 'age_in_year' || $features_name == 'age_in_months' || $features_name == 'age_approx') {
                $months = AdFeature::where('ad_id', $ad)->where('features_name', 'age_in_months')->first();
                $approx = AdFeature::where('ad_id', $ad)->where('features_name', 'age_approx')->first();

                $monthString = !empty($months) && $months->features > 0 ? $months->features . 'Months' : '';

                $approxString = !empty($approx) && $approx->features == 'yes' ? '(Approx)' : '';

                $yearString = $feature->features > 0 ? $feature->features . 'Years' : '';

                return $yearString . ' ' . $monthString . ' ' . $approxString;
            }

            if ($features_name == 'weight' || $features_name == 'weight_in') {
                $weight_in = AdFeature::where('ad_id', $ad)->where('features_name', 'weight_in')->first();


                $unit = $weight_in->features == 'Kilogram' ? 'Kg' : $weight_in->features;

                return $feature->features . '' . $unit;

            }
            if ($features_name == 'average_weight' || $features_name == 'average_weight_in') {
                $weight_in = AdFeature::where('ad_id', $ad)->where('features_name', 'average_weight_in')->first();
                $unit = $weight_in->features == 'Kilogram' ? 'Kg' : $weight_in->features;

                return $feature->features . '' . $unit . '(Approx)';
            } else {
                return $feature->features;
            }

        } else {
            return '';
        }
    }

    public function sendPurchaseOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|digits:10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first('mobile_number'),
            ]);
        }

        $otp = rand(1000, 9999);
        $mobile_number = $request->mobile_number;

        OTP::where('mobile', $mobile_number)->delete();
        OTP::create([
            'mobile' => $mobile_number,
            'otp' => $otp,
            'expiry' => now()->addMinutes(10),
        ]);

        $message = "$otp is the One Time Password(OTP) to verify your MOB number at Web Mingo, This OTP is Usable only once and is valid for 10 min,PLS DO NOT SHARE THE OTP WITH ANYONE";


        $params = [
            'authkey' => '133780AWLy8zZpC690b124aP1',
            'mobiles' => $mobile_number,
            'sender' => 'WMINGO',
            'message' => urlencode($message),
            'route' => '4',
            'country' => '91',
            'PE_ID' => '1301160576431389865',
            'DLT_TE_ID' => '1307161465983326774'
        ];

        $url = 'http://sms.webmingo.in/api/sendhttp.php?' . http_build_query($params);

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_exec($ch);
            curl_close($ch);

            return response()->json(['success' => true, 'message' => 'OTP Sent on Your Mobile Number, Kindly Enter OTP to verify']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => 'Unable to send OTP right now, please try again.']);
        }
    }

    public function savePurchaseEnquiry(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ad_id' => 'required|exists:ads,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'mobile_number' => 'required|digits:10',
            'telegram_id' => 'nullable',
            'country' => 'required',
            'state' => 'nullable|exists:states,id',
            'city' => 'nullable',
            'detail' => 'nullable|string',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'code' => 422,
                'errors' => $validator->errors()->first(),
            ]);
        }

        $enquiry = new PurchaseEnquiry();
        $enquiry->ad_id = $request->ad_id;
        $enquiry->name = $request->name;
        $enquiry->email = $request->email ?? '';
        $enquiry->mobile_number = $request->mobile_number;
        $enquiry->telegram_id = $request->telegram_id;
        $enquiry->country = $request->country;
        $enquiry->state = $request->state ?? '';
        $enquiry->city = $request->city ?? '';
        $enquiry->detail = $request->detail;
        $enquiry->status = 'Pending';
        $enquiry->type = $request->type;
        $enquiry->save();

        return response()->json([
            'success' => true,
            'message' => 'Purchase Enquiry Submit Succesfully',
        ]);
    }

    public function submithomepageEnquiry(Request $request)
    {
        $validatedData = $request->validate(
            [
                'full_name' => 'required|string|max:255',
                'email_address' => 'required|email|max:255',
                'country_code' => 'required|string|max:5',
                'mobile' => ['required', 'regex:/^[6-9]\d{9}$/'],
                'isValid' => ['required', 'integer', 'in:1'],
                'message' => 'nullable|string|max:50',
            ],
            [
                'isValid.required' => 'Mobile number is not verified',
                'isValid.integer' => 'Mobile number is not verified',
                'isValid.in' => 'Please verify your mobile number before submitting.',
            ]
        );
        //dd($validatedData);
        $enquiry = new CustomerInquiry();
        $enquiry->full_name = $validatedData['full_name'];
        $enquiry->email_address = $validatedData['email_address'];
        $enquiry->country_code = $validatedData['country_code'];
        $enquiry->mobile_number = $validatedData['mobile'];
        $enquiry->message = $validatedData['message'] ?? null; // handle optional message
        $enquiry->save();

        $adminsetting = ProfileSetting::first();
        $mailContent = Mail::to($adminsetting->email)->send(new CustomerInquiryEmail($enquiry));

        return response()->json([
            'message' => 'Thank you for your enquiry. We will get back to you soon.'
        ]);
    }


}
