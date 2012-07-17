<?php include_once(__DIR__.'/BaseTestCase.php');?>

<?php


/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class DropDownTest extends BaseTestCase
{


    public function testRenderWithoutOptions(){
        $dropdown = new DropDown("test-od", new SimpleModel("test-data"));
        $dropdown->addAttributes(array("required"=>"required"));
        $rendered = $dropdown->renderTag();
        $this->assertEquals("<select name='test-od' required='required' ></select>",$rendered);
    }

    public function testRender(){
        $dropdown = new DropDown("test-id",new SimpleModel("test-data"));
        $dropdown->add(new DropDownOption("option-1",new SimpleModel("option-1"),$dropdown->getModel()));
        $dropdown->add(new DropDownOption("option-2",new SimpleModel("option-2"),$dropdown->getModel()));
        $rendered = $dropdown->renderTag();
        $this->assertEquals("<select name='test-id' ><option name='option-1' value='option-1' >option-1</option><br/><option name='option-2' value='option-2' >option-2</option><br/></select>",$rendered);
    }

    public function testCreateWithOptions(){
        $dropDown = DropDown::createWithOptions("test-id",new SimpleModel("test-data"),array("option-1","option-2"));
        $rendered = $dropDown->renderTag();
        $fields = $dropDown->fields();
        $this->assertEquals("test-id:0",$fields[0]->getId());
        $this->assertEquals("test-id:1",$fields[1]->getId());
    }

}

