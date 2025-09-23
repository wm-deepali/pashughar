<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberAuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\WalletOnlinePaymentController;

use App\Http\Controllers\PagesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\ManageEnquiryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SeoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[FrontController::class,'index']);
Route::get('categories',[FrontController::class,'categoryList'])->name('categories');
Route::get('category-details/{slug}',[FrontController::class,'categoryDetail'])->name('category-details');
Route::get('sub-details/{subcategoryname}/{id}',[FrontController::class,'subcategoryDetail'])->name('sub-details');
Route::get('ad-details/{id}/{slug}',[FrontController::class,'adDetail'])->name('ad-details');
Route::get('purchase-subscription',[FrontController::class,'purchaseSubscription'])->name('purchase-subscription');
Route::get('ads-list',[FrontController::class,'allAds'])->name('ads-list');
Route::post('cities-by-state',[FrontController::class,'cities_by_state'])->name('cities-by-state');
Route::post('save-Subscriber',[FrontController::class,'saveSubscribers'])->name('save-Subscriber');

Route::post('save-purchase-enquiry',[FrontController::class,'savePurchaseEnquiry'])->name('save-purchase-enquiry');

Route::post('save-ad-review',[FrontController::class,'saveadRreview'])->name('save-ad-review');
Route::post('save-ad-enquiry',[FrontController::class,'saveadEnquiry'])->name('save-ad-enquiry');
Route::get('contact-us', function () {
    return view('front.contact');
})->name('contact-us');


Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    $data= Artisan::call('storage:link');
    return $data;
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');

    return "Cleared!";
});

Route::get('veterinary-registration', function () {
    return view('front.veterinary-registration');
})->name('veterinary-registration');
Route::get('veterinary-help', function () {
    return view('front.veterinary-help');
})->name('veterinary-help');

Route::get('Page-Detail/{id}',[FrontController::class,'pagedetail'])->name('pagedetail');

Route::get('terms-condition', function () {
    return view('front.terms-condition');
})->name('terms-condition');

Route::get('our-team',[FrontController::class,'ourTeam'])->name('our-team');

Route::get('blog',[FrontController::class,'blog'])->name('blog');
Route::get('blog-details/{id}',[FrontController::class,'blogdetail'])->name('blog-details');
Route::post('Add-Comment', [FrontController::class,'addComment'])->name('comment.store');

Route::get('bulk-enquiry',[EnquiryController::class,'bulkEnquiry'])->name('bulk-enquiry');
Route::post('get-cites',[EnquiryController::class,'getCites'])->name('get-cites');
Route::post('Add-Enquiry',[EnquiryController::class,'addEnquiry'])->name('enquiry.add');

Route::get('faqs',[FrontController::class,'faqs'])->name('faqs');
Route::get('about-us',[FrontController::class,'about'])->name('about-us');
Route::post('getAdsBySearch',[FrontController::class,'getAdsBySearch'])->name('getAdsBySearch');

Route::get('search',[FrontController::class,'search'])->name('search');
Route::post('save-contact-us',[FrontController::class,'saveContactUs'])->name('save-contact-us');

Route::post('add-save-ad-post',[MemberAuthController::class,'saveAdPost'])->name('add-save-ad-post');

Route::get('user/login', function () {
    return view('front.user-login');
})->name('user.login');
Route::controller(GoogleController::class)->group(function() {
    Route::get('user/google/redirect', 'redirectToGoogle')->name('google.redirect');
    Route::get('user/google/callback', 'handleGoogleCallback')->name('google.callback');
});

