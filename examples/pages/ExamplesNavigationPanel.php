<?php
require_once("ExamplesSection.php");
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 09:38
 * To change this template use File | Settings | File Templates.
 */
class ExamplesNavigationPanel extends Panel
{
    public function __construct($id, IModel $model){
        parent::Panel($id,$model);
        $this->add(new NavigationListView("navi", new SectionsModel()));
    }
}

class NavigationListView extends ListView {


    public function populateItem($markupId, IModel $listItem, $markupIdSuffix)
    {
        $this->add(new ExamplesSection($markupId,$listItem,new SimpleModel(basename($listItem->getValue()))));
    }
}

/**
 * Lists all the subfolders in "../sections"
 */
class SectionsModel implements IModel {

    public function getValue()
    {
        return Files::listDirectoriesInFolder(__DIR__."/../sections", true);
    }

    public function setValue($value)
    {
        // TODO: Implement setValue() method.
    }
}