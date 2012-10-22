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
     * @param $fullpath if true, the full path is returned, else only the filename
     * @return array
     */
    static function listFilesInFolder($dir,$fileEnding,$fullpath=false)
    {
        $result = array();
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
        foreach($objects as $name => $object){
            if(Files::valid($name,$fileEnding)) {
                if($fullpath){
                    array_push($result,$dir."/".$name);
                } else {
                    array_push($result,$name);
                }
            }
        }
        return $result;

    }

    /**
     * Lists all Directories in the given folder
     * @static
     * @param $dir
     * @param $fullpath if true, the full path is returned, else only the filename
     * @return array
     */
    static function listDirectoriesInFolder($dir, $fullpath=false){
        $folders = array();
        foreach(scandir($dir) as $folder){
            if(is_dir($dir."/".$folder) && ($folder !== "." && $folder !== "..")){
                if($fullpath){
                    array_push($folders,$dir."/".$folder);
                } else {
                    array_push($folders,$folder);
                }
            }
        }
        return $folders;
    }

    static function getFileContent($file){
        return file_get_contents($file);
    }

    private static function valid($path,$fileending){
        return Strings::endsWith($path,$fileending);
    }
}
