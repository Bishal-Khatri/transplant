<?php
namespace App\Enum;

use ReflectionClass;

class UserType
{
    const ADMINISTRATOR = 'administrator';
    const HOSPITAL = 'hospital';

    static function getConstants() {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