Route::controller(RazorpayPaymentController::class)->group(function() {
    Route::post('user/payment-store', 'store')->name('user.payment-store');
    Route::get('user/create-order/{amount}/{email}', 'createOrder')->name('user.create-order');
});
Route::controller(MemberAuthController::class)->group(function() {
    Route::get("getusername/{id}",'getusername');
    Route::post('/check-email', 'checkEmail')->name('check-email');
    Route::post('sendOtp', 'sendMobileOTP')->name('mobileVerify');
    Route::post('verifyOTP','verifyOTP')->name('verifyOTP');
    Route::get('account/verify/{token}', 'verifyAccount')->name('user.verify');
    Route::post('user/register', 'register')->name('user.register');
    Route::post('/authenticate', 'authenticate')->name('user.authenticate');
    Route::post('send/otp', 'sendOtp')->name('sendotp');
    Route::post('verify/otp', 'verifymobilenumber')->name('verifymobilenumber');
    Route::get('first/add-details', 'addRequiredDetails')->name('first.details');
    Route::post('first/add-details/store', 'storeRequiredDetails')->name('first.details.store');
    Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
    Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    Route::post('user/send-otp', 'sendUSerOtp')->name('senduserotp');
    Route::post('user/verify-otp', 'verifyUsermobilenumber')->name('verifyusermobilenumber');
    

    Route::get('user/my-wallet', 'myWallet')->name('user.my-wallet');
    Route::get('user/thankyou', 'myWallet')->name('thankyou');
    Route::get('user/thankyou', function () {
    return view('front.thankyou');
    })->name('user.thankyou'); 
    Route::get('user/dashboard', 'dashboard')->name('user.dashboard');
    Route::get('user/profile', 'profile')->name('user.profile');
    Route::get('user/ad-post', 'adPost')->name('user.ad-post');
    Route::get('user/my-ads', 'myAds')->name('user.my-ads');
    Route::get('user/settings', 'settings')->name('user.settings');
    Route::post('save/settings', 'saveSettings')->name('save.settings');
    Route::get('user/checkout/{id}', 'checkout')->name('user.checkout');
    Route::post('user.save-address-info', 'saveaddressinfo')->name('user.save-address-info');
    
    Route::get('user/ad-enquiries/{id}', 'AdEnquiry')->name('user.ad-enquiries');
    Route::post('user/save-ad-post', 'saveAdPost')->name('user.save-ad-post');
    Route::get('user/edit-ad-post/{id}', 'EditAdPost')->name('user.edit-ad-post');
    Route::get('user/delete-ad/{id}', 'deleteAd')->name('user.delete-ad');
    Route::post('user/update-ad-post/{id}', 'updateAdPost')->name('user.update-ad-post');
    Route::get('user/buy-subscription','buySubscription')->name('user.buy-subscription');
    Route::get('user/my-subscriptions','mySubscription')->name('user.my-subscriptions');
    Route::post('free-subscription', 'free_subscription')->name('free-subscription');
        Route::get('user/my-enquiries','allPurchaseEnquiry')->name('user.my-enquiries');

    Route::get('user/logout', 'logout')->name('user.logout');
});

Route::controller(ContentController::class)->group(function() {
    Route::get('fetch-subcategory/{id}', 'fetchSubcategory')->name('fetch-subcategory');
    Route::get('fetch-brand/{id}', 'fetchBrand')->name('fetch-brand');
    Route::get('fetch-feature-form-data/{id}', 'fetchFeatureFormData')->name('fetch-feature-form-data');
    Route::get('fetch-form-data/{catid}/{subcatid}', 'fetchFormData')->name('fetch-form-data');
    Route::get('fetch-fuel-type/{type}', 'fetchFuelType')->name('fetch-fuel-type');
});

Route::post('login/admin',[ForgetPasswordController::class,'loginAdmin'])->name('admin.login');
Route::get('admin-settings',[AdminController::class,'adminSettings'])->name('admin.settings');
Route::get('master/categories',[AdminController::class,'categoriesIndex'])->name('master.category.index');
Route::get('master/categories/add',[AdminController::class,'categoriesAdd'])->name('master.category.add');
Route::post('master/categories/store',[AdminController::class,'categoriesStore'])->name('master.category.store');
Route::get('master/categories/edit/{id}',[AdminController::class,'categoriesEdit'])->name('master.category.edit');
Route::post('master/categories/update/{id}',[AdminController::class,'categoriesUpdate'])->name('master.category.update');
Route::delete('master/categories/delete/{id}',[AdminController::class,'categoriesDestroy'])->name('master.category.destroy');

