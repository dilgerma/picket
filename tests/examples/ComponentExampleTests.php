<?php
require_once(__DIR__ . '/../BaseTestCase.php');

/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 11:44
 * To change this template use File | Settings | File Templates.
 */
class ComponentExampleTests extends BaseTestCase
{
    private $testCases = array();

    public function setUp(){
        //load all php files that end with ...ExamplePanel.php
       $this->testCases = Files::listFilesInFolder(__DIR__."/../../examples/sections/components","ExamplePanel.php");
    }

    public function testRender(){
        foreach($this->testCases  as $component){
            //load the classes
            require_once($component);
            $classname = str_replace(".php","",basename($component));
            $reflection = new ReflectionClass($classname);
            //the first pid in every example must be named "example"
            $panel = $reflection->newInstance("componentExample");
            $rendered = $panel->render(new MarkupParser(MarkupParser::getMarkupNameFromScript($panel->getPackage())));
            echo $rendered;
        }
    }
}
