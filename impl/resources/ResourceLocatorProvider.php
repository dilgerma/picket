<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 22:29
 * To change this template use File | Settings | File Templates.
 */
class ResourceLocatorProvider
{
    public function get()
    {
       return new DefaultResourceLocator();
    }
}