Route::get('master/subcategories',[AdminController::class,'subcategoriesIndex'])->name('master.subcategory.index');
Route::get('master/subcategories/add',[AdminController::class,'subcategoriesAdd'])->name('master.subcategory.add');
Route::post('master/subcategories/store',[AdminController::class,'subcategoriesStore'])->name('master.subcategory.store');
Route::get('master/subcategories/edit/{id}',[AdminController::class,'subcategoriesEdit'])->name('master.subcategory.edit');
Route::post('master/subcategories/update/{id}',[AdminController::class,'subcategoriesUpdate'])->name('master.subcategory.update');
Route::delete('master/subcategories/delete/{id}',[AdminController::class,'subcategoriesDestroy'])->name('master.subcategory.destroy');

Route::get('master/country',[AdminController::class,'countryIndex'])->name('master.country.index');
Route::post('master/country/store',[AdminController::class,'countryStore'])->name('master.country.store');
Route::post('master/country/update/{id}',[AdminController::class,'countryUpdate'])->name('master.country.update');
Route::delete('master/country/destroy/{id}',[AdminController::class,'countryDestroy'])->name('master.country.destroy');

Route::get('master/state',[AdminController::class,'stateIndex'])->name('master.state.index');
Route::post('master/state/store',[AdminController::class,'stateStore'])->name('master.state.store');
Route::post('master/state/update/{id}',[AdminController::class,'stateUpdate'])->name('master.state.update');
Route::delete('master/state/destroy/{id}',[AdminController::class,'stateDestroy'])->name('master.state.destroy');

Route::get('master/city',[AdminController::class,'cityIndex'])->name('master.city.index');
Route::post('master/city/store',[AdminController::class,'cityStore'])->name('master.city.store');
Route::post('master/city/update/{id}',[AdminController::class,'cityUpdate'])->name('master.city.update');
Route::delete('master/city/destroy/{id}',[AdminController::class,'cityDestroy'])->name('master.city.destroy');

Route::get('master/location',[AdminController::class,'locationIndex'])->name('master.location.index');
Route::post('master/location/store',[AdminController::class,'locationStore'])->name('master.location.store');
Route::post('master/location/update/{id}',[AdminController::class,'locationUpdate'])->name('master.location.update');
Route::delete('master/location/destroy/{id}',[AdminController::class,'locationDestroy'])->name('master.location.destroy');

Route::get('master/pincode',[AdminController::class,'pincodeIndex'])->name('master.pincode.index');
Route::post('master/pincode/store',[AdminController::class,'pincodeStore'])->name('master.pincode.store');
Route::post('master/pincode/update/{id}',[AdminController::class,'pincodeUpdate'])->name('master.pincode.update');
Route::delete('master/pincode/destroy/{id}',[AdminController::class,'pincodeDestroy'])->name('master.pincode.destroy');

Route::get('master/brand-category',[AdminController::class,'brandCategoryIndex'])->name('master.brand.category.index');
Route::post('master/brand-category/store',[AdminController::class,'brandCategoryStore'])->name('master.brand.category.store');
Route::post('master/brand-category/update/{id}',[AdminController::class,'brandCategoryUpdate'])->name('master.brand.category.update');
Route::delete('master/brand-category/destroy/{id}',[AdminController::class,'brandCategoryDestroy'])->name('master.brand.category.destroy');

Route::get('master/brand',[AdminController::class,'brandIndex'])->name('master.brand.index');
Route::post('master/brand/store',[AdminController::class,'brandStore'])->name('master.brand.store');
Route::post('master/brand/update/{id}',[AdminController::class,'brandUpdate'])->name('master.brand.update');
Route::delete('master/brand/destroy/{id}',[AdminController::class,'brandDestroy'])->name('master.brand.destroy');

Route::get('master/vehicle-type',[AdminController::class,'vehicleTypeIndex'])->name('master.vehicle.type.index');
Route::post('master/vehicle-type/store',[AdminController::class,'vehicleTypeStore'])->name('master.vehicle.type.store');
Route::post('master/vehicle-type/update/{id}',[AdminController::class,'vehicleTypeUpdate'])->name('master.vehicle.type.update');
Route::delete('master/vehicle-type/destroy/{id}',[AdminController::class,'vehicleTypeDestroy'])->name('master.vehicle.type.destroy');

