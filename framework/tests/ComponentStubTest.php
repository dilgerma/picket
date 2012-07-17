
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

    public function testPackageForComponents(){
        $packageForTextField = new TextField("test",new SimpleModel(""));

        $packageForPanel = new SimpleTestPanel("panel", new SimpleModel(''));

       $this->assertNotSame($packageForTextField->getPackage(),$packageForPanel->getPackage());
    }
}
