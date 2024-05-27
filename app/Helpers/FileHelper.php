<?php

namespace App\Helpers;

use App\Exceptions\FileUploadFailException;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Generate a unique filename for the given file.
     *
     * @param \Illuminate\Http\UploadedFile
     * @return string
     */
    public static function generateUniqueFilename(UploadedFile $file): string
    {
        $extension = $file->extension();
        $filename =  uniqid() . '.' . $extension;

        while (Storage::disk('media')->exists($filename)) {
            $filename =  uniqid() . '.' . $extension;
        }

        return $filename;
    }
}