Route::get('master/fuel-type',[AdminController::class,'fuelTypeIndex'])->name('master.fuel.type.index');
Route::post('master/fuel-type/store',[AdminController::class,'fuelTypeStore'])->name('master.fuel.type.store');
Route::post('master/fuel-type/update/{id}',[AdminController::class,'fuelTypeUpdate'])->name('master.fuel.type.update');
Route::delete('master/fuel-type/destroy/{id}',[AdminController::class,'fuelTypeDestroy'])->name('master.fuel.type.destroy');

Route::get('master/transmission',[AdminController::class,'transmissionIndex'])->name('master.transmission.index');
Route::post('master/transmission/store',[AdminController::class,'transmissionStore'])->name('master.transmission.store');
Route::post('master/transmission/update/{id}',[AdminController::class,'transmissionUpdate'])->name('master.transmission.update');
Route::delete('master/transmission/destroy/{id}',[AdminController::class,'transmissionDestroy'])->name('master.transmission.destroy');

Route::get('master/engine-capacity',[AdminController::class,'engineCapacityIndex'])->name('master.engine.capacity.index');
Route::post('master/engine-capacity/store',[AdminController::class,'engineCapacityStore'])->name('master.engine.capacity.store');
Route::post('master/engine-capacity/update/{id}',[AdminController::class,'engineCapacityUpdate'])->name('master.engine.capacity.update');
Route::delete('master/engine-capacity/destroy/{id}',[AdminController::class,'engineCapacityDestroy'])->name('master.engine.capacity.destroy');

Route::get('master/property-category',[AdminController::class,'propertyCategoryIndex'])->name('master.property.category.index');
Route::post('master/property-category/store',[AdminController::class,'propertyCategoryStore'])->name('master.property.category.store');
Route::post('master/property-category/update/{id}',[AdminController::class,'propertyCategoryUpdate'])->name('master.property.category.update');
Route::delete('master/property-category/destroy/{id}',[AdminController::class,'propertyCategoryDestroy'])->name('master.property.category.destroy');

Route::get('master/property-type',[AdminController::class,'propertyTypeIndex'])->name('master.property.type.index');
Route::post('master/property-type/store',[AdminController::class,'propertyTypeStore'])->name('master.property.type.store');
Route::post('master/property-type/update/{id}',[AdminController::class,'propertyTypeUpdate'])->name('master.property.type.update');
Route::delete('master/property-type/destroy/{id}',[AdminController::class,'propertyTypeDestroy'])->name('master.property.type.destroy');

Route::get('master/construction-status',[AdminController::class,'constructionStatusIndex'])->name('master.construction.status.index');
Route::post('master/construction-status/store',[AdminController::class,'constructionStatusStore'])->name('master.construction.status.store');
Route::post('master/construction-status/update/{id}',[AdminController::class,'constructionStatusUpdate'])->name('master.construction.status.update');
Route::delete('master/construction-status/destroy/{id}',[AdminController::class,'constructionStatusDestroy'])->name('master.construction.status.destroy');

Route::get('master/owner-type',[AdminController::class,'ownerTypeIndex'])->name('master.owner.type.index');
Route::post('master/owner-type/store',[AdminController::class,'ownerTypeStore'])->name('master.owner.type.store');
Route::post('master/owner-type/update/{id}',[AdminController::class,'ownerTypeUpdate'])->name('master.owner.type.update');
Route::delete('master/owner-type/destroy/{id}',[AdminController::class,'ownerTypeDestroy'])->name('master.owner.type.destroy');

Route::get('master/furnishing-status',[AdminController::class,'furnishingStatusIndex'])->name('master.furnishing.status.index');
Route::post('master/furnishing-status/store',[AdminController::class,'furnishingStatusStore'])->name('master.furnishing.status.store');
Route::post('master/furnishing-status/update/{id}',[AdminController::class,'furnishingStatusUpdate'])->name('master.furnishing.status.update');
Route::delete('master/furnishing-status/destroy/{id}',[AdminController::class,'furnishingStatusDestroy'])->name('master.furnishing.status.destroy');

Route::get('master/job-category',[AdminController::class,'jobCategoryIndex'])->name('master.job.category.index');
Route::post('master/job-category/store',[AdminController::class,'jobCategoryStore'])->name('master.job.category.store');
Route::post('master/job-category/update/{id}',[AdminController::class,'jobCategoryUpdate'])->name('master.job.category.update');
Route::delete('master/job-category/destroy/{id}',[AdminController::class,'jobCategoryDestroy'])->name('master.job.category.destroy');

