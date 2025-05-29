<?php

declare(strict_types=1);

namespace App\Models;

use ReflectionClass;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  ?string  $field
     * @return Model
     */
    final public function resolveRouteBinding($value, $field = null) // @pest-ignore-type
    {
        $model = parent::resolveRouteBinding($value, $field);

        if (is_null($model)) {
            $modelShortName = (new ReflectionClass($this))->getShortName();
            $errorMessage = $modelShortName.' Not Found';

            if (is_string($value)) {
                $errorMessage = $modelShortName." $value Not Found";
            }

            $response = response()->json([
                'status' => false,
                'message' => $errorMessage,
            ], 404);

            abort($response);
        }

        return $model;
    }
}
