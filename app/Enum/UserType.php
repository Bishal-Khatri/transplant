<?php
namespace App\Enum;

use ReflectionClass;

class UserType
{
    const SUBSCRIBER = 'subscriber';
    const ADMINISTRATOR = 'administrator';
    const RESTAURANT = 'restaurant';
    const DELIVERY_PERSON = 'delivery_person';

    // USER TYPES FOR Organ Transplant
//    const HOSPITAL = 'hospital';

    static function getConstants() {
        $oClass = new ReflectionClass(__CLASS__);
        return $oClass->getConstants();
    }
}
