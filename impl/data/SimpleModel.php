<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 09:00
 * To change this template use File | Settings | File Templates.
 */
class SimpleModel implements IModel
{

    private $value;

    public function SimpleModel($value){
        $this->value = $value;
    }

    public function getValue()
    {
       return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}
