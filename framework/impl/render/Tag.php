<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 08:21
 * To change this template use File | Settings | File Templates.
 */
interface Tag
{
    /**
     * Gets the Tagname
     * @abstract
     * @return mixed
     */
    public function getTagName();

    /**
     * Gets all the Attributes
     * @abstract
     * @return mixed
     */
    public function getAttributes();
}
