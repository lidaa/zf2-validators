<?php
namespace App\Validator;

use Zend\Validator\AbstractValidator;
use Zend\I18n\Validator\IsInt;

/**
 * Validates that a given value is an array of Integers.
 */
class ArrayOfInts extends AbstractValidator
{

    const NOT_INTS = 'notInts';
    const INVALID = 'arrayInvalid';

    protected $messageTemplates = array(
        self::NOT_INTS => "The array must contain only integers",
        self::INVALID => "Invalid type given. Array of integers expected",
    );

    public function isValid($value)
    {
        $this->setValue($value);

        if (!is_array($value)) {
            $this->error(self::INVALID);
            return false;
        }

        $isIntOptions = array();
        if (isset($this->abstractOptions) && array_key_exists('locale', $this->abstractOptions)) {
            $isIntOptions = array('locale' => $this->abstractOptions['locale']);
        }

        $validatorIsInt = new IsInt($isIntOptions);
        foreach ($value as $oneValue) {
            if (!$validatorIsInt->isValid($oneValue)) {
                $this->error(self::NOT_INTS);
                return false;
            }
        }

        return true;
    }
}
