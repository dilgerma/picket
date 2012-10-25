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

    static function toLocalPath($completePath){
        return str_replace($_SERVER['DOCUMENT_ROOT'],"",$completePath);
    }
}
