<?php
include_once __DIR__ . '/../BaseTestCase.php';
require_once __DIR__.'/../container/SimpleTestPanel.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 04.08.12
 * Time: 11:09
 * To change this template use File | Settings | File Templates.
 */
class ImageTest extends BaseTestCase
{
      public function testRender(){
          $image = new Image("test",new SimpleModel("test/image.png"));
          $rendered = $image->render(new SimpleTestMarkupParser("SimpleMarkupTestFile.html"));
          $matcher = array("tag"=>"img","attributes"=>array("pid"=>"test","src"=>"test/image.png"));
          $this->assertTag($matcher,$rendered);
      }
}
