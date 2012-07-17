<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 16.07.12
 * Time: 18:30
 * To change this template use File | Settings | File Templates.
 */
class RequiredValidator implements Validator
{

    public function validate($component, $value)
    {

       if($value === ''){
           echo "marking component error";
           $component->error("Dies ist ein Pflichtfeld");
       }
    }
}
