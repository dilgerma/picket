
<?php include_once(__DIR__.'/BaseTestCase.php');
require_once __DIR__.'/container/SimpleTestPanel.php';
require_once __DIR__.'/util/MarkupTester.php';

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

    public function testVisibility(){
        $component = new Label("test", new SimpleModel("test-value"));
        $markupParser = new SimpleTestMarkupParser("SimpleMarkupTestFile.html");
        $component->render($markupParser);

        $matcher = array("tag"=>"div","content"=>"test-value");
        $this->assertTag($matcher,$markupParser->getDocument()->html());

        $component->setVisible(false);
        $markupParser = new SimpleTestMarkupParser("SimpleMarkupTestFile.html");
        $component->render($markupParser);

        $this->assertEquals(trim($markupParser->getDocument()->html()),"");
    }

    public function testNoModelForcesModelOfParent(){
        $container = new WebMarkupContainer("parent",new SimpleModel("Im a parent"));
        $label = new Label("child");
        $container->add($label);
        $rendered = $container->render(new SimpleTestMarkupParser("ParentChildTest.html"));
        $tester = new MarkupTester($rendered,false);
        $tester->tagExists("div")->tagExists("div")->attributeEquals("pid","child")->nodeValue("Im a parent");
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
