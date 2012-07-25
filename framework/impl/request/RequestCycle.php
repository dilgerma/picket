<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 16:58
 * To change this template use File | Settings | File Templates.
 */
interface RequestCycle
{

    const ON_INITIALIZE = 1;
    const ON_MARKUP = 2;
    const ON_BEFORE_RENDER = 3;
    const ON_RENDER = 4;
    const ON_AFTER_RENDER = 5;
    const ON_DETACH = 6;


    public function onMarkupTag();

    public function onRender();

    public function onBeforeRender();

    public function onAfterRender();

    public function onInitialize();

    public function onDetach();

    /**
     * @abstract
     * @param $lifecyclePhase a phase as defined in this interface.
     * @param $function the callback functino that may take a component as parameter
     * @return mixed
     */
    public function setCallback($lifecyclePhase,$function);

}