Route::get('master/job-subcategory',[AdminController::class,'jobSubCategoryIndex'])->name('master.job.subcategory.index');
Route::post('master/job-subcategory/store',[AdminController::class,'jobSubCategoryStore'])->name('master.job.subcategory.store');
Route::post('master/job-subcategory/update/{id}',[AdminController::class,'jobSubCategoryUpdate'])->name('master.job.subcategory.update');
Route::delete('master/job-subcategory/destroy/{id}',[AdminController::class,'jobSubCategoryDestroy'])->name('master.job.subcategory.destroy');

Route::get('master/employment-type',[AdminController::class,'employmentTypeIndex'])->name('master.employment.type.index');
Route::post('master/employment-type/store',[AdminController::class,'employmentTypeStore'])->name('master.employment.type.store');
Route::post('master/employment-type/update/{id}',[AdminController::class,'employmentTypeUpdate'])->name('master.employment.type.update');
Route::delete('master/employment-type/destroy/{id}',[AdminController::class,'employmentTypeDestroy'])->name('master.employment.type.destroy');

Route::get('master/storage',[AdminController::class,'storageIndex'])->name('master.storage.index');
Route::post('master/storage/store',[AdminController::class,'storageStore'])->name('master.storage.store');
Route::post('master/storage/update/{id}',[AdminController::class,'storageUpdate'])->name('master.storage.update');
Route::delete('master/storage/destroy/{id}',[AdminController::class,'storageDestroy'])->name('master.storage.destroy');

Route::get('master/ram',[AdminController::class,'ramIndex'])->name('master.ram.index');
Route::post('master/ram/store',[AdminController::class,'ramStore'])->name('master.ram.store');
Route::post('master/ram/update/{id}',[AdminController::class,'ramUpdate'])->name('master.ram.update');
Route::delete('master/ram/destroy/{id}',[AdminController::class,'ramDestroy'])->name('master.ram.destroy');

Route::get('master/display-type',[AdminController::class,'displayTypeIndex'])->name('master.display.type.index');
Route::post('master/display-type/store',[AdminController::class,'displayTypeStore'])->name('master.display.type.store');
Route::post('master/display-type/update/{id}',[AdminController::class,'displayTypeUpdate'])->name('master.display.type.update');
Route::delete('master/display-type/destroy/{id}',[AdminController::class,'displayTypeDestroy'])->name('master.display.type.destroy');

Route::get('fetch-subcategory-options/{id}',[ContentController::class,'fetchSubcategoryOptions'])->name('fetch-subcategory-options');
Route::get('fetch-brand-options/{id}',[ContentController::class,'fetchBrandOptions'])->name('fetch-brand-options');

Route::get('master/operating-system',[AdminController::class,'operatingSystemIndex'])->name('master.operating.system.index');
Route::post('master/operating-system/store',[AdminController::class,'operatingSystemStore'])->name('master.operating.system.store');
Route::post('master/operating-system/update/{id}',[AdminController::class,'operatingSystemUpdate'])->name('master.operating.system.update');
Route::delete('master/operating-system/destroy/{id}',[AdminController::class,'operatingSystemDestroy'])->name('master.operating.system.destroy');

Route::get('login/forget-password',[ForgetPasswordController::class,'forgetPassword'])->name('admin.forget.password');
Route::post('login/password/reset',[ForgetPasswordController::class,'resetPassword'])->name('admin.password.reset');
Route::get('login/forget-password/verify/{token}',[ForgetPasswordController::class,'verifyToken'])->name('admin.password.verify');
Route::post('login/password/update',[ForgetPasswordController::class,'updatePassword'])->name('admin.password.update');
Route::post('admin-settings/profile/update',[AdminController::class,'updateProfileSetting'])->name('profile.settings.update');
Route::post('admin-settings/invoice-and-tax/update',[AdminController::class,'updateInvoiceSetting'])->name('invoice.settings.update');
Route::post('admin-settings/other/update',[AdminController::class,'updateOtherSetting'])->name('other.settings.update');
Route::post('admin-settings/security/update',[AdminController::class,'updateSecuritySetting'])->name('security.settings.update');
Route::post('admin-settings/security/password/update',[AdminController::class,'updatePassword'])->name('password.settings.update');
Route::get('update-popular', [AdminController::class, 'updatePopular'])->name('update.popular');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('form-features','App\Http\Controllers\FormController'); 
Route::resource('subscriptions','App\Http\Controllers\SubscriptionController');

