<?php
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
        "impl/data/property","impl/component","impl/component/page","impl/component/repeater","impl/component/feedback",
        "impl/form","impl/form/validation","impl/markup", "impl/render","impl/render/streamwriter", "impl/request","libs/log4php");


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
