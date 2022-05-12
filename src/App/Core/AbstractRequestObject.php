<?php

namespace App\Core;

use App\Core\Validators\FloatValidator;
use App\Core\Validators\IntegerValidator;
use App\Core\Validators\StringValidator;
use App\Core\Validators\ValidatorInterface;

class AbstractRequestObject
{
    public const TYPE_INT = 'int';
    public const TYPE_FLOAT = 'float';
    public const TYPE_STRING = 'string';

    public const VALIDATOR_TYPE = 'type';
    public const VALIDATOR_NOT_NULL = 'notNull';
    public const VALIDATOR_AVAILABLE_VALUES = 'availableValues';

    protected function rules(): array
    {
        return [];
    }

    /**
     * @var array<array-key, ValidatorInterface>
     */
    private array $validators = [
        self::TYPE_INT => IntegerValidator::class,
        self::TYPE_FLOAT => FloatValidator::class,
        self::TYPE_STRING => StringValidator::class,
    ];

    public function validate(): bool
    {
        foreach ($this->rules() as $field => $rule) {
            $ruleType = $rule[AbstractRequestObject::VALIDATOR_TYPE];
            $ruleNotNull = $rule[AbstractRequestObject::VALIDATOR_NOT_NULL] ?? null;
            $availableValues = $rule[AbstractRequestObject::VALIDATOR_AVAILABLE_VALUES] ?? null;
            if ($this->isFieldInvalid($ruleType, $field)) {
                return false;
            }
            if ($ruleNotNull && is_null($this->$field)) {
                return false;
            }
            if ($availableValues && !in_array($this->$field, $availableValues)) {
                return false;
            }
        }

        return true;
    }

    protected function isFieldInvalid(string $ruleType, string $field): bool
    {
        return isset($this->validators[$ruleType]) && !(new $this->validators[$ruleType]())->validate($this->$field);
    }
}
