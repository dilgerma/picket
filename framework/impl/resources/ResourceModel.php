<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 22:38
 * To change this template use File | Settings | File Templates.
 */
class ResourceModel implements IModel
{

    private $key;
    private $component;

    public function ResourceModel($key, ComponentStub $component){
       $this->key = $key;
        $this->component = $component;
    }

    public function getValue()
    {
        $locator = Configuration::getConfigurationInstance()->resourceLocatorProvider()->get();
        return $locator->getResource($this->key,$this->component);
    }

    public function setValue($value)
    {
        //noop
    }
}
