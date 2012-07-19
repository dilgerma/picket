
<?php include_once(__DIR__.'/BaseTestCase.php');
require_once __DIR__.'/container/SimpleTestPanel.php';
?>

?>
<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 21:08
 * To change this template use File | Settings | File Templates.
 */
class ComponentStubTest extends BaseTestCase
{

    public function testAppendAttribute(){
        $stub = new TestComponent("test", new SimpleModel(""));
        $stub->addAttributes(array("class"=>"test"));
        $attributes = $stub->getAttributes();
        $this->assertEquals("test",$attributes["class"]);

        $stub->appendAttribute(array("class"=>"test-2"));
        $attributes = $stub->getAttributes();
        $this->assertEquals("test test-2",$attributes["class"]);
    }
}

 class TestComponent extends ComponentStub{
    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        "test";
    }
}
