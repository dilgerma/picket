<?php
include_once(__DIR__.'/BaseTestCase.php');
require_once(__DIR__.'/SimpleTestMarkupParser.php');


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

        $markupParser = new SimpleTestMarkupParser("SimpleMarkupTestFile.html");

        $text = new TextField("test", new SimpleModel("Display Text"));
        $text->addAttributes(array("required"=>"required"));
        $rendered = $text->render($markupParser);
        $matcher = array("tag"=>"input", "attributes"=>array("name"=>$text->getId(),"required"=>"required","type"=>"text","value"=>$text->getModel()->getValue()));
        $this->assertTag($matcher,$rendered);
    }



}

