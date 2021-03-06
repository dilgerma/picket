<?php
include_once __DIR__ . '/../BaseTestCase.php';

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 11:10
 * To change this template use File | Settings | File Templates.
 */
class MarkupParserTest extends BaseTestCase
{

    private $basePath;

    public function setUp()
    {
        $this->basePath = dirname(__FILE__);
    }

    public function testMarkupParser()
    {
        $textField = new TextField("text-id", new SimpleModel(""));
        $markupParser = new MarkupParser($this->basePath . "/test.html");
        $componentTag = $markupParser->getTagForComponent($textField);
        $this->assertEquals($componentTag->attr("pid"), $textField->getId());
        $this->assertEquals($componentTag->attr("type"), "text");
    }

    public function testPidNotAvailable()
    {
        $textField = new TextField("pid-not-available-in-html", new SimpleModel(""));
        $markupParser = new MarkupParser($this->basePath . "/test.html");
        try {
            $markupParser->getTagForComponent($textField);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
            //expected
            return;
        }
        $this->fail("Exception expected");
    }

    public function testWrongTag()
    {
        $textField = new TextField("wrong-tag", new SimpleModel(""));
        $markupParser = new MarkupParser($this->basePath . "/test.html");

        try {
            $markupParser->processContainerComponentChilds($textField);
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
            //expected
            return;
        }
        $this->fail("Exception expected");

    }

    public function testCorrectTag()
    {
        $textField = new TextField("text-id", new SimpleModel(""));
        $markupParser = new MarkupParser($this->basePath . "/test.html");
        $markupParser->processContainerComponentChilds($textField);
    }

    public function  testApplyParameters()
    {
        $textField = new TextField("text-id-with-params", new SimpleModel(""));
        $markupParser = new MarkupParser($this->basePath . "/test.html");
        $markupParser->processContainerComponentChilds($textField);

        $attributes = $textField->getAttributes();
        //class comes from html
        $this->assertEquals('test-class', $attributes['class']);
        //type is already defined, is not taken from markup, else it would be blubb
        $this->assertEquals('text', $attributes['type']);

    }

    public function testApplyParametersforChilds()
    {
        $form = new Form("applied-form", new SimpleModel(""));
        $textField = new TextField("applied-text", new SimpleModel(""));
        $form->add($textField);

        $markupParser = new MarkupParser($this->basePath . "/test.html");
        $markupParser->processContainerComponentChilds($form);

        //class comes from html
        $formAttributes = $form->getAttributes();
        $this->assertEquals('applied-parameter-class-form', $formAttributes['class']); //class comes from html
        $textFieldAttributes = $textField->getAttributes();
        $this->assertEquals('applied-parameter-class-input', $textFieldAttributes['class']);

    }


    public function testGetCurrentScriptName(){
        $currentScript = MarkupParser::getCurrentScriptMarkup();
        $this->assertEquals("html",substr($currentScript,-4));
    }
}
