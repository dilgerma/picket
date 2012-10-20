<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 20.10.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class InvalidHierarchyException extends Exception
{
    /**
     * @param ComponentStub $parent
     * @param ComponentStub $child
     */
    public function __construct(ComponentStub $parent,ComponentStub $child){
        parent::__construct($child->getPackage()." must not be assigned to ".$parent->getPackage());
    }
}
