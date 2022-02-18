<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait Slug{

    public function createSlug($text)
    {
        return Str::slug($text, '-');
    }
}
