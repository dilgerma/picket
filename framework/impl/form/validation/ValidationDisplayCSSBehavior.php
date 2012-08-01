<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 14:14
 * To change this template use File | Settings | File Templates.
 */
class ValidationDisplayCSSBehavior extends BehaviorAdapter {

    /**
     * @var ComponentStub
     */
    private $component;

    public function onRender()
    {
        if($this->component->hasErrors()){
            $this->component->appendAttribute(array("class"=>"validation-error"));
        }
    }

    public function bind(ComponentStub $component)
    {
        $this->component = $component;
    }

    public function onDetach()
    {
        parent::onDetach();
        unset($this->component);
    }


}
