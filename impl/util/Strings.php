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
    static function endsWith($string, $ending)
    {
        $len = strlen($ending);
        $string_end = substr($string, strlen($string) - $len);

        return $string_end == $ending;
    }

}
