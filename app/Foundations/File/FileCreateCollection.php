<?php

namespace App\Foundations\File;

use App\Constants\FileModuleType;
use App\Models\File;

class FileCreateCollection
{
    public static function createFile($validated)
    {
        $destinationPath = public_path('uploads/');

        $file_data = MainRepo::fileHandle($validated['file'], $destinationPath);

        if (isset($validated['type']) && $validated['type'] ==  FileModuleType::DEFAULT_USER_AVATAR['key']) {

            $file = File::where('type', FileModuleType::DEFAULT_USER_AVATAR['key'])->first();

            if(!$file){

                $file_data['type'] = isset($validated['type']) ? $validated['type'] : null;

                $file = File::create($file_data);
            }

        } else {

            $file_data['type'] = isset($validated['type']) ? $validated['type'] : null;

            $file = File::create($file_data);
        }

        return $file;
    }
}
