<?php

namespace Nasyrov\Laravel\Enums\Validation;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Nasyrov\Laravel\Enums\Enum;
use Nasyrov\Laravel\Enums\Exceptions\NotEnumClass;

class EnumRule extends Rule
{
    /** @var string|Enum */
    protected $enum;

    protected $attribute = null;

    /** @var mixed */
    protected $value;

    public function __construct(string $enum)
    {
        if (new $enum instanceof Enum) {
            throw NotEnumClass::make();
        }

        $this->enum = $enum;
    }

    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;
        $this->value = $value;

        try {
            $this->asEnum($value);

            return true;
        } catch (\Throwable $ex) {
            return false;
        }
    }

    public function message(): string
    {
        return Lang::get('enum::validation.enum', [
            'attribute' => $this->attribute,
            'value' => $this->value,
            'enum' => $this->enum,
        ]);
    }

    /**
     * @param string|int $value
     *
     * @return string|null
     */
    protected function getValueTranslation($value): ?string
    {
        return Arr::get(
            \Lang::get('enum::validation.enums'),
            $this->enum.'.'.Str::slug((string) $this->asEnum($value), '_')
        );
    }

    protected function getOtherValues(): array
    {
        return forward_static_call([$this->enum, 'toValues']);
    }

    /**
     * @param int|string|Enum $value
     *
     * @return Enum
     *
     * @throws \BadMethodCallException
     */
    protected function asEnum($value): Enum
    {
        return new $this->enum($value);
    }
}
