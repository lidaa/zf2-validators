<?php
namespace App\Validator;

use Zend\Validator\AbstractValidator;
use Zend\Validator\Digits;

/**
 * Validates that a given value is an array of Digits.
 */
class ArrayOfDigits extends AbstractValidator
{

    const NOT_DIGITS = 'notDigits';
    const INVALID = 'arrayInvalid';

    protected $messageTemplates = array(
        self::NOT_DIGITS => "The array must contain only digits",
        self::INVALID => "Invalid type given. Array of digits expected",
    );

    /**
     * Returns true if $value is an array of digits
     * 
     * @param array $value
     * @return boolean
     */
    public function isValid($value)
    {
        $this->setValue($value);

        if (!is_array($value)) {
            $this->error(self::INVALID);
            return false;
        }

        $validatorDigits = new Digits();
        foreach ($value as $oneValue) {
            if (!$validatorDigits->isValid($oneValue)) {
                $this->error(self::NOT_DIGITS);
                return false;
            }
        }

        return true;
    }
}
