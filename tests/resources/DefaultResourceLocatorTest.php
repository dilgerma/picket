<?php include_once(__DIR__.'/../BaseTestCase.php');
require_once("SimpleResourceTestLabel.php");
?>

<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 02.08.12
 * Time: 19:20
 * To change this template use File | Settings | File Templates.
 */
class DefaultResourceLocatorTest extends BaseTestCase
{
   public function testLoadResource(){
       $simpleTestLabel = new SimpleResourceTestLabel("test",new SimpleModel(""));
       $resourceModel = new ResourceModel("my_resource_key",$simpleTestLabel);
       $this->assertEquals("my_resource",$resourceModel->getValue());
   }

}
