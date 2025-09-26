<?php

namespace App\Http\Controllers;

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
use App\Models\Pincode;
use App\Models\ProfileSetting;
use App\Models\PropertyCategories;
use App\Models\PropertyType;
use App\Models\RAM;
use App\Models\SecuritySetting;
use App\Models\State;
use App\Models\Storage as ModelsStorage;
use App\Models\SubCategory;
use App\Models\Transmission;
use App\Models\UserActivity;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
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

    public function adminSettings()
    {
        $data['profile_setting'] = ProfileSetting::first();
        $data['invoice_tax'] = InvoiceSetting::first();
        $data['other_setting'] = OtherSetting::first();
        $data['security_setting'] = SecuritySetting::first();
        $data['userActivities'] = UserActivity::latest()->limit(3)->get();
        return view('admin-settings.index', $data);
    }

    public function updateProfileSetting(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'nullable|string',
            'owner_name' => 'nullable|string',
            'email' => 'nullable|email',
            'mobile_number' => 'nullable|string',
            'whatsapp_number' => 'nullable|string',
            'header_logo' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048', // Example validation for image file
            'logo' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048', // Example validation for image file
        ]);

        // Handle file uploads (if files are present)
        if ($request->hasFile('header_logo')) {
            $headerLogoPath = $request->file('header_logo')->store('public/logos'); // Example storage location
            $validatedData['header_logo'] = $headerLogoPath;
        }

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('public/logos'); // Example storage location
            $validatedData['logo'] = $logoPath;
        }

        // Update or create the record
        ProfileSetting::updateOrCreate(
            ['id' => 1], // Adjust with your own logic to find or create the record
            $validatedData
        );

        // Redirect or respond with success message
        return redirect()->back()->with('success', 'Settings saved successfully!');
    }

    public function updateInvoiceSetting(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'registration_number' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:255',
            'pan_number' => 'nullable|string|max:255',
            'registered_address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:255',
            'sgst' => 'nullable|string|max:255',
            'cgst' => 'nullable|string|max:255',
            'igst' => 'nullable|string|max:255',
            'invoice_prefix' => 'nullable|string|max:255',
            'invoice_number' => 'nullable|string|max:255',
            'term_and_condition' => 'nullable|string',
        ]);

        // Find or create the InvoiceTax model instance
        $invoiceTax = InvoiceSetting::firstOrNew([]);

        // Update the model with validated data
        $invoiceTax->fill($validatedData);

        // Handle file uploads if any
        if ($request->hasFile('header_logo')) {
            $invoiceTax->header_logo = $request->file('header_logo')->store('logos', 'public');
        }
        if ($request->hasFile('logo')) {
            $invoiceTax->logo = $request->file('logo')->store('logos', 'public');
        }

        // Save the updated or new record
        $invoiceTax->save();

        // Redirect back with success message or handle response as needed
        return redirect()->back()->with('success', 'Invoice settings updated successfully!');
    }

    public function updateOtherSetting(Request $request)
    {
        $other_setting = OtherSetting::firstOrNew();

        $other_setting->tds = $request->input('tds');
        $other_setting->admin_charges = $request->input('admin_charges');
        $other_setting->other_charges = $request->input('other_charges');
        $other_setting->user_expiry = $request->input('user_expiry');
        $other_setting->welcome_bonus = $request->input('welcome_bonus');
        $other_setting->point_value = $request->input('point_value');
        $other_setting->referral_points = $request->input('referral_points');
        $other_setting->wallet_limit = $request->input('wallet_limit');
        $other_setting->is_referral_enable = $request->has('is_referral_enable') ? 1 : 0;


        $other_setting->save();

        return redirect()->back()->with('success', 'Other settings saved successfully!');
    }

    public function updateSecuritySetting(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'max_failed_login_user' => 'nullable|string',
            'max_failed_login_admin' => 'nullable|string',
            'is_change_password_required' => 'nullable',
        ]);

        try {
            // Find or create a record for security settings
            $securitySetting = SecuritySetting::firstOrNew();

            // Update the fields based on the request
            $securitySetting->max_failed_login_user = $request->input('max_failed_login_user');
            $securitySetting->max_failed_login_admin = $request->input('max_failed_login_admin');
            $securitySetting->is_change_password_required = $request->has('is_change_password_required') ? 1 : 0;

            // Save the changes
            $securitySetting->save();

            // Redirect back with success message or handle response as needed
            return redirect()->back()->with('success', 'Security settings updated successfully.');
        } catch (\Exception $e) {
            // Handle any errors that occur during the update process
            return redirect()->back()->with('error', 'Failed to update security settings. Please try again.');
        }
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    public function categoriesIndex()
    {
        $data['categories'] = Category::orderBy('created_at', 'DESC')->get();
        return view('category.index', $data);
    }

    public function subcategoriesIndex()
    {
        $data['subcategories'] = SubCategory::with('category')->orderBy('created_at', 'DESC')->get();
        return view('sub-category.index', $data);
    }

    public function categoriesAdd()
    {
        return view('category.create');
    }

    public function subcategoriesAdd()
    {
        $data['categories'] = Category::orderBy('name', 'ASC')->get();
        return view('sub-category.create', $data);
    }

    public function engineCapacityIndex()
    {
        $data['engineCapacities'] = EngineCapacity::orderBy('name', 'ASC')->get();
        return view('engine-capacity.index', $data);
    }

    public function categoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|max:255',
            'bottom_categories' => 'required'
        ]);

        // Handle the image upload
        $imagePath = null;
        $imagePaths = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category', 'public');
        }
        if ($request->hasFile('bottom_image')) {
            $imagePaths = $request->file('bottom_image')->store('category', 'public');
        }

        // Create the category
        Category::create([
            'name' => $request->input('name'),
            'slug' => $request->slug ?: \Str::slug($request->name),
            'image' => $imagePath,
            'meta_title' => $request->input('meta_title'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'canonical_url' => $request->input('canonical_url'),
            'bottom_categories' => $request->input('bottom_categories'),
            'bottom_image' => $imagePaths,
        ]);

        // Redirect with a success message
        return redirect()->route('master.category.index')->with('success', 'Category created successfully.');
    }

    public function subcategoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|max:255',
        ]);

        // Create the category
        SubCategory::create([
            'category_id' => $request->input('category_id'),
            'name' => $request->input('name'),
            'meta_title' => $request->input('meta_title'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_description' => $request->input('meta_description'),
            'canonical_url' => $request->input('canonical_url'),
        ]);

        // Redirect with a success message
        return redirect()->route('master.subcategory.index')->with('success', 'Sub Category created successfully.');
    }


    public function categoriesEdit($id)
    {
        $data['category'] = Category::findOrFail($id);
        return view('category.edit', $data);
    }

    public function subcategoriesEdit($id)
    {
        $data['subcategory'] = SubCategory::with('category')->findOrFail($id);
        $data['categories'] = Category::orderBy('name', 'ASC')->get();
        return view('sub-category.edit', $data);
    }

    public function categoriesUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'canonical_url' => 'nullable|string|max:255',
            'bottom_categories' => 'required',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update category data
        $category->name = $request->input('name');
        $category->slug = $request->slug ?: \Str::slug($request->name);
        $category->meta_title = $request->input('meta_title');
        $category->meta_keyword = $request->input('meta_keyword');
        $category->meta_description = $request->input('meta_description');
        $category->canonical_url = $request->input('canonical_url');
        $category->bottom_categories = $request->input('bottom_categories');
        $category->canonical_url = $request->input('canonical_url');



        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image) {
                Storage::delete($category->image);
            }

            // Store the new image
            $path = $request->file('image')->store('category', 'public');
            $category->image = $path;
        }

        if ($request->hasFile('bottom_image')) {
            // Delete the old image if it exists
            if ($category->bottom_image) {
                Storage::delete($category->bottom_image);
            }

            // Store the new image
            $paths = $request->file('bottom_image')->store('category', 'public');
            $category->bottom_image = $paths;
        }



        // Save the updated category
        $category->save();

        // Redirect back with a success message
        return redirect()->route('master.category.index')->with('success', 'Category updated successfully');

    }

    public function subcategoriesUpdate(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        // Find the subcategory by ID
        $subcategory = SubCategory::findOrFail($id);

        // Update the subcategory with the new data
        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'canonical_url' => $request->canonical_url,
            'meta_description' => $request->meta_description,
            // Add other fields as needed
        ]);

        return redirect()->route('master.subcategory.index')->with('success', 'SubCategory updated successfully.');
    }

    public function categoriesDestroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete the image from storage
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // Delete the category
        $category->delete();

        return redirect()->route('master.category.index')->with('success', 'Category deleted successfully.');
    }

    public function subcategoriesDestroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route('master.subcategory.index')->with('success', 'SubCategory deleted successfully.');
    }

    public function countryIndex()
    {
        $data['countries'] = Country::orderBy('name', 'ASC')->get();
        return view('country.index', $data);
    }

    public function stateIndex()
    {
        $data['states'] = State::with('country')->orderBy('name', 'ASC')->get();
        $data['countries'] = Country::orderBy('name', 'ASC')->get();
        return view('state.index', $data);
    }

    public function cityIndex()
    {
        $data['cities'] = City::with('state')->orderBy('name', 'ASC')->get();
        $data['states'] = State::orderBy('name', 'ASC')->get();
        return view('city.index', $data);
    }

    public function locationIndex()
    {
        $data['locations'] = Location::orderBy('created_at', 'DESC')->get();
        $data['cities'] = City::orderBy('name', 'ASC')->get();
        return view('location.index', $data);
    }

    public function pincodeIndex()
    {
        $data['pincodes'] = Pincode::orderBy('created_at', 'DESC')->get();
        $data['cities'] = City::orderBy('name', 'ASC')->get();
        return view('pincode.index', $data);
    }

    public function brandCategoryIndex()
    {
        $data['brandCategories'] = BrandCategory::orderBy('created_at', 'DESC')->get();
        return view('brand-category.index', $data);
    }

    public function brandIndex()
    {
        $data['brands'] = Brand::orderBy('created_at', 'DESC')->get();
        $data['brandCategories'] = BrandCategory::orderBy('created_at', 'DESC')->get();
        $data['categories'] = Category::orderBy('created_at', 'DESC')->get();

        return view('brand.index', $data);
    }

    public function vehicleTypeIndex()
    {
        $data['vehicleTypes'] = VehicleType::orderBy('created_at', 'DESC')->get();
        return view('vehicle-type.index', $data);
    }

    public function fuelTypeIndex()
    {
        $data['fuelTypes'] = FuelType::orderBy('created_at', 'DESC')->get();
        $data['vehicleTypes'] = VehicleType::orderBy('created_at', 'DESC')->get();
        return view('fuel-type.index', $data);
    }

    public function transmissionIndex()
    {
        $data['transmissions'] = Transmission::orderBy('created_at', 'DESC')->get();
        $data['vehicleTypes'] = VehicleType::orderBy('created_at', 'DESC')->get();
        return view('transmission.index', $data);
    }

    public function propertyCategoryIndex()
    {
        $data['propertyCategories'] = PropertyCategories::orderBy('created_at', 'DESC')->get();
        return view('property-category.index', $data);
    }

    public function propertyTypeIndex()
    {
        $data['propertyCategories'] = PropertyCategories::orderBy('created_at', 'DESC')->get();

        $data['propertyTypes'] = PropertyType::orderBy('created_at', 'DESC')->get();
        return view('property-type.index', $data);
    }

    public function constructionStatusIndex()
    {
        $data['constructionStatus'] = ConstructionStatus::orderBy('created_at', 'DESC')->get();
        return view('construction-status.index', $data);
    }

    public function ownerTypeIndex()
    {
        $data['ownerTypes'] = OwnerType::orderBy('created_at', 'DESC')->get();
        return view('owner-type.index', $data);
    }

    public function furnishingStatusIndex()
    {
        $data['furnishingStatuses'] = FurnishingStatus::orderBy('created_at', 'DESC')->get();
        return view('furnishing-status.index', $data);
    }

    public function jobCategoryIndex()
    {
        $data['jobCategories'] = JobCategory::orderBy('created_at', 'DESC')->get();
        return view('job-category.index', $data);
    }

    public function jobSubCategoryIndex()
    {
        $data['jobSubCategories'] = JobSubCategory::orderBy('created_at', 'DESC')->get();
        $data['jobCategories'] = JobCategory::orderBy('created_at', 'DESC')->get();
        return view('job-sub-category.index', $data);
    }

    public function employmentTypeIndex()
    {
        $data['employmentTypes'] = EmploymentType::orderBy('created_at', 'DESC')->get();
        return view('employment-type.index', $data);
    }

    public function storageIndex()
    {
        $data['storages'] = ModelsStorage::orderBy('created_at', 'DESC')->get();
        return view('storage.index', $data);
    }

    public function ramIndex()
    {
        $data['rams'] = RAM::orderBy('created_at', 'DESC')->get();
        return view('ram.index', $data);
    }

    public function displayTypeIndex()
    {
        $data['display_types'] = DisplayType::orderBy('created_at', 'DESC')->get();
        return view('display-type.index', $data);
    }

    public function operatingSystemIndex()
    {
        $data['operating_systems'] = OperatingSystem::orderBy('created_at', 'DESC')->get();
        return view('operating-system.index', $data);
    }

    public function countryStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $country = new Country();
        $country->name = $request->name;
        $country->status = $request->status ?? 0;

        $country->save();

        // Redirect back with success message
        return redirect()->route('master.country.index')->with('success', 'Country added successfully!');
    }

    public function vehicleTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $vehicle = new VehicleType();
        $vehicle->name = $request->name;
        $vehicle->status = $request->status ?? 0;

        $vehicle->save();

        // Redirect back with success message
        return redirect()->route('master.vehicle.type.index')->with('success', 'Vehicle Type added successfully!');
    }

    public function stateStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $state = new State();
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->status = $request->status ?? 0;

        $state->save();

        // Redirect back with success message
        return redirect()->route('master.state.index')->with('success', 'State added successfully!');
    }

    public function cityStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $city = new City();
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->status = $request->status ?? 0;

        $city->save();

        // Redirect back with success message
        return redirect()->route('master.city.index')->with('success', 'City added successfully!');
    }

    public function brandStore(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'brand_category_id' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048', // Validate the image
                'status' => 'nullable', // Assuming 'status' is a boolean field
            ]);

            // Create a new brand instance
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->brand_category_id = $request->brand_category_id;
            $brand->status = $request->status ?? 0;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/brands', $imageName); // Save the image in the 'public/brands' directory
                $brand->image = 'brands/' . $imageName; // Save the image path to the database
            }

            $brand->save();

            // Redirect back with success message
            return redirect()->route('master.brand.index')->with('success', 'Brand added successfully!');
        } catch (\Throwable $th) {

            // Redirect back with error message
            return redirect()->route('master.brand.index')->with('error', $th->getMessage());
        }
    }



    public function locationStore(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'city_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $location = new Location();
        $location->location = $request->location;
        $location->city_id = $request->city_id;
        $location->status = $request->status ?? 0;

        $location->save();

        // Redirect back with success message
        return redirect()->route('master.location.index')->with('success', 'Location added successfully!');
    }

    public function fuelTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $fuelType = new FuelType();
        $fuelType->name = $request->name;
        $fuelType->vehicle_type_id = $request->vehicle_type_id;
        $fuelType->status = $request->status ?? 0;

        $fuelType->save();

        // Redirect back with success message
        return redirect()->route('master.fuel.type.index')->with('success', 'FuelType added successfully!');
    }

    public function transmissionStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $transmission = new Transmission();
        $transmission->name = $request->name;
        $transmission->vehicle_type_id = $request->vehicle_type_id;
        $transmission->status = $request->status ?? 0;

        $transmission->save();

        // Redirect back with success message
        return redirect()->route('master.transmission.index')->with('success', 'Transmission added successfully!');
    }

    public function engineCapacityStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $capacity = new EngineCapacity();
        $capacity->name = $request->name;
        $capacity->status = $request->status ?? 0;

        $capacity->save();

        // Redirect back with success message
        return redirect()->route('master.engine.capacity.index')->with('success', 'Engine Capacity added successfully!');
    }

    public function constructionStatusStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $construction = new ConstructionStatus();
        $construction->name = $request->name;
        $construction->status = $request->status ?? 0;

        $construction->save();

        // Redirect back with success message
        return redirect()->route('master.construction.status.index')->with('success', 'Construction Status added successfully!');
    }

    public function propertyCategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $category = new PropertyCategories();
        $category->name = $request->name;
        $category->status = $request->status ?? 0;

        $category->save();

        // Redirect back with success message
        return redirect()->route('master.property.category.index')->with('success', 'Property Category added successfully!');
    }

    public function pincodeStore(Request $request)
    {
        $request->validate([
            'pincode' => 'required|max:6',
            'city_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $pincode = new Pincode();
        $pincode->pincode = $request->pincode;
        $pincode->city_id = $request->city_id;
        $pincode->status = $request->status ?? 0;

        $pincode->save();

        // Redirect back with success message
        return redirect()->route('master.pincode.index')->with('success', 'Pincode added successfully!');
    }

    public function brandCategoryStore(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $brandCategory = new BrandCategory();
        $brandCategory->name = $request->name;
        $brandCategory->status = $request->status ?? 0;

        $brandCategory->save();

        // Redirect back with success message
        return redirect()->route('master.brand.category.index')->with('success', 'Brand Category added successfully!');
    }

    public function propertyTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $property = new PropertyType();
        $property->name = $request->name;
        $property->property_categories = $request->property_categories;

        $property->status = $request->status ?? 0;

        $property->save();

        // Redirect back with success message
        return redirect()->route('master.property.type.index')->with('success', 'Property Type added successfully!');
    }

    public function ownerTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $owner = new OwnerType();
        $owner->name = $request->name;
        $owner->status = $request->status ?? 0;

        $owner->save();

        // Redirect back with success message
        return redirect()->route('master.owner.type.index')->with('success', 'Owner Type added successfully!');
    }

    public function furnishingStatusStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $furnished = new FurnishingStatus();
        $furnished->name = $request->name;
        $furnished->status = $request->status ?? 0;

        $furnished->save();

        // Redirect back with success message
        return redirect()->route('master.furnishing.status.index')->with('success', 'Furnishing Status added successfully!');
    }

    public function jobCategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $jobCategory = new JobCategory();
        $jobCategory->name = $request->name;
        $jobCategory->status = $request->status ?? 0;

        $jobCategory->save();

        // Redirect back with success message
        return redirect()->route('master.job.category.index')->with('success', 'Job Category added successfully!');
    }

    public function jobSubCategoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_category_id' => 'required',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $jobSubCategory = new JobSubCategory();
        $jobSubCategory->name = $request->name;
        $jobSubCategory->job_category_id = $request->job_category_id;
        $jobSubCategory->status = $request->status ?? 0;

        $jobSubCategory->save();

        // Redirect back with success message
        return redirect()->route('master.job.subcategory.index')->with('success', 'Job SubCategory added successfully!');
    }

    public function employmentTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $type = new EmploymentType();
        $type->name = $request->name;
        $type->status = $request->status ?? 0;

        $type->save();

        // Redirect back with success message
        return redirect()->route('master.employment.type.index')->with('success', 'Employment Type added successfully!');
    }

    public function storageStore(Request $request)
    {
        $request->validate([
            'value' => 'required|max:255',
            'size' => 'required',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $type = new ModelsStorage();
        $type->data = $request->value;
        $type->size = $request->size;
        $type->status = $request->status ?? 0;

        $type->save();

        // Redirect back with success message
        return redirect()->route('master.storage.index')->with('success', 'Storage added successfully!');
    }

    public function ramStore(Request $request)
    {
        $request->validate([
            'capacity' => 'required',
            'type' => 'required',
            'speed' => 'required',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $type = new RAM();
        $type->capacity = $request->capacity;
        $type->type = $request->type;
        $type->speed = $request->speed;
        $type->status = $request->status ?? 0;

        $type->save();

        // Redirect back with success message
        return redirect()->route('master.ram.index')->with('success', 'Storage added successfully!');
    }

    public function displayTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $type = new DisplayType();
        $type->name = $request->name;
        $type->status = $request->status ?? 0;

        $type->save();

        // Redirect back with success message
        return redirect()->route('master.display.type.index')->with('success', 'Display Type added successfully!');
    }

    public function operatingSystemStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $type = new OperatingSystem();
        $type->name = $request->name;
        $type->company_name = $request->company_name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/os_images'), $imageName);
            $type->image = 'uploads/os_images/' . $imageName;
        }

        $type->status = $request->status ?? 0;
        $type->save();

        // Redirect back with success message
        return redirect()->route('master.operating.system.index')->with('success', 'Operating System added successfully!');
    }

    public function countryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Find the country by ID
        $country = Country::findOrFail($id);

        // Update the country's name and status
        $country->name = $request->input('name');
        $country->status = $request->status == 'on' ? 1 : 0; // Default to 0 if status is not provided

        // Save the updated country
        $country->save();

        // Redirect back with a success message
        return redirect()->route('master.country.index')->with('success', 'Country updated successfully!');
    }

    public function engineCapacityUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Find the country by ID
        $capacity = EngineCapacity::findOrFail($id);

        // Update the country's name and status
        $capacity->name = $request->input('name');
        $capacity->status = $request->status == 'on' ? 1 : 0; // Default to 0 if status is not provided

        // Save the updated country
        $capacity->save();

        // Redirect back with a success message
        return redirect()->route('master.engine.capacity.index')->with('success', 'Engine Capacity updated successfully!');
    }

    public function vehicleTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Find the country by ID
        $vehicle = VehicleType::findOrFail($id);

        // Update the country's name and status
        $vehicle->name = $request->input('name');
        $vehicle->status = $request->status == 'on' ? 1 : 0; // Default to 0 if status is not provided

        // Save the updated country
        $vehicle->save();

        // Redirect back with a success message
        return redirect()->route('master.vehicle.type.index')->with('success', 'Vehicle Type updated successfully!');
    }

    public function stateUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_id' => 'required',
            'status' => 'nullable',
        ]);

        $state = State::findOrFail($id);
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->status = $request->status == 'on' ? 1 : 0;

        $state->save();

        return redirect()->route('master.state.index')->with('success', 'State updated successfully!');
    }

    public function brandUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->brand_category_id = $request->brand_category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/brands', $imageName); // Save the image in the 'public/brands' directory
            $brand->image = 'brands/' . $imageName; // Save the image path to the database
        }
        $brand->status = $request->status == 'on' ? 1 : 0;
        $brand->save();

        return redirect()->route('master.brand.index')->with('success', 'Brand updated successfully!');
    }

    public function cityUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required',
            'status' => 'nullable',
        ]);

        $city = City::findOrFail($id);
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->status = $request->status == 'on' ? 1 : 0;

        $city->save();

        return redirect()->route('master.city.index')->with('success', 'City updated successfully!');
    }

    public function locationUpdate(Request $request, $id)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'city_id' => 'required',
            'status' => 'nullable',
        ]);

        $location = Location::findOrFail($id);
        $location->location = $request->location;
        $location->city_id = $request->city_id;
        $location->status = $request->status == 'on' ? 1 : 0;

        $location->save();

        return redirect()->route('master.location.index')->with('success', 'Location updated successfully!');
    }

    public function pincodeUpdate(Request $request, $id)
    {
        $request->validate([
            'pincode' => 'required|max:6',
            'city_id' => 'required',
            'status' => 'nullable',
        ]);

        $pincode = Pincode::findOrFail($id);
        $pincode->pincode = $request->pincode;
        $pincode->city_id = $request->city_id;
        $pincode->status = $request->status == 'on' ? 1 : 0;

        $pincode->save();

        return redirect()->route('master.pincode.index')->with('success', 'Pincode updated successfully!');
    }

    public function brandCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable',
        ]);

        // Find the country by ID
        $brandCategory = BrandCategory::findOrFail($id);

        // Update the country's name and status
        $brandCategory->name = $request->input('name');
        $brandCategory->status = $request->status == 'on' ? 1 : 0; // Default to 0 if status is not provided

        // Save the updated country
        $brandCategory->save();

        // Redirect back with a success message
        return redirect()->route('master.brand.category.index')->with('success', 'Brand Category updated successfully!');
    }

    public function fuelTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $fuelType = FuelType::findOrFail($id);
        $fuelType->name = $request->name;
        $fuelType->vehicle_type_id = $request->vehicle_type_id;
        $fuelType->status = $request->status == 'on' ? 1 : 0;

        $fuelType->save();

        // Redirect back with success message
        return redirect()->route('master.fuel.type.index')->with('success', 'FuelType updated successfully!');
    }

    public function transmissionUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vehicle_type_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $transmission = Transmission::findOrFail($id);
        $transmission->name = $request->name;
        $transmission->vehicle_type_id = $request->vehicle_type_id;
        $transmission->status = $request->status == 'on' ? 1 : 0;

        $transmission->save();

        // Redirect back with success message
        return redirect()->route('master.transmission.index')->with('success', 'Transmission updated successfully!');
    }

    public function propertyCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $category = PropertyCategories::findOrFail($id);
        $category->name = $request->name;
        $category->status = $request->status == 'on' ? 1 : 0;

        $category->save();

        // Redirect back with success message
        return redirect()->route('master.property.category.index')->with('success', 'Property Category updated successfully!');
    }

    public function constructionStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $construction = ConstructionStatus::findOrFail($id);
        $construction->name = $request->name;
        $construction->status = $request->status == 'on' ? 1 : 0;

        $construction->save();

        // Redirect back with success message
        return redirect()->route('master.construction.status.index')->with('success', 'Construction Status updated successfully!');
    }

    public function propertyTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $type = PropertyType::findOrFail($id);
        $type->name = $request->name;
        $type->property_categories = $request->property_categories;

        $type->status = $request->status == 'on' ? 1 : 0;
        $type->save();

        // Redirect back with success message
        return redirect()->route('master.property.type.index')->with('success', 'Property Type updated successfully!');
    }

    public function ownerTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $owner = OwnerType::findOrFail($id);
        $owner->name = $request->name;
        $owner->status = $request->status == 'on' ? 1 : 0;
        $owner->save();

        // Redirect back with success message
        return redirect()->route('master.owner.type.index')->with('success', 'Owner Type updated successfully!');
    }

    public function furnishingStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $furnishing = FurnishingStatus::findOrFail($id);
        $furnishing->name = $request->name;
        $furnishing->status = $request->status == 'on' ? 1 : 0;
        $furnishing->save();

        // Redirect back with success message
        return redirect()->route('master.furnishing.status.index')->with('success', 'Furnishing Status updated successfully!');
    }

    public function jobCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $category = JobCategory::findOrFail($id);
        $category->name = $request->name;
        $category->status = $request->status == 'on' ? 1 : 0;
        $category->save();

        // Redirect back with success message
        return redirect()->route('master.job.category.index')->with('success', 'Job Category updated successfully!');
    }

    public function jobSubCategoryUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_category_id' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $subcategory = JobSubCategory::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->job_category_id = $request->job_category_id;
        $subcategory->status = $request->status == 'on' ? 1 : 0;
        $subcategory->save();

        // Redirect back with success message
        return redirect()->route('master.job.subcategory.index')->with('success', 'Job SubCategory updated successfully!');
    }

    public function employmentTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $type = EmploymentType::findOrFail($id);
        $type->name = $request->name;
        $type->status = $request->status == 'on' ? 1 : 0;
        $type->save();

        // Redirect back with success message
        return redirect()->route('master.employment.type.index')->with('success', 'Employment Type updated successfully!');
    }

    public function storageUpdate(Request $request, $id)
    {
        $request->validate([
            'value' => 'required|max:255',
            'size' => 'required',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $type = ModelsStorage::findOrFail($id);
        $type->data = $request->value;
        $type->size = $request->size;
        $type->status = $request->status == 'on' ? 1 : 0;
        $type->save();

        // Redirect back with success message
        return redirect()->route('master.storage.index')->with('success', 'Storage updated successfully!');
    }

    public function ramUpdate(Request $request, $id)
    {
        $request->validate([
            'capacity' => 'required',
            'type' => 'required',
            'speed' => 'required',
            'status' => 'nullable',
        ]);

        // Find the existing RAM instance
        $ram = RAM::findOrFail($id);
        $ram->capacity = $request->capacity;
        $ram->type = $request->type;
        $ram->speed = $request->speed;
        $ram->status = $request->has('status') ? 1 : 0; // Convert status to 1 or 0
        $ram->save();

        // Redirect back with success message
        return redirect()->route('master.ram.index')->with('success', 'RAM updated successfully!');
    }

    public function displayTypeUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable', // Assuming 'status' is a boolean field
        ]);

        // Create a new country instance
        $type = DisplayType::findOrFail($id);
        $type->name = $request->name;
        $type->status = $request->status == 'on' ? 1 : 0;
        $type->save();

        // Redirect back with success message
        return redirect()->route('master.display.type.index')->with('success', 'Display Type updated successfully!');
    }

    public function operatingSystemUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'company_name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'nullable',
        ]);

        // Create a new country instance
        $type = OperatingSystem::findOrFail($id);
        $type->name = $request->name;
        $type->company_name = $request->company_name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/os_images'), $imageName);
            $type->image = 'uploads/os_images/' . $imageName;
        }

        $type->status = $request->status == 'on' ? 1 : 0;
        $type->save();

        // Redirect back with success message
        return redirect()->route('master.operating.system.index')->with('success', 'Operating System updated successfully!');
    }


    public function countryDestroy($id)
    {
        $country = Country::findOrFail($id);
        if ($country) {
            $country->delete();
            return redirect()->route('master.country.index')->with('success', 'Country deleted successfully!');
        }
        return redirect()->route('master.country.index')->with('error', 'Country not found!');
    }

    public function vehicleTypeDestroy($id)
    {
        $vehicle = VehicleType::findOrFail($id);
        if ($vehicle) {
            $vehicle->delete();
            return redirect()->route('master.vehicle.type.index')->with('success', 'Vehicle Type deleted successfully!');
        }
        return redirect()->route('master.vehicle.type.index')->with('error', 'Vehicle Type not found!');
    }
    public function stateDestroy($id)
    {
        $state = State::findOrFail($id);
        if ($state) {
            $state->delete();
            return redirect()->route('master.state.index')->with('success', 'State deleted successfully!');
        }
        return redirect()->route('master.state.index')->with('error', 'State not found!');
    }

    public function cityDestroy($id)
    {
        $city = City::findOrFail($id);
        if ($city) {
            $city->delete();
            return redirect()->route('master.city.index')->with('success', 'City deleted successfully!');
        }
        return redirect()->route('master.city.index')->with('error', 'City not found!');
    }

    public function locationDestroy($id)
    {
        $location = Location::findOrFail($id);
        if ($location) {
            $location->delete();
            return redirect()->route('master.location.index')->with('success', 'Location deleted successfully!');
        }
        return redirect()->route('master.city.index')->with('error', 'Location not found!');
    }

    public function pincodeDestroy($id)
    {
        $pincode = Pincode::findOrFail($id);
        if ($pincode) {
            $pincode->delete();
            return redirect()->route('master.pincode.index')->with('success', 'Pincode deleted successfully!');
        }
        return redirect()->route('master.city.index')->with('error', 'Location not found!');
    }

    public function brandCategoryDestroy($id)
    {
        $brandCategory = BrandCategory::findOrFail($id);
        if ($brandCategory) {
            $brandCategory->delete();
            return redirect()->route('master.brand.category.index')->with('success', 'Brand Category deleted successfully!');
        }
        return redirect()->route('master.brand.category.index')->with('error', 'Brand Category not found!');
    }

    public function brandDestroy($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand) {
            $brand->delete();
            return redirect()->route('master.brand.index')->with('success', 'Brand deleted successfully!');
        }
        return redirect()->route('master.brand.index')->with('error', 'Brand not found!');
    }

    public function fuelTypeDestroy($id)
    {
        $fuelType = FuelType::findOrFail($id);
        if ($fuelType) {
            $fuelType->delete();
            return redirect()->route('master.fuel.type.index')->with('success', 'FuelType deleted successfully!');
        }
        return redirect()->route('master.fuel.type.index')->with('error', 'FuelType not found!');
    }

    public function transmissionDestroy($id)
    {
        $transmission = Transmission::findOrFail($id);
        if ($transmission) {
            $transmission->delete();
            return redirect()->route('master.transmission.index')->with('success', 'Transmission deleted successfully!');
        }
        return redirect()->route('master.transmission.index')->with('error', 'Transmission not found!');
    }

    public function engineCapacityDestroy($id)
    {
        $capacity = EngineCapacity::findOrFail($id);
        if ($capacity) {
            $capacity->delete();
            return redirect()->route('master.engine.capacity.index')->with('success', 'Engine Capacity deleted successfully!');
        }
        return redirect()->route('master.engine.capacity.index')->with('error', 'Engine capacity not found!');
    }

    public function propertyCategoryDestroy($id)
    {
        $category = PropertyCategories::findOrFail($id);
        if ($category) {
            $category->delete();
            return redirect()->route('master.property.category.index')->with('success', 'Property Category deleted successfully!');
        }
        return redirect()->route('master.property.category.index')->with('error', 'Property Category not found!');
    }

    public function propertyTypeDestroy($id)
    {
        $type = PropertyType::findOrFail($id);
        if ($type) {
            $type->delete();
            return redirect()->route('master.property.type.index')->with('success', 'Property Type deleted successfully!');
        }
        return redirect()->route('master.property.type.index')->with('error', 'Property Type not found!');
    }

    public function constructionStatusDestroy($id)
    {
        $construction = ConstructionStatus::findOrFail($id);
        if ($construction) {
            $construction->delete();
            return redirect()->route('master.construction.status.index')->with('success', 'Construction Status deleted successfully!');
        }
        return redirect()->route('master.construction.status.index')->with('error', 'Construction Status not found!');
    }

    public function ownerTypeDestroy($id)
    {
        $owner = OwnerType::findOrFail($id);
        if ($owner) {
            $owner->delete();
            return redirect()->route('master.owner.type.index')->with('success', 'Owner Type deleted successfully!');
        }
        return redirect()->route('master.owner.type.index')->with('error', 'Owner Type not found!');
    }

    public function furnishingStatusDestroy($id)
    {
        $furnishing = FurnishingStatus::findOrFail($id);
        if ($furnishing) {
            $furnishing->delete();
            return redirect()->route('master.furnishing.status.index')->with('success', 'Furnishing Status deleted successfully!');
        }
        return redirect()->route('master.furnishing.status.index')->with('error', 'Furnishing Status not found!');
    }

    public function jobCategoryDestroy($id)
    {
        $category = JobCategory::findOrFail($id);
        if ($category) {
            $category->delete();
            return redirect()->route('master.job.category.index')->with('success', 'Job Category deleted successfully!');
        }
        return redirect()->route('master.job.category.index')->with('error', 'Job Category not found!');
    }

    public function jobSubCategoryDestroy($id)
    {
        $subcategory = JobSubCategory::findOrFail($id);
        if ($subcategory) {
            $subcategory->delete();
            return redirect()->route('master.job.subcategory.index')->with('success', 'Job SubCategory deleted successfully!');
        }
        return redirect()->route('master.job.subcategory.index')->with('error', 'Job SubCategory not found!');
    }

    public function employmentTypeDestroy($id)
    {
        $type = EmploymentType::findOrFail($id);
        if ($type) {
            $type->delete();
            return redirect()->route('master.employment.type.index')->with('success', 'Employment Type deleted successfully!');
        }
        return redirect()->route('master.employment.type.index')->with('error', 'Employment Type not found!');
    }

    public function storageDestroy($id)
    {
        $type = ModelsStorage::findOrFail($id);
        if ($type) {
            $type->delete();
            return redirect()->route('master.storage.index')->with('success', 'Storage deleted successfully!');
        }
        return redirect()->route('master.storage.index')->with('error', 'Storage not found!');
    }

    public function ramDestroy($id)
    {
        $type = RAM::findOrFail($id);
        if ($type) {
            $type->delete();
            return redirect()->route('master.ram.index')->with('success', 'Ram deleted successfully!');
        }
        return redirect()->route('master.ram.index')->with('error', 'Ram not found!');
    }

    public function displayTypeDestroy($id)
    {
        $type = DisplayType::findOrFail($id);
        if ($type) {
            $type->delete();
            return redirect()->route('master.display.type.index')->with('success', 'Display Type deleted successfully!');
        }
        return redirect()->route('master.display.type.index')->with('error', 'Display Type not found!');
    }

    public function operatingSystemDestroy($id)
    {
        $type = OperatingSystem::findOrFail($id);
        if ($type) {
            $type->delete();
            return redirect()->route('master.operating.system.index')->with('success', 'Operating System deleted successfully!');
        }
        return redirect()->route('master.operating.system.index')->with('error', 'Operating System not found!');
    }


    public function updatePopular(Request $request)
    {
        $city = City::find($request->event);
        if ($city) {
            $city->is_popular = !$city->is_popular;
            $city->save();
        }

        return redirect()->back()->with('success', 'City popularity status updated successfully!');
    }

}
