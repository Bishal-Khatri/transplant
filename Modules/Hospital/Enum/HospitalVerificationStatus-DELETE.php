<?php
namespace Modules\Hospital\Enum;

interface HospitalVerificationStatus
{
    const NONE = 0;
    const DOCUMENT_VERIFIED = 1;
    const PHYSICAL_VERIFIED = 2;
    const VERIFIED = 3;
}
