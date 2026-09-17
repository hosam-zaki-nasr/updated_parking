<?php

namespace App\Http\Controllers;

use App\Constants\StatusCode;
use App\Constants\SystemDefault;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\File\FileDeleteCollection;
use App\Foundations\File\FileSearchCollection;
use App\Http\Requests\FileCreateRequest;
use App\Http\Resources\FileResource;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function index(Request $request)
    {
        $files = FileSearchCollection::searchFiles(
            $request->get('paginate') ?? -1,
            $request->get('per_page') ?? SystemDefault::DEFAUL_PAGINATION_COUNT
        );

        return response()->paginated(
            FileResource::collection($files)
        );
    }

    public function show(File $file)
    {
        return response()->success(
            trans('general.retrieved'),
            new FileResource($file),
            StatusCode::OK
        );
    }

    public function store(FileCreateRequest $request)
    {
        $file = FileCreateCollection::createFile($request->validated());

        return response()->success(
            trans('general.created'),
            new FileResource($file),
            StatusCode::CREATED
        );
    }

    public function destroy(File $file)
    {
        FileDeleteCollection::deleteFile($file);

        return response()->success(
            trans('general.deleted'),
            [],
            StatusCode::OK
        );
    }
}
