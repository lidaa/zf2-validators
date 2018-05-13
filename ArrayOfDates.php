<?php
namespace App\Validator;

use Zend\Validator\Date;
use Zend\Validator\AbstractValidator;

/**
 * Validates that a given value is an array of DateTime instance or can be converted into one.
 */
class ArrayOfDates extends AbstractValidator
{

    const NOT_DATES = 'notDates';
    const INVALID = 'arrayInvalid';
    
    protected $messageTemplates = array(
        self::NOT_DATES => "The array must contain only dates",
        self::INVALID => "Invalid type given. Array of dates expected",
    );

    /**
     * Returns true if $value is an array of dates
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

        $dateOptions = array();
        if (isset($this->abstractOptions) && array_key_exists('format', $this->abstractOptions)) {
            $dateOptions = array('format' => $this->abstractOptions['format']);
        }

        $validatorDate = new Date($dateOptions);
        foreach ($value as $oneValue) {
            if (!$validatorDate->isValid($oneValue)) {
                $this->error(self::NOT_DATES);
                return false;
            }
        }

        return true;
    }
}
