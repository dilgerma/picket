<?php
include_once __DIR__.'/../BaseTestCase.php';

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 08:45
 * To change this template use File | Settings | File Templates.
 */
class TagRendererTest extends BaseTestCase
{
    private $tag;
    private $tagRenderer;

    function setUp(){
        $this->tag = new TagForTest("test", new SimpleModel("test"));
        $this->tagRenderer = new TagRenderer($this->tag);
    }

    function tearDown(){
        unset($this->tag);
        unset($this->tagRenderer);
    }

    public function testRenderTag(){
        $renderer = $this->tagRenderer->renderOpenTag();
        $this->assertEquals("<test-tag id='test-id' action='test-action' >",$renderer);
        $this->assertEquals("</test-tag>",$this->tagRenderer->renderCloseTag());
    }

    public function testEscapeModelStrings(){
        $component = new Label("test", new SimpleModel("<script language='javascript'>alert('danger!')</script>"));
        $rendered = $component->render(new SimpleTestMarkupParser("SimpleMarkupTestFile.html"));
        $this->assertEquals("<div pid=\"test\">&lt;script language='javascript'&gt;alert('danger!')&lt;/script&gt;</div>",$rendered);

        $component = new Label("test", new SimpleModel("<script language='javascript'>alert('danger!')</script>"));
        $component->dontEscapeModelStrings();
        $rendered = $component->render(new SimpleTestMarkupParser("SimpleMarkupTestFile.html"));
        $this->assertEquals("<div pid=\"test\"><script language=\"javascript\">alert('danger!')</script></div>",$rendered);
    }


}

class TagForTest extends ComponentStub  {


    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "test-tag";
    }

    /**
     * Gets all the Attributes
     * @return mixed
     */
    public function getAttributes()
    {
        return array("id"=>"test-id","action"=>"test-action");
    }
}
?>
