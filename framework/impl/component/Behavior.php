<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 18.07.12
 * Time: 10:22
 * To change this template use File | Settings | File Templates.
 */
interface Behavior extends Lifecycle
{
     public function onBind(FormComponentStub $component);
}