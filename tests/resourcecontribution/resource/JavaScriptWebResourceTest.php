<?php
include_once(__DIR__.'/../../BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 17.10.12
 * Time: 17:28
 * To change this template use File | Settings | File Templates.
 */
class JavaScriptWebResourceTest  extends BaseTestCase
{
     public function testRender(){
         $resource = new JavaScriptWebResource("/scripts/script.js");
         $content = $resource->render();
         $this->assertEquals("<script language='JavaScript' type='text/javascript' src='/scripts/script.js' />\n",$content);
     }
}
