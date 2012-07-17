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
        return $this->propertyResolver->resolveProperty($this->object,$this->expression);
    }

    public function setValue($value)
    {
        $this->propertyResolver->setProperty($this->object,$this->expression,$value);
    }
}
