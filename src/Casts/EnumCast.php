<?php

namespace Nasyrov\Laravel\Enums\Casts;

use Nasyrov\Laravel\Enums\Enum;
use Nasyrov\Laravel\Enums\Exceptions\NotHandleNull;

/**
 * This is a simple port of spatie/laravel-enum casts
 *
 * @author Julien RAVIA <julien.ravia@gmail.com>
 * @author Spatie <https://github.com/spatie>
 * @link https://github.com/spatie/laravel-enum
 */
class EnumCast extends Cast
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param int|string|null|mixed $value
     * @param array $attributes
     *
     * @return Enum|null
     *
     * @throws \BadMethodCallException
     * @throws NotHandleNull
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return $this->handleNullValue($model, $key);
        }

        return $this->asEnum($value);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param int|string|Enum|null|mixed $value
     * @param array $attributes
     *
     * @return int|string|null
     *
     * @throws \BadMethodCallException
     * @throws NotHandleNull
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if (is_null($value)) {
            return $this->handleNullValue($model, $key);
        }

        return $this->asEnum($value)->value;
    }
}
