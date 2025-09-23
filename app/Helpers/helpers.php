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

use App\Models\Seo;


function vehicleTypeInput()
{
    $vehicles = VehicleType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Vehicle Type</label>
                <select class="form-control custom-select" name="vehicle_type" id="vehicle_type" required>
                <option value="">Select Vehicle Type</option>';
        foreach($vehicles as $vehicle)
        {
            $input.= '<option value="'.$vehicle->name.'">'.$vehicle->name.'</option>';
        }
        $input.= '</select></div></div>';

    return $input;
}

function getEngineCapacityInput ()
{
    $engineCapacities= EngineCapacity::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
            <label class="form-label">Engine Capacity</label>
            <select class="form-control custom-select" name="engine_capacity" id="engine_capacity" required>
            <option value="">Select Engine Capacity</option>';
        foreach($engineCapacities as $capacity)
        {
            $input.= '<option value="'.$capacity->name.'">'.$capacity->name.'</option>';
        }
        $input.= '</select></div></div>';

    return $input;
}

function getcolorsInput()
{
    $colors = array('Aqua' => 'Aqua','Beige' => 'Beige','Black' => 'Black','Brown' => 'Brown','Burgundy' => 'Burgundy','Bronze' => 'Bronze','Charcoal' => 'Charcoal','Coffee Brown' => 'Coffee Brown','Coral' => 'Coral','Cream' => 'Cream','Cyan' => 'Cyan','Cherry Red' => 'Cherry Red','Dark Green' => 'Dark Green','Green' => 'Green','Grey' => 'Grey','Indigo' => 'Indigo','Lavender' => 'Lavender','Lemon Yellow' => 'Lemon Yellow','Lime Green' => 'Lime Green','Maroon' => 'Maroon','Magenta' => 'Magenta','Mustard' => 'Mustard','Navy Blue' => 'Navy Blue','Orange' => 'Orange','Olive' => 'Olive','Pink' => 'Pink','Pista Green' => 'Pista Green','Purple' => 'Purple','Red' => 'Red','Saffron' => 'Saffron','Sea Green' => 'Sea Green','Silver' => 'Silver','Sky Blue' => 'Sky Blue','Teal' => 'Teal','Violet' => 'Violet','White' => 'White','Yellow' => 'Yellow');
    
    $input = '<div class="col-lg-6"><div class="form-group"><label class="form-label">Color</label>
                <select class="form-control custom-select" name="color" id="color" required>
                <option value="">Select Color</option>';
            foreach($colors as $color)
            {
                $input.= '<option value="'.$color.'">'.$color.'</option>';
            }
            $input.= '</select></div></div>';

    return $input;
}

function getRamInput()
{
    $rams = RAM::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group"><label class="form-label">RAM</label>
            <select class="form-control custom-select" name="ram" id="ram" required>
            <option value="">Select RAM</option>';
            foreach($rams as $ram)
            {
                $input.= '<option value="'.$ram->capacity.'">'.$ram->capacity.'</option>';
            }
            $input.= '</select></div></div>';

    return $input;
}

function getConstructionStatusInput()
{
    $constructionStatus= ConstructionStatus::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
            <label class="form-label">Construction Status</label>
            <select class="form-control custom-select" name="construction_status" id="construction_status" required>
            <option value="">Select Construction Status</option>';
        foreach($constructionStatus as $status)
        {
            $input.= '<option value="'.$status->name.'">'.$status->name.'</option>';
        }
        $input.= '</select></div></div>';

    return $input;
}

function getDisplayTypeInput ()
{
    $displayTypes= DisplayType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
            <label class="form-label">Display Type</label>
            <select class="form-control custom-select" name="display_type" id="display_type" required>
            <option value="">Select Display Type</option>';
        foreach($displayTypes as $type)
        {
            $input.= '<option value="'.$type->name.'">'.$type->name.'</option>';
        }
        $input.= '</select></div></div>';

    return $input;
}



function getOperatingSystemInput ()
{
    $operatingSystems= OperatingSystem::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Operating System</label>
                <select class="form-control custom-select" name="os" id="os" required><option value="">Select Operating System</option>';
            foreach($operatingSystems as $operatingSystem)
            {
                $input.= '<option value="'.$operatingSystem->name.'">'.$operatingSystem->name.'</option>';
            }
            $input.= '</select></div></div>';
            
    return $input;
}
function getMobileOsInput ()
{
    $operatingSystems= MobileOS::all();
    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Operating System</label>
                <select class="form-control custom-select" name="os" id="os" required><option value="">Select Operating System</option>';
            foreach($operatingSystems as $operatingSystem)
            {
                $input.= '<option value="'.$operatingSystem->name.'">'.$operatingSystem->name.'</option>';
            }
            $input.= '</select></div></div>';
            
    return $input;
}
function getOwnerTypeInput ()
{
    $ownerTypes= OwnerType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Property Owner Type</label>
                <select class="form-control custom-select" name="owner_type" id="owner_type" required>
                <option value="">Select Owner Type</option>';

            foreach($ownerTypes as $type)
            {
                $input.= '<option value="'.$type->name.'">'.$type->name.'</option>';
            }
            $input.= '</select></div></div>';

    return $input;
}

