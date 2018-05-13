# zf2-validators
Additional zend framework validators

### Validators

**- ArrayOfDates :**

    Validates that a given value is an array of DateTime instance or can be converted into one.

**- ArrayOfDigits :**

    Validates that a given value is an array of Digits.


**- ArrayOfFloats :**

    Validates that a given value is an array of Floats.
    

**- ArrayOfInts :**

    Validates that a given value is an array of Integers.
    

### Example
```
$validator = new App\Validator\ArrayOfInts();

$validator->isValid(array(12, 2, 17));   // returns true
$validator->isValid(array(15, "a"));    // returns false
```

### Require Zend Validator Component
