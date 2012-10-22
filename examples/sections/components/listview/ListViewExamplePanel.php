<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 10:42
 * To change this template use File | Settings | File Templates.
 */
//code start
class ListViewExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        $this->add(new ExampleListView("componentExample",new SimpleModel(array("numero 1", "numero 2", "numero3"))));
    }
}

class ExampleListView extends ListView {

    public function populateItem($markupId, IModel $listItem, $markupIdSuffix)
    {
        $this->add(new Label($markupId,$listItem));
    }
}
//code end
