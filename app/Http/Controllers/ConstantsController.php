<?php

namespace App\Http\Controllers;

use App\Constants\StatusCode;
use App\Models\CarColor;
use App\Models\CarType;
use App\Models\ChargePrice;
use Dashboard\Http\Resources\Constants\CarColor\CarColorResource;
use Dashboard\Http\Resources\Constants\CarType\CarTypeResource;
use Dashboard\Http\Resources\Constants\ChargePrice\ChargePriceResource;

class ConstantsController extends Controller
{

    public function carColors()
    {
        $carColors = CarColor::get();

        return response()->paginated(CarColorResource::collection($carColors));
    }

    public function carTypes()
    {
        $carTypes = CarType::get();

        return response()->paginated(CarTypeResource::collection($carTypes));
    }

    public function priceList()
    {
        $priceList = ChargePrice::orderBy('price','ASC')->get();

        return response()->paginated(ChargePriceResource::collection($priceList));
    }
}
