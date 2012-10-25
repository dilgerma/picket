<?php
/**
Copyright (c) 2012, Martin Dilger - EffectiveTrainings.de
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
 * Neither the name of the <organization> nor the
names of its contributors may be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL EffectiveTrainings BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


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

    /**
     * removes the first character $needle, if the strings starts with it.
     * @static
     * @param $search
     * @param $needle#
     */
    public static function removeFirstCharacterIfAvailable($search, $needle)
    {
        if (strpos($search, $needle) === 0) {
            return substr($search, 1);
        }
        return $search;
    }

}
