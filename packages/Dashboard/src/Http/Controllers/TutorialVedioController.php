<?php

namespace Dashboard\Http\Controllers;

use App\Constants\StatusCode;
use App\Foundations\File\FileCreateCollection;
use App\Foundations\File\FileDeleteCollection;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileCreateRequest;
use App\Models\TutorialVedio;
use Dashboard\Http\Resources\TutorialVedio\TutorialVedioResource;

class TutorialVedioController extends Controller
{

    public function show()
    {
        $vedio = TutorialVedio::first();

        return response()->success(
            trans('general.retrieved'),
            new TutorialVedioResource($vedio),
            StatusCode::OK
        );
    }

    public function store(FileCreateRequest $request)
    {
        $vedio = TutorialVedio::first();

        if (!$vedio) {

            $file = FileCreateCollection::createFile($request->validated());

            $vedio = TutorialVedio::create(['file_id' => $file->id]);
        }

        return response()->success(
            trans('general.created'),
            new TutorialVedioResource($vedio),
            StatusCode::OK
        );
    }


    public function destroy()
    {
        $vedio = TutorialVedio::first();

        FileDeleteCollection::deleteFile($vedio->file);

        $vedio->delete();

        return response()->success(
            trans('general.deleted'),
            new TutorialVedioResource($vedio),
            StatusCode::OK
        );
    }
}
