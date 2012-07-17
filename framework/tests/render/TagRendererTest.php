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
        $this->tag = new TagForTest();
        $this->tagRenderer = new TagRenderer($this->tag);
    }

    function tearDown(){
        unset($this->tag);
        unset($this->tagRenderer);
    }

    public function testRenderTag(){
        $renderer = $this->tagRenderer->renderOpenTag();
        $this->assertEquals($renderer,"<test-tag id='test-id' action='test-action' >");
        $this->assertEquals($this->tagRenderer->renderCloseTag(),"</test-tag>");
    }


}

class TagForTest implements Tag  {


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
