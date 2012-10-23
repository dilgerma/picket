<?php
/**
 * Allows only numbers.
 */
class NumberValidator extends AbstractValidator
{

    /**
     * Validates the given component.
     *
     *
     * @param $component
     * @param $value the value stored in $_GET or $_POST.
     * @return mixed
     */
    public function validate(ComponentStub $component, $value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false) {
           $component->error("Bitte geben Sie eine gültige Zahl ein",Level::ERROR);
        }
    }
}
