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

    /**
     * Gets the content between the two given separators
     *
     * taken from http://www.bitrepository.com/extract-content-between-two-delimiters-with-php.html
     * @static
     * @param $contents
     * @param $separator_start
     * @param $separator_end
     */
    static function getInBetween($string,$start,$end){
        $pos = stripos($string, $start);

        $str = substr($string, $pos);

        $str_two = substr($str, strlen($start));

        $second_pos = stripos($str_two, $end);

        $str_three = substr($str_two, 0, $second_pos);

        $unit = trim($str_three); // remove whitespaces

        return $unit;
    }

}
