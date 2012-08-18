<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 18:39
 * To change this template use File | Settings | File Templates.
 */
interface LifeCycle
{
    public function onMarkupTag();

    public function onRender();

    public function onBeforeRender();

    public function onAfterRender();

    public function onInitialize();

    public function onDetach();
}
