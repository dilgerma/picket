<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 17:00
 * To change this template use File | Settings | File Templates.
 */
class SimpleRequestCycle implements RequestCycle
{

    private $renderCallback;
    private $initializeCallback;
    private $beforeRenderCallback;
    private $afterRenderCallback;

    private $component;

    public function SimpleRequestCycle($component){
        $this->renderCallback = function(){};
        $this->initializeCallback = function(){};
        $this->beforeRenderCallback = function(){};
        $this->afterRenderCallback = function(){};

        $this->component = $component;
    }

    public final function onRender()
    {
        call_user_func($this->renderCallback,$this->component);
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onRender();
        }
    }

    public final function onBeforeRender()
    {

        call_user_func($this->beforeRenderCallback, $this->component);
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onBeforeRender();
        }
    }

    public final function onAfterRender(){
        call_user_func($this->afterRenderCallback, $this->component);
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onAfterRender();
        }
    }

    public final function onInitialize(){
        call_user_func($this->initializeCallback, $this->component);
    }

    public final function setRenderCallback($function){
        $this->renderCallback = $function;
    }

    public final function setBeforeRenderCallback($function){
        $this->beforeRenderCallback = $function;
    }

    public final function setAfterRenderCallback($function){
        $this->afterRenderCallback = $function;
    }
}
