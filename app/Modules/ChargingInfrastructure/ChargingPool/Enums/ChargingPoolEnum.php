<?php

declare(strict_types=1);

namespace App\Modules\ChargingInfrastructure\ChargingPool\Enums;

enum ChargingPoolEnum: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';
    case COMPANY = 'company';
    case CONDOMINIUM = 'condominium';
}
