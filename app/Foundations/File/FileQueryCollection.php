<?php

namespace App\Foundations\File;

use App\Models\File;

class FileQueryCollection

{
    public static function searchAllFiles()
    {
       return File::orderBy('created_at','desc');
    }
}
