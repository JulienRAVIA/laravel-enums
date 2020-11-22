<?php

namespace Nasyrov\Laravel\Enums\Casts;

use Illuminate\Support\Arr;
use Nasyrov\Laravel\Enums\Enum;
use Nasyrov\Laravel\Enums\Exceptions\NotHandleNull;

/**
 * This is a simple port of spatie/laravel-enum casts
 *
 * @author Julien RAVIA <julien.ravia@gmail.com>
 * @author Spatie <https://github.com/spatie>
 * @link https://github.com/spatie/laravel-enum
 */
class EnumCastCollection extends Cast
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param string|null|mixed $value
     * @param array $attributes
     *
     * @return Enum[]|null
     *
     * @throws \BadMethodCallException
     * @throws NotHandleNull
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return $this->handleNullValue($model, $key);
        }

        return $this->asEnums(
            Arr::wrap(json_decode($value, true))
        );
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param int[]|string[]|\Spatie\Enum\Enum[]|null|mixed $value
     * @param array $attributes
     *
     * @return string|null
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return $this->handleNullValue($model, $key);
        }

        return json_encode($this->asEnums(Arr::wrap($value)));
    }

    /**
     * @param int[]|string[]|Enum[] $values
     *
     * @return Enum
     *
     * @throws \TypeError
     * @throws \BadMethodCallException
     */
    protected function asEnums(array $values): array
    {
        return array_map([$this, 'asEnum'], $values);
    }
}