Route::get('transactions/approved-payments', [App\Http\Controllers\SubscriptionController::class, 'approvedPayments'])->name('transactions.approved-payments');

Route::get('transactions/pending-payments', [App\Http\Controllers\SubscriptionController::class, 'pendingPayments'])->name('transactions.pending-payments');

Route::get('manage-user-subscriptions', [App\Http\Controllers\UserController::class, 'userSubscriptions'])->name('manage-user-subscriptions');

Route::get('order-details/{id}', [App\Http\Controllers\UserController::class, 'orderDetails'])->name('order-details');

Route::post('transactions/approve-payment/{id}', [App\Http\Controllers\SubscriptionController::class, 'approvepaymentStatus'])->name('transactions.approve-payment');
Route::post('transactions/reject-payment/{id}', [App\Http\Controllers\SubscriptionController::class, 'rejectpaymentStatus'])->name('transactions.reject-payment');
Route::resource('manage-ads','App\Http\Controllers\AdController'); 
Route::get('seller-ads-enquiries/{id?}',[App\Http\Controllers\AdController::class,'selleradsEnquiries'])->name('seller-ads-enquiries');

Route::get('show-enquiry/{id}',[App\Http\Controllers\AdController::class,'showEnquiry'])->name('show-enquiry');

Route::delete('delete-enquiry/{id}',[App\Http\Controllers\AdController::class,'deleteEnquiry'])->name('delete-enquiry');


Route::get('buy-now-enquiries/{id?}',[App\Http\Controllers\AdController::class,'buyNowEnquiries'])->name('buy-now-enquiries');

Route::get('show-buy-now-enquiry/{id}',[App\Http\Controllers\AdController::class,'showbuyNowEnquiry'])->name('show-buy-now-enquiry');

Route::delete('delete-by-now-enquiry/{id}',[App\Http\Controllers\AdController::class,'deletebuyNowEnquiry'])->name('delete-by-now-enquiry');

Route::delete('delete-review/{id}',[App\Http\Controllers\AdController::class,'deletereview'])->name('delete-review');

Route::get('ad-reviews',[App\Http\Controllers\AdController::class,'adreviews'])->name('ad-reviews');

Route::post('manage-ads-status-update/{id}',[App\Http\Controllers\AdController::class,'manageAdsStatusUpdate'])->name('manage-ads-status-update');
Route::get('ad-analytics',[App\Http\Controllers\AdController::class,'adAnalytics'])->name('ad-analytics');
Route::resource('wallet-online-payment-master','App\Http\Controllers\WalletOnlinePaymentController');
	Route::post('wallet-online-payment-master-store',[App\Http\Controllers\WalletOnlinePaymentController::class,'store'])->name('wallet-online-payment-master-store');
Route::resource('manage-users','App\Http\Controllers\UserController');  
Route::resource('manage-contact-us','App\Http\Controllers\ContactUsController'); 
Route::get('manage-subscribers', [App\Http\Controllers\ContactUsController::class, 'manageSubscriber'])->name('manage-subscribers');

Route::delete('delete-subscriber/{id}', [App\Http\Controllers\ContactUsController::class, 'deleteSubscriber'])->name('delete-subscriber');

// chandan
    Route::resource('pages', PagesController::class);
    Route::resource('blogs', BlogController::class);

    Route::post('Editor-Image', [PagesController::class, 'addEditorImage'])->name('pages.addEditorImage');
    Route::post('Delete-Image', [PagesController::class, 'deleteEditorImage'])->name('pages.deleteEditorImage');

    Route::resource('comments', CommentController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('enquirys', ManageEnquiryController::class);
    Route::resource('teams', TeamController::class);
    Route::resource('manage-seo', SeoController::class);
//

Auth::routes();
