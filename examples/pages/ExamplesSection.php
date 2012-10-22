<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 09:46
 * To change this template use File | Settings | File Templates.
 */
class ExamplesSection extends Panel
{
    public function __construct($id, IModel $model, IModel $headerModel){
        parent::Panel($id,$model);
        $this->add(new Label("header",$headerModel));
        $this->add(new ComponentListView("example-list", new ExamplePanelListModel($model->getValue())));
    }
}


class ComponentListView extends ListView {


    public function populateItem($markupId, IModel $listItem, $markupIdSuffix)
    {
        $container = new WebMarkupContainer($markupId,$listItem);
        $componentNameModel = new SimpleModel(str_replace("ExamplePanel.php","",basename($listItem->getValue())));
        //builds a link that redirects to the examples page
        $link = new Link(ListView::concatenateId("link",$markupIdSuffix),new SimpleModel("/framework/examples/pages/ExamplesPage.php?".ExamplesPage::example_component_param."=".$componentNameModel->getValue())
            ,$componentNameModel);
        $container->add($link);
        $this->add($container);
    }
}

class ExamplePanelListModel implements IModel {

    private $basePath;

    public function __construct($basePath){
        $this->basePath = $basePath;
    }


    public function getValue()
    {
        return Files::listFilesInFolder($this->basePath,"ExamplePanel.php");
    }

    public function setValue($value)
    {
        // TODO: Implement setValue() method.
    }
}