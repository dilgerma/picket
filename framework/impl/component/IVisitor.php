<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 20.07.12
 * Time: 14:08
 * To change this template use File | Settings | File Templates.
 */
interface IVisitor
{
    public function visit(ComponentStub $component);
}
