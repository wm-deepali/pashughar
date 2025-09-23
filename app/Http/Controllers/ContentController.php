<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use App\Models\Feature;
use App\Models\VehicleType;
use App\Models\AdFeature;
use App\Models\SubCategory;
use App\Models\FuelType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;
use Validator;

class ContentController extends Controller
{
    public function fetchSubcategory($category)
    {
        try{
            $category = Category::findOrFail($category);
            $sub_categories = SubCategory::where('category_id',$category->id)->get();
            return response()->json([
                "success" => true,
                 //'brands'=>$brand,
                "html" => view('front.extra.option')->with([
                    'datas' => $sub_categories,
                ])->render(),
            ]);
            //if(isset($sub_categories) && count($sub_categories)>0)
            //{
                // return response()->json([
                //     "success" => true,
                //     "html" => view('front.extra.custom-select')->with([
                //         'div_class' => 'subcategory_div',
                //         'label' => 'Sub Category',
                //         'name' => 'subcategory_id',
                //         'datas' => $sub_categories,
                //     ])->render(),
                // ]);
            // }
            // else
            // {
            //     return response()->json([
            //         "success" => true,
            //         'html' =>" ",
            //     ]);
                
            // }
            
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
    public function fetchSubcategoryOptions($category)
    {
        try{
            $category = Category::findOrFail($category);
            $sub_categories = SubCategory::where('category_id',$category->id)->get();
             $brands = Brand::where('brand_category_id',$category->id)->first();
            if($brands != null){
                $brand=1;
            }
            else{
                $brand=0;
            }
            return response()->json([
                "success" => true,
                 'brands'=>$brand,
                "html" => view('front.extra.option')->with([
                    'datas' => $sub_categories,
                ])->render(),
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function fetchBrandOptions($category)
    {
        try{
            $category = BrandCategory::findOrFail($category);
            $brands = Brand::where('brand_category_id',$category->id)->get();
            return response()->json([
                "success" => true,
                "html" => view('front.extra.option')->with([
                    'datas' => $brands,
                ])->render(),
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function fetchFuelType($type)
    {
        try{
            $vehicle = VehicleType::where('name',$type)->where('status', 1)->first();
            $fuel = FuelType::where('vehicle_type_id',$vehicle->id)->get();
            return response()->json([
                "success" => true,
                "html" => view('front.extra.option')->with([
                    'datas' => $fuel,
                ])->render(),
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function fetchBrand($category)
    {
        try{
               $category = Category::findOrFail($category);
        
            $brands = Brand::where('brand_category_id',$category->id)->get();
            return response()->json([
                "success" => true,
                "html" => view('front.extra.custom-select')->with([
                    'div_class' => 'brand_div',
                    'label' => 'Brand',
                    'name' => 'brand_id',
                    'datas' => $brands,
                ])->render(),
            ]);
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }


    public function fetchFormData($category, $subcategory)
    {
        try{
            $html = '';
            if($subcategory ==0)
            {
                $featuresData = Feature::where('category_id', $category)->latest()->first();
                
            }
            else{
                $featuresData = Feature::where('category_id', $category)->where('subcategory_id', $subcategory)->latest()->first();
                if(empty($featuresData))
                {
                    $featuresData = Feature::where('category_id', $category)->latest()->first();
                }
            }
            
            $brands = Brand::where('brand_category_id',$category)->get();
          
            if(!empty($featuresData))
            {
                $fetatures = json_decode($featuresData->features);
                $data= featcherformData();
                for($i=0;$i<count($fetatures);$i++)
                {
                    $html.= $data[$fetatures[$i]];
                }
                
                return response()->json([
                    "success" => true,
                    'html' =>$html,
                    'brands'=> view('front.extra.option')->with([
                    'datas' => $brands,
                            ])->render(),
                ]);
            }
            
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }

    public function fetchFeatureFormData($ad)
    {
        try{
            $features = AdFeature::where('ad_id',$ad)->get();
            if(isset($features) && count($features) >0)
            {
                return response()->json([
                    "success" => true,
                    "features" => $features,
                ]);
            }
            else{
                return response()->json([
                    "success" => false,
                    "features" => $features,
                ]);

            }
            
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                'msgText' =>$ex->getMessage(),
            ]);
        }
    }
    
}
