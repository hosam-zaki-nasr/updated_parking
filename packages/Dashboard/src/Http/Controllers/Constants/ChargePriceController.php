<?php

namespace Dashboard\Http\Controllers\Constants;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Http\Controllers\Controller;
use App\Models\ChargePrice;
use Dashboard\Foundations\Constants\ChargePrice\ChargePriceSearchCollection;
use Dashboard\Http\Requests\Constants\ChargePrice\ChargePriceCreateRequest;
use Dashboard\Http\Requests\Constants\ChargePrice\ChargePriceUpdateRequest;
use Dashboard\Http\Resources\Constants\ChargePrice\ChargePriceMinifiedResource;
use Dashboard\Http\Resources\Constants\ChargePrice\ChargePriceResource;
use Illuminate\Http\Request;

class ChargePriceController extends Controller
{
    public function index(Request $request)
    {
        $chargePrices = ChargePriceSearchCollection::searchChargePrices(
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ChargePriceMinifiedResource::collection($chargePrices));
    }

    public function store(ChargePriceCreateRequest $request)
    {
        $chargePrice = ChargePrice::create($request->validated());

        return response()->success(
            trans('general.created'),
            new ChargePriceResource($chargePrice),
            StatusCode::OK
        );
    }

    public function update(ChargePriceUpdateRequest $request, ChargePrice $chargePrice)
    {
        $chargePrice->update($request->validated());

        return response()->success(
            trans('general.updated'),
            new ChargePriceResource($chargePrice),
            StatusCode::OK
        );
    }

    public function destroy(ChargePrice $chargePrice)
    {
        $chargePrice->delete();

        return response()->success(
            trans('general.deleted'),
            new ChargePriceResource($chargePrice),
            StatusCode::OK
        );
    }
}
