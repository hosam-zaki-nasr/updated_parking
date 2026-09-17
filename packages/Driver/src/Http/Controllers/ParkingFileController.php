<?php

namespace Driver\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\File\FileDeleteCollection;
use App\Http\Controllers\Controller;
use App\Models\Parking;
use App\Models\ParkingFile;
use Customer\Http\Resources\Parking\ParkingFileResource;
use Customer\Http\Resources\Parking\ParkingResource;
use Driver\Foundations\Parking\ParkingFile\ParkingFileCreateCollection;
use Driver\Foundations\Parking\ParkingFile\ParkingFileSearchCollection;
use Driver\Http\Requests\ParkingFile\ParkingFileCreateRequest;
use Illuminate\Http\Request;

class ParkingFileController extends Controller
{

    public function index(Parking $parking, Request $request)
    {
        $parkingFiles = ParkingFileSearchCollection::searchParkingFiles(
            $parking,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ParkingFileResource::collection($parkingFiles));
    }

    public function search(Parking $parking, Request $request)
    {
        $parkingFiles = ParkingFileSearchCollection::searchParkingFiles(
            $parking,
            $request->get('paginate') ?? -1,
            $request->get('per_page') ? $request->get('per_page') : SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(ParkingFileResource::collection($parkingFiles));
    }

    public function show(ParkingFile $parkingFile)
    {
        return response()->success(
            trans('general.retrieved'),
            new ParkingFileResource($parkingFile),
            StatusCode::OK
        );
    }

    public function store(ParkingFileCreateRequest $request)
    {
        $parkingFiles = ParkingFileCreateCollection::createParkingFiles($request);

        return response()->success(
            trans('general.created'),
            ParkingFileResource::collection($parkingFiles),
            StatusCode::OK
        );
    }

    public function destroy(ParkingFile $parkingFile)
    {
        FileDeleteCollection::deleteFile($parkingFile->file);

        $parkingFile->delete();

        return response()->success(
            trans('general.deleted'),
            null,
            StatusCode::OK
        );
    }
}
