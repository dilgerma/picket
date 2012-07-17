<?php include_once(__DIR__.'/BaseTestCase.php');?>


<?php

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class TextAreaTest extends BaseTestCase
{

    public function testRender(){
        $textarea = new TextArea("text-area",new SimpleModel("Test-Value"));
        $rendered = $textarea->renderTag();
        $this->assertEquals("<textarea name='".$textarea->getId()."' >Test-Value</textarea>",$rendered);
    }

}

