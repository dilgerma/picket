<?php
include_once(__DIR__ . '/BaseTestCase.php');
require_once(__DIR__ . '/SimpleTestMarkupParser.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 20.10.12
 * Time: 10:21
 * To change this template use File | Settings | File Templates.
 */
class RadioGroupTest extends BaseTestCase
{
    public function testRadioButtonsMustOnlyBeAssignedToRadioGroups()
    {
        try {
            $container = new WebMarkupContainer("test", new SimpleModel(""));
            $container->add(new RadioButton("test-1", new SimpleModel("")));
        } catch (InvalidHierarchyException $e) {
            //expected
            echo $e->getMessage();
            return;
        }
        $this->fail("exception expected");
    }


    public function testRender()
    {
        $container = new RadioGroup("group", new SimpleModel(""));
        $container->add(new RadioButton("button1", new SimpleModel("")));
        $container->add(new RadioButton("button2", new SimpleModel("")));
        $rendered = $container->render(new SimpleTestMarkupParser("RadioGroupMarkup.html"));
        echo $rendered;
    }

    public function testSubmit(){}
}
