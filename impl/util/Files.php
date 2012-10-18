<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 08:05
 * To change this template use File | Settings | File Templates.
 */
class Files
{
    /**
     * @static
     * @param $dir
     * @return array
     */
    static function listFilesInFolder($dir,$fileEnding)
    {
        $result = array();
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        foreach($objects as $name => $object){
            if(Files::valid($name,$fileEnding)) {
                array_push($result,$name);
            }
        }
        return $result;

    }

    private static function valid($path,$fileending){
        return Strings::endsWith($path,$fileending);
    }
}
