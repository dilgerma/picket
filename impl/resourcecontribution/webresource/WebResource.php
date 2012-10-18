<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 15:22
 * To change this template use File | Settings | File Templates.
 */
interface WebResource
{
    public function render();

    /**
     *
     * @abstract
     * @return string the identifier, that is used to check whether this resource has already been rendered.
     */
    public function getIdentifier();
}
