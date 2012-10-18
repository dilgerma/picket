<?php
include_once(__DIR__.'/../../BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 17.10.12
 * Time: 17:28
 * To change this template use File | Settings | File Templates.
 */
class CSSWebResourceTest  extends BaseTestCase
{
     public function testRender(){
         $resource = new CSSWebResource("/styles/style.css","blubb");
         $content = $resource->render();
         $this->assertEquals("\n<link href=\"/styles/style.css\" rel=\"stylesheet\">\n",$content);
     }
}
