<?php
include_once __DIR__ . '/../BaseTestCase.php';
require_once __DIR__.'/../container/SimpleTestPanel.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 22.07.12
 * Time: 09:41
 * To change this template use File | Settings | File Templates.
 */
class WebPageTest extends BaseTestCase
{
      public function testRenderWebPage(){
          $testWebPage = new TestWebPage();

          $label  =new Label("test-id",new SimpleModel("rendered-label"));
          $testWebPage->add($label);
          $content = $testWebPage->getTagRenderer()->render($testWebPage->getMarkupParser());

          $matcher = array('tag' => 'div', 'content'=>'rendered-label');
          $this->assertTag($matcher,$content);

          //assert body is rendered
          $matcher = array('tag'=>'body');
          $this->assertTag($matcher,$content);

          //assert head is rendered
          $matcher = array('tag'=>'head');
          $this->assertTag($matcher,$content);
      }

    public function testRenderWebPageWithContainer(){
        $testWebPage = new TestWebPage();

        $label  = new SimpleTestPanel();
        $testWebPage->add($label);
        $content = $testWebPage->getTagRenderer()->render($testWebPage->getMarkupParser());

        $matcher = array('tag'=>'div','id'=>'test-id','descendant'=>array('tag'=>'input','attributes'=>array('type'=>'text','value'=>'blubb')));
        $this->assertTag($matcher,$content);
    }
}

class TestWebPage extends WebPage {

}