<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use Illuminate\Http\Request;

class BrandModelController extends Controller
{
    function __construct()
    {
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getModelsByBrand(Request $request){
        $dates = $request->all();
        $brand_id = $dates['brand_id'];
        $brands = BrandModel::where('brand_id', '=', $brand_id)->get();
        $arrayResult=array();
        foreach ($brands as $brand){
            $arrayResult[$brand->id]=$brand->name;
        }
        return $arrayResult;
    }

}
