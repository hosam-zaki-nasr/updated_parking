<?php

namespace App\Foundations\File;

use App\Constants\SystemDefault;

class FileSearchCollection

{
    public static function searchFiles(
        $paginate = -1,
        $per_page = SystemDefault::DEFAUL_PAGINATION_COUNT,
    ) {
        $users = FileQueryCollection::searchAllFiles();

        if ($paginate && $paginate != -1) {

            return $users->paginate($per_page);
        } else {
            return $users->get();
        }
    }
}
