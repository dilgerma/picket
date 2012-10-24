<?php
/**
 * //desc start
 * The most simple model you can think of.
 * Just a value container with getValue- and setValue Methods.
 * @author Martin Dilger
 * //desc end
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
