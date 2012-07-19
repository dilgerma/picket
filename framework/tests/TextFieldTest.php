<?php include_once(__DIR__.'/BaseTestCase.php');?>
<?php


/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class TextFieldTest extends BaseTestCase
{


    public function testRender(){
        $text = new TextField("theId", new SimpleModel("Display Text"));
        $text->addAttributes(array("required"=>"required"));
        $rendered = $text->renderTag();
        $this->assertEquals("<input name='".$text->getId()."' type='text' required='required' ></input>",$rendered);
    }



}

