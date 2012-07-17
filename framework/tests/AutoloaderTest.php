<?php include_once(__DIR__.'/BaseTestCase.php');?>

<?php

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class AutoloaderTest extends BaseTestCase
{

    public function testAutoLoader(){
        new SimpleModel("");
    }

}

