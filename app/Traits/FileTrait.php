<?php

namespace App\Traits;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    public function uploadBase64File() {

    }
    public function uploadFile($folder, $file)
    {
        return url(Storage::url(Storage::putFile("$folder", $file, 'public')));
        if (App::environment('local')) {
            return url(Storage::url(Storage::putFile("$folder", $file, 'public')));
        } else {
            return $file->storeOnCloudinary($folder)->getSecurePath();
        }
    }


    public function uploadMultipleFile($folder, $files) {
        $filePaths = [];
        foreach ($files as $file) {
            $filePaths [] = $this->uploadFile($folder, $file);
        }
        return $filePaths;
    }


    public function deleteFile($file)
    {
        // if (App::environment('local')) {
            $path = str_replace('url'.'/storage/','', $file);
            $path = storage_path("app/public/$path");
            if (file_exists($path)) {
                return unlink($path);
            }
        // } else {
        //     return Cloudinary::destroy($file);
        // }
    }
}
