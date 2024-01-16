<?php

namespace Trait\Helpers;

use Illuminate\Support\Facades\File;

class ImageHelper
{
    public static function IsDirectoryExist($directoryPath)
    {
        if (File::exists(public_path($directoryPath))) {
            return true;
        }
        return false;
    }
    public static function deleteDirectory($directoryPath)
    {
        if (File::exists($directoryPath)) {
            File::deleteDirectory($directoryPath);
            return true;
        }
        return false;
    }
}
