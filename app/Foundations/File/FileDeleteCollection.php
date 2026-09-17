<?php

namespace App\Foundations\File;

use Illuminate\Support\Facades\File as FacadesFile;

use App\Models\File;

class FileDeleteCollection
{
    public static function deleteFile(File $file)
    {
        FacadesFile::delete($file->file_path . $file->new_name);

        $file->delete();

        return $file;
    }
}
