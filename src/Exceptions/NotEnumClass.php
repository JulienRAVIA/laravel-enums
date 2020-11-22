<?php

namespace Nasyrov\Laravel\Enums\Exceptions;

final class NotEnumClass extends \InvalidArgumentException
{
    public static function make()
    {
        return new self("This is not a valid enum class");
    }
}
