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
    private $markupTagCallback;
    private $detachCallback;

    private $component;

    public function SimpleRequestCycle($component){
        $this->renderCallback = function(){};
        $this->initializeCallback = function(){};
        $this->beforeRenderCallback = function(){};
        $this->afterRenderCallback = function(){};
        $this->markupTagCallback = function(){};
        $this->detachCallback = function(){};

        $this->component = $component;
    }

    public final function onRender()
    {
        call_user_func($this->renderCallback,$this->component);
        $this->component->onRender();
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onRender();
        }
    }

    public final function onBeforeRender()
    {

        call_user_func($this->beforeRenderCallback, $this->component);
        $this->component->onBeforeRender();
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onBeforeRender();
        }
    }

    public final function onAfterRender(){
        call_user_func($this->afterRenderCallback, $this->component);
        $this->component->onAfterRender();
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onAfterRender();
        }
    }

    public final function onMarkupTag(){
        call_user_func($this->markupTagCallback,$this->component);
        $this->component->onMarkupTag();
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onMarkupTag();
        }
    }

    public final function onInitialize(){
        call_user_func($this->initializeCallback, $this->component);
        $this->component->onInitialize();
    }

    public function onDetach()
    {
        call_user_func($this->detachCallback, $this->component);
        $this->component->onDetach();
    }

    /**
     * @param $lifecyclePhase a phase as defined in this interface.
     * @param $function the callback functino that may take a component as parameter
     * @return mixed
     */
    public function setCallback($lifecyclePhase, $function)
    {
        switch($lifecyclePhase){
            case RequestCycle::ON_INITIALIZE: $this->initializeCallback = $function;break;
            case RequestCycle::ON_MARKUP: $this->markupTagCallback = $function;break;
            case RequestCycle::ON_BEFORE_RENDER: $this->beforeRenderCallback = $function;break;
            case RequestCycle::ON_RENDER: $this->renderCallback = $function;break;
            case RequestCycle::ON_AFTER_RENDER: $this->afterRenderCallback = $function;break;
            case RequestCycle::ON_DETACH: $this->detachCallback = $function;break;
        }
    }
}
