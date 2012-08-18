<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 23.07.12
 * Time: 20:02
 * To change this template use File | Settings | File Templates.
 */
class EmptyModel implements IModel
{

    public function getValue()
    {
        return null;
    }

    public function setValue($value)
    {
       //noop
    }
}
