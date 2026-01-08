<?php

namespace App\Traits;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UploadFileTrait {

    public function upload($file, $path = 'images')
    {
        $name = str_replace(" ", "_", $file->getClientOriginalName());
        $fileName = time()."_".$name;

        // Store directly in the public folder
        $file->move(public_path($path), $fileName);

        return $fileName;
    }

    public function removeImage($fileName, $path = 'images')
    {
        $filePath = public_path($path.'/'.$fileName);
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}

?>
