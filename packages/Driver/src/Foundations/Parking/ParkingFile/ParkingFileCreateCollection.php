<?php

namespace Driver\Foundations\Parking\ParkingFile;

use App\Foundations\File\FileCreateCollection;
use App\Models\Parking;
use App\Models\ParkingFile;
use Driver\Http\Requests\ParkingFile\ParkingFileCreateRequest;

class ParkingFileCreateCollection
{
    public static function createParkingFiles(ParkingFileCreateRequest $request)
    {
        $validated = $request->validated();

        $parking = Parking::find($validated['parking_id']);

        if (isset($validated['files'])) {

            foreach ($validated['files'] as $file) {

                $data['file'] = $file;

                $file = FileCreateCollection::createFile($data);

                ParkingFile::create([
                    "file_id" => $file->id,
                    "parking_id" => $parking->id,
                    "creator_id" => auth()->id(),
                ]);
            }
        }

        return $parking->parkingFiles;
    }
}
