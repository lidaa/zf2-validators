<?php
namespace App\Validator;

use Zend\Validator\AbstractValidator;
use Zend\I18n\Validator\IsFloat;

/**
 * Validates that a given value is an array of Floats.
 */
class ArrayOfFloats extends AbstractValidator
{

    const NOT_FLOATS = 'notFloats';
    const INVALID = 'arrayInvalid';

    protected $messageTemplates = array(
        self::NOT_FLOATS => "The array must contain only floats",
        self::INVALID => "Invalid type given. Array of floats expected",
    );

    public function isValid($value)
    {
        $this->setValue($value);

        if (!is_array($value)) {
            $this->error(self::INVALID);
            return false;
        }

        $isFloatOptions = array();
        if (isset($this->abstractOptions) && array_key_exists('locale', $this->abstractOptions)) {
            $isFloatOptions = array('locale' => $this->abstractOptions['locale']);
        }
 
        $validatorIsFloat = new IsFloat($isFloatOptions);
        foreach ($value as $oneValue) {
            if (!$validatorIsFloat->isValid($oneValue)) {
                $this->error(self::NOT_FLOATS);
                return false;
            }
        }

        return true;
    }
}
