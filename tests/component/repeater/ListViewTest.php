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
       $testListView = new TestListView();
       $rendered = $testListView->render(new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__)));
       $fields = $testListView->fields();
       $this->assertEquals(3,count($fields));

       foreach($fields as $key=>$field){
           $this->assertEquals($testListView->getId()."-child:".$key,$field->getId());
       }

        $matcher = array('tag'=>'div','descendant'=>array('tag'=>'input','attributes'=>array('name'=>'list-child:0')));
        $this->assertTag($matcher,$rendered);
        $matcher = array('tag'=>'div','descendant'=>array('tag'=>'input','attributes'=>array('name'=>'list-child:1')));
        $this->assertTag($matcher,$rendered);
        $matcher = array('tag'=>'div','descendant'=>array('tag'=>'input','attributes'=>array('name'=>'list-child:2')));
        $this->assertTag($matcher,$rendered);
    }
}

class TestListView extends ListView {

    public function TestListView(){
        $this->ListView("list", new SimpleModel(array("hans","ist","toll")),$this->getComponentFile());
    }

    public function populateItem($markupId,IModel $listItem, $markupIdSuffix)
    {
        $this->add(new TextField($markupId,$listItem));
    }

    public function getMarkupFile()
    {
        $filename = $this->getComponentFile();
        $markup = MarkupParser::getMarkupNameFromScript($filename);
        return $markup;
    }


}
?>

