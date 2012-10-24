<?php
/**
 * //desc start
 * Resource Model allows you to externalize some strings.
 * What you need to do in order to use a resource model is to
 * provide a Class in the same package structure as your component with _resource ending.
 *
 * So if you create a Panel TestPanel.php, you need to declare a new Class TestPanel_resource.php
 * in a File with the same name.
 *
 * In this class you can then declare const-values, for example
 *
 * const theKey = "display me!"
 *
 * Within TestPanel, you can use a Resource Model like this:
 *
 * $this->add(new Label("someId", new ResourceModel("theKey",$this);
 *
 * And the Label will display the value of the const named "theKey"
 *
 * @author Martin Dilger
 * //desc end
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
