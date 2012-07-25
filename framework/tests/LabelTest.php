<?php
include_once(__DIR__.'/BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 20.07.12
 * Time: 11:16
 * To change this template use File | Settings | File Templates.
 */
class LabelTest extends BaseTestCase
{


    public function testRender(){
        $markupParser = new SimpleTestMarkupParser("SimpleMarkupTestFile.html");
        $label = new Label("test", new SimpleModel("test-label-with-markup"));
        $label->addAttributes(array("class"=>"blubb"));


        $rendered = $label->render($markupParser);
        /*
         * check that we have a div in a div in a div with the correct classes
         * */
        $matcher = array("tag"=>"div", 'attributes'=>array("class"=>"blubb"));
        $this->assertTag($matcher,$rendered);
    }
}
