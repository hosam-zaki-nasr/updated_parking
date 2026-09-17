<?php

namespace App\Foundations\File;

use Illuminate\Support\Str;

class MainRepo
{

    public static function fileHandle($file, $destinationPath)
    {

        $file_original_name = $file->getClientOriginalName();

        $file_original_extension = $file->getClientOriginalExtension();

        $file_new_name = Str::random(10) . '.' . $file_original_extension;

        $file->move($destinationPath, $file_new_name);


        return [
            'original_name' => $file_original_name,
            'original_extension' => $file_original_extension,
            'new_name' => $file_new_name,
            'file_path' => $destinationPath,
        ];
    }

    final static public function getFile($file)
    {

        if (!$file)
            return null;

        if (!str_starts_with($file->file_path, "http"))
            $file->file_path =  url($file->file_path . $file->new_name);

        return $file;
    }
}
