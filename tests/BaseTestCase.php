<?php
include_once __DIR__.'/../Autoloader.php';
include_once 'PHPUnit/Autoload.php';
require_once(__DIR__.'/SimpleTestMarkupParser.php');

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 16.07.12
 * Time: 17:38
 * To change this template use File | Settings | File Templates.
 */
class BaseTestCase extends PHPUnit_Framework_TestCase
{
     public function setUp(){
         //document root is not set
         $_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__)."/../");
     }
}
