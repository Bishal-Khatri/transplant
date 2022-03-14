<?php
namespace App\Traits;

use stdClass;

trait SetResponse
{
    public function prepareResponse($error, $message, Array $data, Array $meta)
    {
        if(is_array($data) AND blank($data)){
            $data = new stdClass();
        }
        return [
            'error' => $error,
            'message' => $message,
            'data' => $data,
            'meta' => $meta
        ];
    }
}
