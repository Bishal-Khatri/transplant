<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait FileStore{

    /**
     * @param $file
     * @param string $folder
     * @param array $resolution
     * @return array|string
     * thumbnail:200x200, medium:800 x 800, large: 1000 x 1000 , original
     */
    public function saveImage($file, $folder, $resolution=[])
    {
        try {
//            $original_path = "$folder/original_".$file->hashName();
//            $large_path = "$folder/large_".$file->hashName();
//            $medium_path = "$folder/medium_".$file->hashName();
//            $thumbnail_path = "$folder/thumbnail_".$file->hashName();

            if (!is_array($resolution) OR blank($resolution)){
                $resolution = [
                    'original'=> true,
                    'large' => [1000,1000],
                    'medium' => [800,800],
                    'thumbnail' => [300,300],
                ];
            }
            $returnData = [];

            if (isset($resolution['original'])){
                $original_path = "$folder/original_".$file->hashName();
                $image_original = Image::make($file)->encode();
                Storage::put('public/'.$original_path, (string) $image_original);
                $returnData['original'] = $original_path;
            }
            foreach($resolution as $key => $value){
                if (is_array($value)){
                    $path = $folder.'/'.$key.'_'.$file->hashName();
                    $image = Image::make($file)->resize($value[0], $value[1])->encode();
                    Storage::put('public/'.$path, (string) $image);
                    $returnData[$key] = $path;
                }
            }
            return $returnData;
//            if (isset($resolution['large'])){
//                $image_large = Image::make($file)->resize($resolution['large'][0], $resolution['large'][1])->encode();
//            }
//            if (isset($resolution['medium'])) {
//                $image_medium = Image::make($file)->resize($resolution['medium'][0], $resolution['medium'][1])->encode();
//            }
//            if (isset($resolution['thumbnail'])) {
//                $image_thumbnail = Image::make($file)->resize($resolution['thumbnail'][0], $resolution['thumbnail'][1])->encode();
//            }
//
//            Storage::put('public/'.$original_path, (string) $image_original);
//            Storage::put('public/'.$large_path, (string) $image_large);
//            Storage::put('public/'.$medium_path, (string) $image_medium);
//            Storage::put('public/'.$thumbnail_path, (string) $image_thumbnail);
//
//            return [
//                'original' => $original_path,
//                'large' => $large_path,
//                'medium' => $medium_path,
//                'thumbnail' => $thumbnail_path,
//            ];
        } catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

}
