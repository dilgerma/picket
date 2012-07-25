<?php include_once(__DIR__.'/BaseTestCase.php');

require_once(__DIR__.'/SimpleTestMarkupParser.php');
?>


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
        $markupParser = new SimpleTestMarkupParser("SimpleMarkupTestFile.html");
        $textarea = new TextArea("test",new SimpleModel("Test-Value"));
        $rendered = $textarea->render($markupParser);
        $matcher = array("tag"=>"textarea","attributes"=>array("name"=>$textarea->getId()),"content"=>"Test-Value");
        $this->assertTag($matcher,$rendered);
    }

}

