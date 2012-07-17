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

    public function onRender();

    public function onBeforeRender();

    public function onAfterRender();

    public function onInitialize();

}
