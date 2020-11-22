<?php

namespace Nasyrov\Laravel\Enums\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Nasyrov\Laravel\Enums\Enum;
use Nasyrov\Laravel\Enums\Exceptions\NotHandleNull;

abstract class Cast implements CastsAttributes
{
    /** @var string|Enum */
    protected $enumClass;

    protected $isNullable = false;

    /**
     * Cast constructor.
     * @param string $enumClass
     * @param string[] ...$options
     */
    public function __construct(string $enumClass, ...$options)
    {
        $this->enumClass = $enumClass;

        $this->isNullable = in_array('nullable', $options);
    }

    /**
     * @param int|string|Enum $value
     *
     * @return Enum
     *
     * @throws \TypeError
     * @throws \BadMethodCallException
     */
    protected function asEnum($value): Enum
    {
        if ($value instanceof Enum) {
            return $value;
        }

        return new $this->enumClass($value);
    }

    /**
     * @param Model $model
     * @param string $key
     *
     * @return null
     *
     * @throws NotHandleNull
     */
    protected function handleNullValue(Model $model, string $key)
    {
        if ($this->isNullable) {
            return null;
        }

        throw new NotHandleNull($key, get_class($model));
    }
}
