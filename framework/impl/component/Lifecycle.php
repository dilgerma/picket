<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 18.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
interface Lifecycle
{
     public function onBeforeRender();

     public function onRender();

     public function onAfterRender();

    public function onDetach();
}
