<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 16.07.12
 * Time: 18:29
 * To change this template use File | Settings | File Templates.
 */
interface Validator
{
    /**
     * Validates the given component.
     *
     *
     * @abstract
     * @param $component
     * @param $value the value stored in $_GET or $_POST.
     * @return mixed
     */
    public function validate(ComponentStub $component,$value);
}
