<?php

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:34
 * To change this template use File | Settings | File Templates.
 */
interface FormSubmitListener
{
    public function onSubmit();

    public function checkSubmit();

    public function process();

}
