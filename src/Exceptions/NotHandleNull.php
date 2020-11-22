<?php

namespace Nasyrov\Laravel\Enums\Exceptions;

final class NotHandleNull extends \InvalidArgumentException
{
    public function make(string $field, string $model): self
    {
        return new self("Field {$field} on model {$model} is not nullable");
    }
}
