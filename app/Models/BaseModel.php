<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Shared\Traits\RouteBindingTrait;

abstract class BaseModel extends Model
{
    use RouteBindingTrait;
}
