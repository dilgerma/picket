<?php
include_once __DIR__.'/../BaseTestCase.php';

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class CallbackUriTest extends BaseTestCase
{


    public function testRender(){
        $callbackUri = new FormCallBackUri(new Form("test-form",new SimpleModel("test")));
        $script = $callbackUri->getScriptName();

    }

}

