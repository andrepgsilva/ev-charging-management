<?php

declare(strict_types=1);

namespace App\Shared\Traits;

use ReflectionClass;

/**
 * @template TData of array
 */
trait DtoTrait
{
    /**
     * @return TData
     */
    public function toArray(bool $transformCamelCaseToSnakeCase = true): array
    {
        $propertiesAndValues = get_object_vars($this);

        if ($transformCamelCaseToSnakeCase) {
            /** @var TData */
            $propertiesAndValues = array_combine(
                array_map('\Illuminate\Support\Str::snake', array_keys($propertiesAndValues)),
                $propertiesAndValues
            );
        }

        /** @var TData */
        return $propertiesAndValues;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function fill(array $data, bool $transformSnakeCaseToCamelCase = true): void
    {
        if ($transformSnakeCaseToCamelCase) {
            $data = array_combine(
                array_map('\Illuminate\Support\Str::camel', array_keys($data)),
                $data
            );
        }

        $reflectionClass = new ReflectionClass($this);

        foreach ($data as $key => $value) {
            if ($reflectionClass->hasProperty($key)) {
                $property = $reflectionClass->getProperty($key);
                $property->setValue($this, $value);
            }
        }
    }
}
