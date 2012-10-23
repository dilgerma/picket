<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 23.10.12
 * Time: 19:00
 * To change this template use File | Settings | File Templates.
 */
class EmailAddressValidator extends AbstractValidator
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
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
           $component->error("Bitte geben Sie eine gültige E-Mail Adresse ein",Level::ERROR);
        }
    }
}
