<?php
require_once("../../Autoloader.php");
require_once("ExamplesNavigationPanel.php");
require_once(__DIR__."/../container/ExamplesContainer.php");
require_once(__DIR__."/../container/EscapingCodeModel.php");
require_once(__DIR__."/../container/EscapingMarkupModel.php");
require_once(__DIR__."/../container/EscapingFileSourceModel.php");
require_once(__DIR__."/../container/EscapingDescriptionModel.php");
require_once(__DIR__ . "/../sections/components/listview/ListViewExamplePanel.php");
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 09:22
 * To change this template use File | Settings | File Templates.
 */
class ExamplesPage extends WebPage
{
   public function __construct($id,IModel $model){
       parent::WebPage($id,$model);
       $this->addBehavior(new HeaderContributor(new CSSPackageWebResource("../bootstrap","bootstrap")));
       $this->add(new ExamplesNavigationPanel("examplesNavigation",new EmptyModel()));
       $this->add(new ExamplesContainer("example",new ListViewExamplePanel(ExamplesContainer::example_markup_id),"ListView"));
   }
}

$page = new ExamplesPage("examples", new EmptyModel());
$page->renderDirectly();
