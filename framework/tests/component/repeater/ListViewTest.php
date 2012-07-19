<?php
include_once __DIR__ . '/../../BaseTestCase.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 18.07.12
 * Time: 15:57
 * To change this template use File | Settings | File Templates.
 */
class ListViewTest extends BaseTestCase
{
    public function testRenderListView(){
       fail("not yet implemented");
    }
}

class TestListView extends ListView {

    public function TestListView(){
        $this->ListView("list", new SimpleModel(array("1","2","3")),$this->getPackage());
    }

    public function populateItem($markupId,$listItem)
    {
        $this->add(new TextField($markupId,new SimpleModel($listItem)));
    }
}
?>

