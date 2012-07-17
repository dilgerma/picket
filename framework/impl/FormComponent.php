<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 11:12
 * To change this template use File | Settings | File Templates.
 */
interface FormComponent
{
    public function getType();

    public function getValidators();

    public function addValidator($validator);

    public function hasErrors();

    public function error($message);

}
