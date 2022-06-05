<?php
namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait UserTrait{

    private $default_password = 'password';

    public function defaultPasswordHashed()
    {
        return Hash::make($this->default_password);
    }

    public function defaultPasswordText()
    {
        return $this->default_password;
    }

}
