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
    protected function convertToArray(bool $transformCamelCaseToSnakeCase = false): array
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
    protected function fill(array $data, bool $transformSnakeCaseToCamelCase = false): void
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
