<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 22:53
 * To change this template use File | Settings | File Templates.
 */
class PropertyModel implements IModel
{

    private $expression;
    private $object;
    private $propertyResolver;

    public function PropertyModel($obj, $expression){
        $this->expression = $expression;
        $this->object = $obj;
        $this->propertyResolver = new PropertyResolver();

    }

    public function getValue()
    {
        return $this->propertyResolver->resolveProperty($this->unchainModel($this->object),$this->expression);
    }

    public function setValue($value)
    {
        $this->propertyResolver->setProperty($this->unchainModel($this->object),$this->expression,$value);
    }

    private function unchainModel($object){
        if($object instanceof IModel){
            return $object->getValue();
        } else {
            return $object;
        }
    }

    function __toString()
    {
        return "PropertyModel: Expression ".$this->expression." Value: ".$this->getValue();
    }


}
