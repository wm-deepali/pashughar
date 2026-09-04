<?php
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\City;
use App\Models\ConstructionStatus;
use App\Models\Country;
use App\Models\DisplayType;
use App\Models\EmploymentType;
use App\Models\EngineCapacity;
use App\Models\EnigineCapacity;
use App\Models\FuelType;
use App\Models\FurnishingStatus;
use App\Models\InvoiceSetting;
use App\Models\JobCategory;
use App\Models\JobSubCategory;
use App\Models\Location;
use App\Models\OperatingSystem;
use App\Models\OtherSetting;
use App\Models\OwnerType;
use App\Models\MobileOS;
use App\Models\Pincode;
use App\Models\PropertyCategories;
use App\Models\PropertyType;
use App\Models\RAM;
use App\Models\SecuritySetting;
use App\Models\State;
use App\Models\SubCategory;
use App\Models\Transmission;
use App\Models\VehicleType;
use App\Models\Slider;

use App\Models\Seo;


function vehicleTypeInput()
{
    $vehicles = VehicleType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Vehicle Type</label>
                <select class="form-control custom-select" name="vehicle_type" id="vehicle_type" required>
                <option value="">Select Vehicle Type</option>';
    foreach ($vehicles as $vehicle) {
        $input .= '<option value="' . $vehicle->name . '">' . $vehicle->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getEngineCapacityInput()
{
    $engineCapacities = EngineCapacity::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
            <label class="form-label">Engine Capacity</label>
            <select class="form-control custom-select" name="engine_capacity" id="engine_capacity" required>
            <option value="">Select Engine Capacity</option>';
    foreach ($engineCapacities as $capacity) {
        $input .= '<option value="' . $capacity->name . '">' . $capacity->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getcolorsInput()
{
    $colors = array('Aqua' => 'Aqua', 'Beige' => 'Beige', 'Black' => 'Black', 'Brown' => 'Brown', 'Burgundy' => 'Burgundy', 'Bronze' => 'Bronze', 'Charcoal' => 'Charcoal', 'Coffee Brown' => 'Coffee Brown', 'Coral' => 'Coral', 'Cream' => 'Cream', 'Cyan' => 'Cyan', 'Cherry Red' => 'Cherry Red', 'Dark Green' => 'Dark Green', 'Green' => 'Green', 'Grey' => 'Grey', 'Indigo' => 'Indigo', 'Lavender' => 'Lavender', 'Lemon Yellow' => 'Lemon Yellow', 'Lime Green' => 'Lime Green', 'Maroon' => 'Maroon', 'Magenta' => 'Magenta', 'Mustard' => 'Mustard', 'Navy Blue' => 'Navy Blue', 'Orange' => 'Orange', 'Olive' => 'Olive', 'Pink' => 'Pink', 'Pista Green' => 'Pista Green', 'Purple' => 'Purple', 'Red' => 'Red', 'Saffron' => 'Saffron', 'Sea Green' => 'Sea Green', 'Silver' => 'Silver', 'Sky Blue' => 'Sky Blue', 'Teal' => 'Teal', 'Violet' => 'Violet', 'White' => 'White', 'Yellow' => 'Yellow');

    $input = '<div class="col-lg-6"><div class="form-group"><label class="form-label">Color</label>
                <select class="form-control custom-select" name="color" id="color" required>
                <option value="">Select Color</option>';
    foreach ($colors as $color) {
        $input .= '<option value="' . $color . '">' . $color . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getRamInput()
{
    $rams = RAM::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group"><label class="form-label">RAM</label>
            <select class="form-control custom-select" name="ram" id="ram" required>
            <option value="">Select RAM</option>';
    foreach ($rams as $ram) {
        $input .= '<option value="' . $ram->capacity . '">' . $ram->capacity . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getConstructionStatusInput()
{
    $constructionStatus = ConstructionStatus::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
            <label class="form-label">Construction Status</label>
            <select class="form-control custom-select" name="construction_status" id="construction_status" required>
            <option value="">Select Construction Status</option>';
    foreach ($constructionStatus as $status) {
        $input .= '<option value="' . $status->name . '">' . $status->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getDisplayTypeInput()
{
    $displayTypes = DisplayType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
            <label class="form-label">Display Type</label>
            <select class="form-control custom-select" name="display_type" id="display_type" required>
            <option value="">Select Display Type</option>';
    foreach ($displayTypes as $type) {
        $input .= '<option value="' . $type->name . '">' . $type->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}



function getOperatingSystemInput()
{
    $operatingSystems = OperatingSystem::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Operating System</label>
                <select class="form-control custom-select" name="os" id="os" required><option value="">Select Operating System</option>';
    foreach ($operatingSystems as $operatingSystem) {
        $input .= '<option value="' . $operatingSystem->name . '">' . $operatingSystem->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getMobileOsInput()
{
    $operatingSystems = MobileOS::all();
    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Operating System</label>
                <select class="form-control custom-select" name="os" id="os" required><option value="">Select Operating System</option>';
    foreach ($operatingSystems as $operatingSystem) {
        $input .= '<option value="' . $operatingSystem->name . '">' . $operatingSystem->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}


function getOwnerTypeInput()
{
    $ownerTypes = OwnerType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Property Owner Type</label>
                <select class="form-control custom-select" name="owner_type" id="owner_type" required>
                <option value="">Select Owner Type</option>';

    foreach ($ownerTypes as $type) {
        $input .= '<option value="' . $type->name . '">' . $type->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getPropertyCategoriesInput()
{
    $propertyCategories = PropertyCategories::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Property Categories</label>
                <select class="form-control custom-select" name="property_category" id="property_category" required>
                <option value="">Select Category</option>';

    foreach ($propertyCategories as $category) {
        $input .= '<option value="' . $category->name . '">' . $category->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}

function getEmploymentType()
{
    $employmentTypes = EmploymentType::where('status', 'active')->get();
    return $employmentTypes;
}




function getFurnishingStatus()
{
    $furnishingStatus = FurnishingStatus::where('status', 'active')->get();
    return $furnishingStatus;
}

function getJobCategory()
{
    $jobCategories = JobCategory::where('status', 'active')->get();
    return $jobCategories;
}
function getJobSubCategories()
{
    $jobSubCategories = JobSubCategory::where('status', 'active')->get();
    return $jobSubCategories;
}

function getPropertyTypeInput()
{
    $propertyTypes = PropertyType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Property Type</label>
                <select class="form-control custom-select" name="property_type" id="property_type" required>
                <option value="">Select Property Type</option>';

    foreach ($propertyTypes as $type) {
        $input .= '<option value="' . $type->name . '">' . $type->name . '</option>';
    }
    $input .= '</select></div></div>';

    return $input;
}
function age_in_year()
{

    $input = '<div class="col-lg-2" id="yeardiv"><div class="form-group">
                <label class="form-label">Year</label>
                <input type="number" class="form-control" name="age_in_year" id="age_in_year" value="0" max="100" required>
                </div></div>
            ';

    return $input;
}
function age_approx()
{

    $input = '<div class="col-lg-2" id="approxdiv">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox"  name="age_approx" id="age_approx">
                  <label class="form-check-label" for="age_approx">
                    Approx
                  </label>
                </div></div>';

    return $input;
}
function age_in_months()
{

    $input = '<div class="col-lg-2" id="monthdiv"><div class="form-group">
                <label class="form-label">Months</label>
                <input type="number" class="form-control" name="age_in_months" id="age_in_months" value="0" max="12" required>
                </div></div>';

    return $input;
}

function minimumQuanitity()
{

    $input = '<div class="col-lg-6" id="minqty">
                <div class="form-group">
                    <label class="form-label">Minimum Order Quantity</label>
                    <input type="number" class="form-control" name="minimum_order_quanitity" id="minimum_order_quanitity" required>
                </div>
            </div>';

    return $input;
}
function quantity()
{

    $input = '<div class="col-lg-6" id="availqty">
                <div class="form-group">
                    <label class="form-label">Available Quantity</label>
                    <input type="number" class="form-control" name="available_quantity" id="available_quantity" required>
                </div>
            </div>';

    return $input;
}
function generalinfo()
{

    $input = '<div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">General Information</label>
                    <textarea class="form-control" name="general_information" id="general_information" required></textarea>
                </div>
            </div>';

    return $input;
}
function otherinfo()
{

    $input = '<div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Other Information</label>
                    <textarea class="form-control" name="other_information" id="other_information" required></textarea>
                </div>
            </div>';

    return $input;
}
function average_weight()
{

    $input = '<div class="col-lg-4" id="avgwtdiv">
                <div class="form-group">
                    <label class="form-label">Average Weight</label>
                    <input type="text" class="form-control" name="average_weight" id="average_weight" required>
                </div>
            </div>
            ';

    return $input;
}
function average_weight_in()
{

    $input = '<div class="col-lg-2" id="avgwtindiv">
                <div class="form-group">
                    <label class="form-label">Average Weight In</label>
                    <select class="form-control custom-select" name="average_weight_in" id="average_weight_in" required>
                         <option value="Kilogram">Kilogram</option>
                        <option value="Pound">Pound</option>
                        <option value="Grams">Grams</option>
                        <option value="mg">mg</option>
                        <option value="Lit">Lit</option>
                        <option value="ml">ml</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Box Pack">Box Pack</option>
                    </select>
                </div>
            </div>';

    return $input;
}

function weight()
{

    $input = '<div class="col-lg-4" id="wtdiv">
                <div class="form-group">
                    <label class="form-label">Weight</label>
                    <input type="text" class="form-control" name="weight" id="weight" required>
                </div>
            </div>
            ';

    return $input;
}
function weight_in()
{

    $input = '<div class="col-lg-2" id="wtindiv">
                <div class="form-group">
                    <label class="form-label">Weight In</label>
                    <select class="form-control custom-select" name="weight_in" id="weight_in" required>
                        <option value="Kilogram">Kilogram</option>
                        <option value="Pound">Pound</option>
                        <option value="Grams">Grams</option>
                        <option value="mg">mg</option>
                        <option value="Lit">Lit</option>
                        <option value="ml">ml</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Box Pack">Box Pack</option>
                    </select>
                </div>
            </div>';

    return $input;
}




function featcherformData()
{
    $data = array(
        'brand' => '<div class="col-lg-6" id="branddiv"><div class="form-group"><label class="form-label">Brand</label><select class="form-control" name="brand" id="brands"></select></div></div>',
        'age_in_year' => age_in_year(),
        'age_in_months' => age_in_months(),
        'age_approx' => age_approx(),
        'available_quantity' => quantity(),
        'minimum_order_quanitity' => minimumQuanitity(),
        'other_information' => otherinfo(),
        'general_information' => generalinfo(),
        'average_weight' => average_weight(),
        'average_weight_in' => average_weight_in(),
        'weight' => weight(),
        'weight_in' => weight_in(),


    );
    return $data;
}

function getCommomPageMetaTag($page)
{
    $metaTitle = 'Pashughar';
    $metaKeword = '';
    $metaDescription = '';
    $canonical = '';

    $ogTitle = '';
    $ogDescription = '';
    $ogImage = '';
    $ogUrl = '';
    $twitterCard = 'summary_large_image';

    $metaData = Seo::where('name', $page)->first();

    if (empty($metaData)) {
        $metaData = Seo::where('name', 'default')->first();
    }

    if (!empty($metaData)) {

        // Basic SEO
        if (!empty($metaData->meta_title)) {
            $metaTitle = $metaData->meta_title;
        }

        $metaKeword = $metaData->meta_keyword ?? '';
        $metaDescription = $metaData->meta_description ?? '';
        $canonical = $metaData->canonical ?? '';

        // Open Graph
        $ogTitle = !empty($metaData->og_title)
            ? $metaData->og_title
            : $metaTitle;

        $ogDescription = !empty($metaData->og_description)
            ? $metaData->og_description
            : $metaDescription;

        $ogImage = $metaData->og_image ?? '';
        $ogUrl = $metaData->og_url ?? '';

        // Twitter
        $twitterCard = !empty($metaData->twitter_card)
            ? $metaData->twitter_card
            : 'summary_large_image';
    }

    /*
    |--------------------------------------------------------------------------
    | Canonical URL
    |--------------------------------------------------------------------------
    */

    if ($canonical != '') {

        if (
            strpos($canonical, 'http://') === 0 ||
            strpos($canonical, 'https://') === 0
        ) {
            $canonicalUrl = $canonical;
        } else {
            $canonicalUrl = url('/') . '/' . ltrim($canonical, '/');
        }

    } else {
        $canonicalUrl = url()->current();
    }

    /*
    |--------------------------------------------------------------------------
    | OG URL
    |--------------------------------------------------------------------------
    */

    if ($ogUrl != '') {

        if (
            strpos($ogUrl, 'http://') === 0 ||
            strpos($ogUrl, 'https://') === 0
        ) {
            $ogUrl = $ogUrl;
        } else {
            $ogUrl = url('/') . '/' . ltrim($ogUrl, '/');
        }

    } else {
        $ogUrl = $canonicalUrl;
    }

    /*
    |--------------------------------------------------------------------------
    | OG Image URL
    |--------------------------------------------------------------------------
    */

    if ($ogImage != '') {

        if (
            strpos($ogImage, 'http://') === 0 ||
            strpos($ogImage, 'https://') === 0
        ) {
            $ogImageUrl = $ogImage;
        } else {
            $ogImageUrl = asset('storage/' . ltrim($ogImage, '/'));
        }

    } else {
        $ogImageUrl = '';
    }

    /*
    |--------------------------------------------------------------------------
    | Meta Tags
    |--------------------------------------------------------------------------
    */

    $tags = '<title>' . e($metaTitle) . '</title>
    <meta name="description" content="' . e($metaDescription) . '">
    <meta name="keywords" content="' . e($metaKeword) . '">
    <link rel="canonical" href="' . e($canonicalUrl) . '">

    <meta property="og:title" content="' . e($ogTitle) . '">
    <meta property="og:description" content="' . e($ogDescription) . '">
    <meta property="og:type" content="website">
    <meta property="og:url" content="' . e($ogUrl) . '">';

    if ($ogImageUrl != '') {
        $tags .= '
    <meta property="og:image" content="' . e($ogImageUrl) . '">';
    }

    $tags .= '
    <meta name="twitter:card" content="' . e($twitterCard) . '">
    <meta name="twitter:title" content="' . e($ogTitle) . '">
    <meta name="twitter:description" content="' . e($ogDescription) . '">';

    if ($ogImageUrl != '') {
        $tags .= '
    <meta name="twitter:image" content="' . e($ogImageUrl) . '">';
    }

    return $tags;
}

function getCommonPageHeading($page, $default = '')
{
    $metaData = Seo::where('name', $page)->first();

    if (empty($metaData)) {
        $metaData = Seo::where('name', 'default')->first();
    }

    if (!empty($metaData) && !empty($metaData->heading)) {
        return $metaData->heading;
    }

    return $default;
}

function getDetailsPageMetaTag(
    $metaTitle,
    $metaDescription,
    $metaKeword,
    $canonical,
    $ogImage = '',
    $ogTitle = '',
    $ogDescription = ''
) {
    // Canonical URL (unchanged)
    if ($canonical != '') {
        if (strpos($canonical, 'http://') === 0 || strpos($canonical, 'https://') === 0) {
            $canonicalUrl = $canonical;
        } else {
            $canonicalUrl = url('/') . '/' . ltrim($canonical, '/');
        }
    } else {
        $canonicalUrl = url()->current();
    }

    // OG Image (unchanged)
    if ($ogImage != '') {
        if (strpos($ogImage, 'http://') === 0 || strpos($ogImage, 'https://') === 0) {
            $ogImageUrl = $ogImage;
        } else {
            $ogImageUrl = asset('storage/' . ltrim($ogImage, '/'));
        }
    } else {
        $ogImageUrl = '';
    }

    // Prefer dedicated OG title/description, fallback to meta title/description
    $finalOgTitle = $ogTitle != '' ? $ogTitle : $metaTitle;
    $finalOgDescription = $ogDescription != '' ? $ogDescription : $metaDescription;

    $tags = '<title>' . e($metaTitle) . '</title>
    <meta name="description" content="' . e($metaDescription) . '">
    <meta name="keywords" content="' . e($metaKeword) . '">
    <link rel="canonical" href="' . e($canonicalUrl) . '">
    <!-- Open Graph -->
    <meta property="og:title" content="' . e($finalOgTitle) . '">
    <meta property="og:description" content="' . e($finalOgDescription) . '">
    <meta property="og:url" content="' . e($canonicalUrl) . '">
    <meta property="og:type" content="website">';

    if ($ogImageUrl != '') {
        $tags .= '
    <meta property="og:image" content="' . e($ogImageUrl) . '">';
    }

    $tags .= '
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="' . e($finalOgTitle) . '">
    <meta name="twitter:description" content="' . e($finalOgDescription) . '">';

    if ($ogImageUrl != '') {
        $tags .= '
    <meta name="twitter:image" content="' . e($ogImageUrl) . '">';
    }

    return $tags;
}

if (!function_exists('generateAdMetaDescription')) {
    function generateAdMetaDescription($ad)
    {
        $age      = trim((string) \App\Http\Controllers\FrontController::getfeature($ad->id, 'age_in_year'));
        $category = optional($ad->category)->name ?: '';
        $location = $ad->location ?? '';
        $price    = $ad->price ? '₹' . number_format($ad->price) : '';

        $subject = trim($age . ' ' . $category);

        $description = "{$subject} for sale in {$location} for {$price}. Check {$category} details, photos and specifications and send a direct buying enquiry on PashuGhar.";

        // extra spaces clean up (agar age/category/location/price khali ho to)
        $description = preg_replace('/\s+/', ' ', trim($description));

        return \Illuminate\Support\Str::limit($description, 255, '');
    }
}

if (!function_exists('generateAdMetaTitle')) {
    function generateAdMetaTitle($ad)
    {
        // NOTE: 'breed' feature key confirm kar lena featcherformData() se — 
        // agar alag naam hai (e.g. 'breed_type') to yahan update kar dena
        $breed    = trim((string) \App\Http\Controllers\FrontController::getfeature($ad->id, 'breed'));
        $category = optional($ad->category)->name ?: '';
        $city     = $ad->location ?? '';
        $price    = $ad->price ? '₹' . number_format($ad->price) : '';

        if ($breed && $category && $city && $price) {
            $title = "{$breed} {$category} for Sale in {$city} | {$price} | PashuGhar";
        } elseif ($category && $city && $price) {
            $title = "{$category} for Sale in {$city} | {$price} | PashuGhar";
        } elseif ($category && $city) {
            $title = "{$category} for Sale in {$city} | PashuGhar";
        } elseif ($category && $price) {
            $title = "{$category} for Sale | {$price} | PashuGhar";
        } else {
            $title = "{$category} for Sale in India | PashuGhar";
        }

        return \Illuminate\Support\Str::limit($title, 255, '');
    }
}


function getAdJsonLd($ad)
{
    $canonicalUrl = url()->current();

    $ogImage = '';
    if (isset($ad->adImage) && count($ad->adImage) > 0) {
        $ogImage = asset('storage/' . $ad->adImage[0]->image);
    }

    $categoryName = $ad->category->name ?? '';
    $subCategoryName = $ad->subCategory->name ?? null; // adjust relation name if different

    // --------------------------------------------------------------------
    // 1. BreadcrumbList — Home > Category > [CategoryName] > [SubCategoryName?] > Ad Title
    // --------------------------------------------------------------------
    $itemListElement = [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => url('/'),
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Category',
            'item' => route('list-all-ads'),
        ],
    ];

    $position = 3;

    if (isset($ad->category)) {
        $itemListElement[] = [
            '@type' => 'ListItem',
            'position' => $position,
            'name' => $categoryName,
            'item' => route('category-details', $ad->category->slug),
        ];
        $position++;
    }

    if (!empty($ad->subcategory_id) && isset($ad->subCategory) && !empty($ad->subCategory->slug)) {
        $itemListElement[] = [
            '@type' => 'ListItem',
            'position' => $position,
            'name' => $subCategoryName,
            'item' => route('subcategory-details', [$ad->category->slug, $ad->subCategory->slug]),
        ];
        $position++;
    }

    $itemListElement[] = [
        '@type' => 'ListItem',
        'position' => $position,
        'name' => $ad->title,
        'item' => $canonicalUrl,
    ];

    $breadcrumb = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $itemListElement,
    ];

    $schemas = [$breadcrumb];

    // --------------------------------------------------------------------
    // 2. Product + Offer (only when a real price exists) — unchanged
    // --------------------------------------------------------------------
    if (!empty($ad->price) && is_numeric($ad->price) && $ad->price > 0) {

        $availability = (isset($ad->status) && $ad->status == 'Published')
            ? 'https://schema.org/InStock'
            : 'https://schema.org/OutOfStock';

        $product = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $ad->title,
            'description' => strip_tags($ad->description ?? ''),
            'category' => $categoryName,
            'offers' => [
                '@type' => 'Offer',
                'price' => (string) $ad->price,
                'priceCurrency' => 'INR',
                'url' => $canonicalUrl,
                'availability' => $availability,
            ],
        ];

        if (!empty($ogImage)) {
            $product['image'] = $ogImage;
        }

        if (!empty($ad->condition)) {
            $conditionMap = [
                'new' => 'https://schema.org/NewCondition',
                'used' => 'https://schema.org/UsedCondition',
                'refurbished' => 'https://schema.org/RefurbishedCondition',
            ];
            $key = strtolower($ad->condition);
            if (isset($conditionMap[$key])) {
                $product['offers']['itemCondition'] = $conditionMap[$key];
            }
        }

        $schemas[] = $product;
    }

    $output = '';
    foreach ($schemas as $schema) {
        $output .= '<script type="application/ld+json">'
            . json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            . '</script>' . "\n";
    }

    return $output;
}

function gethomepageSlider()
{
    $sliders = Slider::latest()->get();

    $desktop_sliders = [];
    $mobile_sliders = [];

    foreach ($sliders as $slider) {

        // Desktop Image
        $desktop_sliders[] = [
            'id' => $slider->id,
            'title' => $slider->title ?? '',
            'image' => !empty($slider->desktop_image) 
                        ? asset('storage/'.$slider->desktop_image) 
                        : asset('front/images/pashughar-sellers.png'),
        ];

        // Mobile Image
        $mobile_sliders[] = [
            'id' => $slider->id,
            'title' => $slider->title ?? '',
            'image' => !empty($slider->mobile_image) 
                        ? asset('storage/'.$slider->mobile_image)
                        : asset('front/images/pashughar-banner1.png'),
        ];
    }

    return [
        'desktop_sliders' => $desktop_sliders,
        'mobile_sliders' => $mobile_sliders,
    ];
}