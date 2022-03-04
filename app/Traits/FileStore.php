<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait FileStore{

    /**
     * @param $file
     * @param string $folder
     * @return array
     * thumbnail:200x200, medium:800 x 800, large: 1000 x 1000 , original
     */
    public function saveImage($file, $folder)
    {
        $original_path = "$folder/original_".$file->hashName();
        $large_path = "$folder/large_".$file->hashName();
        $medium_path = "$folder/medium_".$file->hashName();
        $thumbnail_path = "$folder/thumbnail_".$file->hashName();

        $image_original = Image::make($file)->encode();
        $image_large = Image::make($file)->resize(1000, 1000)->encode();
        $image_medium = Image::make($file)->resize(800, 800)->encode();
        $image_thumbnail = Image::make($file)->resize(300, 300)->encode();

        Storage::put('public/'.$original_path, (string) $image_original);
        Storage::put('public/'.$large_path, (string) $image_large);
        Storage::put('public/'.$medium_path, (string) $image_medium);
        Storage::put('public/'.$thumbnail_path, (string) $image_thumbnail);

        return [
            'original' => $original_path,
            'large' => $large_path,
            'medium' => $medium_path,
            'thumbnail' => $thumbnail_path,
        ];
    }

}
