<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 22:13
 * To change this template use File | Settings | File Templates.
 */
interface ResourceLocator
{
     public function getResource( $key, ComponentStub $component = null);

}
