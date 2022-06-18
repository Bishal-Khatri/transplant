<?php
namespace Modules\Hospital\Enum;

interface PatientStatus
{
    const ACTIVE = 1;
    const ON_HOLD = 2;
    const RECEIVED = 3;
    const CANCELED = 4;
}
