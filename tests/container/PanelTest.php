<?php
include_once __DIR__ . '/../BaseTestCase.php';
require_once __DIR__.'/SimpleTestPanel.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 21:36
 * To change this template use File | Settings | File Templates.
 */
class PanelTest extends BaseTestCase
{

    private $markupParser;

    public function setUp()
    {
        $this->markupParser = new MarkupParser(__DIR__."/Page.html");
    }


    public function testMarkupIsLoaded(){
       $panel = new SimpleTestPanel("test",new SimpleModel(""));
       $content = $panel->render($this->markupParser);
       $matcher = array('tag'=>'div','descendant'=>array('tag'=>'input','attributes'=>array('value'=>'blubb')));
        $this->assertTag($matcher,$content);
    }


}
