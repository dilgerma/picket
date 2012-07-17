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


    private static $packages = array("impl", "impl/application", "impl/container", "impl/data",
        "impl/data/property",
        "impl/form","impl/markup", "impl/render", "impl/request","tests/request");
   //private static $testPackages = array("tests", "tests/form", "tests/render",
     //   "tests/request","tests/markup");

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
