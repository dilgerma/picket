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
 * User: dilgerma
 * Date: 15.07.12
 * Time: 22:40
 * To change this template use File | Settings | File Templates.
 */
class Autoloader
{


    private static $packages = array("impl","impl/resources", "impl/application", "impl/application/session","impl/container", "impl/data",
        "impl/data/property","impl/component","impl/util","impl/component/page","impl/component/repeater","impl/component/feedback",
        "impl/form","impl/form/validation","impl/markup","impl/resourcecontribution","impl/resourcecontribution/webresource", "impl/render",
        "impl/render/streamwriter", "impl/request","impl/exception","libs/log4php");


    public static function loadClass($classname)
    {
        $basepath = dirname(__FILE__);
        foreach (Autoloader::$packages as $dir) {
            $handle = opendir($basepath . "/" . $dir);
            while ($file = readdir($handle)) {

                if ($file !== ".." && $file !== ".") {
                    if ($file === $classname.".php") {
                        $filename = $basepath."/".$dir."/".$file;

                        require_once $filename;
                    }
                }
            }
            closedir($handle);
        }
    }


}

spl_autoload_register(function($classname)
{
    Autoloader::loadClass($classname);
});