function getPropertyCategoriesInput ()
{
    $propertyCategories= PropertyCategories::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Property Categories</label>
                <select class="form-control custom-select" name="property_category" id="property_category" required>
                <option value="">Select Category</option>';

            foreach($propertyCategories as $category)
            {
                $input.= '<option value="'.$category->name.'">'.$category->name.'</option>';
            }
            $input.= '</select></div></div>';

    return $input;
}

function getEmploymentType ()
{
    $employmentTypes= EmploymentType::where('status', 'active')->get();
    return $employmentTypes;
}




function getFurnishingStatus ()
{
    $furnishingStatus= FurnishingStatus::where('status', 'active')->get();
    return $furnishingStatus;
}

function getJobCategory ()
{
    $jobCategories= JobCategory::where('status', 'active')->get();
    return $jobCategories;
}
function getJobSubCategories ()
{
    $jobSubCategories= JobSubCategory::where('status', 'active')->get();
    return $jobSubCategories;
}

function getPropertyTypeInput ()
{
    $propertyTypes= PropertyType::where('status', 1)->get();

    $input = '<div class="col-lg-6"><div class="form-group">
                <label class="form-label">Property Type</label>
                <select class="form-control custom-select" name="property_type" id="property_type" required>
                <option value="">Select Property Type</option>';

            foreach($propertyTypes as $type)
            {
                $input.= '<option value="'.$type->name.'">'.$type->name.'</option>';
            }
            $input.= '</select></div></div>';

    return $input;
}
function age_in_year ()
{
    
    $input = '<div class="col-lg-2" id="yeardiv"><div class="form-group">
                <label class="form-label">Year</label>
                <input type="number" class="form-control" name="age_in_year" id="age_in_year" value="0" max="100" required>
                </div></div>
            ';

    return $input;
}
function age_approx ()
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
function age_in_months ()
{
    
    $input = '<div class="col-lg-2" id="monthdiv"><div class="form-group">
                <label class="form-label">Months</label>
                <input type="number" class="form-control" name="age_in_months" id="age_in_months" value="0" max="12" required>
                </div></div>';

    return $input;
}

function minimumQuanitity ()
{
    
    $input = '<div class="col-lg-6" id="minqty">
                <div class="form-group">
                    <label class="form-label">Minimum Order Quantity</label>
                    <input type="number" class="form-control" name="minimum_order_quanitity" id="minimum_order_quanitity" required>
                </div>
            </div>';

    return $input;
}
function quantity ()
{
    
    $input = '<div class="col-lg-6" id="availqty">
                <div class="form-group">
                    <label class="form-label">Available Quantity</label>
                    <input type="number" class="form-control" name="available_quantity" id="available_quantity" required>
                </div>
            </div>';

    return $input;
}
function generalinfo ()
{
    
    $input = '<div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">General Information</label>
                    <textarea class="form-control" name="general_information" id="general_information" required></textarea>
                </div>
            </div>';

    return $input;
}
function otherinfo ()
{
    
    $input = '<div class="col-lg-12">
                <div class="form-group">
                    <label class="form-label">Other Information</label>
                    <textarea class="form-control" name="other_information" id="other_information" required></textarea>
                </div>
            </div>';

    return $input;
}
function average_weight ()
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
function average_weight_in ()
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

function weight ()
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
function weight_in ()
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
        'age_in_year'=>age_in_year(),
        'age_in_months'=>age_in_months(),
        'age_approx'=>age_approx(),
        'available_quantity'=>quantity(),
        'minimum_order_quanitity'=>minimumQuanitity(),
        'other_information'=>otherinfo(),
        'general_information'=>generalinfo(),
         'average_weight'=>average_weight(),
        'average_weight_in'=>average_weight_in(),
        'weight'=>weight(),
        'weight_in'=>weight_in(),
        
        
    );
    return $data;
}

function getCommomPageMetaTag($page)
{
    $metaTitle = '';
    $metaKeword = '';
    $metaDescription = '';
    $canonical = '';
    $metaData = Seo::where('name', $page)->first();
    if(empty($metaData))
    {
        $metaData = Seo::where('name', 'default')->first();
    }
    
    if(!empty($metaData))
    {
       $metaTitle = $metaData->meta_title;
       $metaKeword = $metaData->meta_keyword;
       $metaDescription = $metaData->meta_description;
       $canonical = $metaData->canonical;
       
    }
    if($canonical !='')
    {
       if(strpos($canonical, "http://") !== false)
       {
           $canonical_url = $canonical;
       }
       else
       {
           $canonical_url = url('/').'/'.$canonical;
       }
    
    }
    else
    {
        $canonical_url = url('/');
    }

    $tags = '<meta name="title" content="'.$metaTitle.'">
    <meta name="description" content="'.$metaDescription.'">
    <meta name="keywords" content="'.$metaKeword.'">
    <link rel="canonical" href="'.$canonical_url.'">';
    
    return $tags;
}
function getDetailsPageMetaTag($metaTitle, $metaDescription, $metaKeword, $canonical)
{
    if($canonical !='')
    {
       if(strpos($canonical, "http://") !== false)
       {
           $canonical_url = $canonical;
       }
       else
       {
           $canonical_url = url('/').'/'.$canonical;
       }
    
    }
    else
    {
        $canonical_url = url('/');
    }

    $tags = '<meta name="title" content="'.$metaTitle.'">
    <meta name="description" content="'.$metaDescription.'">
    <meta name="keywords" content="'.$metaKeword.'">
    <link rel="canonical" href="'.$canonical_url.'">';
    
    return $tags;
}