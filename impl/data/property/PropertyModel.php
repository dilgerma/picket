<?php
/**
 * //desc start
 * Property Model is really cool, you can dynamically access your Domain Objects values via expressions.
 * @see the examples section, how this works.
 *
 * If you work with property models, you must supply getters and setters for your exposed properties,
 * else you´ll get Exceptinos by intention, keep this in mind please.
 *
 * @author Martin Dilger
 * //desc end
 */
class PropertyModel extends ChainedModel
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

    function __toString()
    {
        return "PropertyModel: Expression ".$this->expression." Value: ".$this->getValue();
    }


}
