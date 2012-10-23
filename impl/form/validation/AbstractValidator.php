<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 23.10.12
 * Time: 19:09
 * To change this template use File | Settings | File Templates.
 */
abstract class AbstractValidator implements Validator
{

    /**
     * Validates the given component.
     *
     *
     * @param $component
     * @param $value the value stored in $_GET or $_POST.
     * @return mixed
     */
    public abstract  function validate(ComponentStub $component, $value);

}
