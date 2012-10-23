<?php include_once(__DIR__.'/BaseTestCase.php');
require_once(__DIR__.'/SimpleTestMarkupParser.php');


/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class DropDownTest extends BaseTestCase
{
     private $markupParser;

    public function setUp(){
        $this->markupParser = new SimpleTestMarkupParser("SimpleMarkupTestFile.html");
    }

    public function testRenderWithoutOptions(){
        $dropdown = new DropDown("test", new SimpleModel("test-data"));
        $dropdown->addAttributes(array("required"=>"required"));
        $rendered = $dropdown->render($this->markupParser);
        $matcher = array("tag"=>"select","attributes"=>array("name"=>"test","required"=>"required"));
        $this->assertTag($matcher,$rendered);
    }

    public function testRender(){
        $dropdown = new DropDown("test",new SimpleModel("test-data"));
        $dropdown->add(new DropDownOption("option-1",new SimpleModel("option-1"),$dropdown->getModel()));
        $dropdown->add(new DropDownOption("option-2",new SimpleModel("option-2"),$dropdown->getModel()));
        $rendered = $dropdown->render($this->markupParser);

        $matcher = array("tag"=>"select","attributes"=>array("name"=>"test"));
        $this->assertTag($matcher,$rendered);

        $matcherWithOption = array("tag"=>"select","descendant"=>array("tag"=>"option","attributes"=>array("name"=>"option-1","value"=>"option-1")));
        $this->assertTag($matcherWithOption,$rendered);
    }

    public function testCreateWithOptions(){
        $dropDown = DropDown::createWithOptions("test",new SimpleModel("test-data"),array("option-1","option-2"));
        $rendered = $dropDown->render($this->markupParser);
        $fields = $dropDown->fields();
        $this->assertEquals("test:0",$fields[0]->getId());
        $this->assertEquals("test:1",$fields[1]->getId());
    }

}

