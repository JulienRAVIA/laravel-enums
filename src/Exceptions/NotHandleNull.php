<?php

namespace Nasyrov\Laravel\Enums\Exceptions;

/**
 * This is a simple port of spatie/laravel-enum casts
 *
 * @author Julien RAVIA <julien.ravia@gmail.com>
 * @author Spatie <https://github.com/spatie>
 * @link https://github.com/spatie/laravel-enum
 */
final class NotHandleNull extends \InvalidArgumentException
{
    public function make(string $field, string $model): self
    {
        return new self("Field {$field} on model {$model} is not nullable");
    }
}
