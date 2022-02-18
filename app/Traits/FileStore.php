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
        $original_path = "public/$folder/original_".$file->hashName();
        $large_path = "public/$folder/large_".$file->hashName();
        $medium_path = "public/$folder/medium_".$file->hashName();
        $thumbnail_path = "public/$folder/thumbnail_".$file->hashName();

        $image_original = Image::make($file)->encode();
        $image_large = Image::make($file)->resize(1000, 1000)->encode();
        $image_medium = Image::make($file)->resize(800, 800)->encode();
        $image_thumbnail = Image::make($file)->resize(300, 300)->encode();

        Storage::put($original_path, (string) $image_original);
        Storage::put($large_path, (string) $image_large);
        Storage::put($medium_path, (string) $image_medium);
        Storage::put($thumbnail_path, (string) $image_thumbnail);

        $original_url = Storage::url($original_path);
        $large_url = Storage::url($large_path);
        $medium_url = Storage::url($medium_path);
        $thumbnail_url = Storage::url($thumbnail_path);
        return [
            'original' => $original_path,
            'large' => $large_path,
            'medium' => $medium_path,
            'thumbnail' => $thumbnail_path,
        ];
    }
}
