<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 16:08
 * To change this template use File | Settings | File Templates.
 */
class Strings
{
    static function endsWith($whole, $end)
    {
        return (strpos($whole, $end, strlen($whole) - strlen($end)) !== false);
    }

}
