<?php
require_once("../../Autoloader.php");
require_once("ExamplesNavigationPanel.php");
require_once(__DIR__."/../container/ExamplesContainer.php");
require_once(__DIR__."/../container/EscapingCodeModel.php");
require_once(__DIR__."/../container/EscapingMarkupModel.php");
require_once(__DIR__."/../container/EscapingFileSourceModel.php");
require_once(__DIR__."/../container/EscapingDescriptionModel.php");
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 09:22
 * To change this template use File | Settings | File Templates.
 */
class ExamplesPage extends WebPage
{
   const example_component_param = "exampleComponentName";

   public function __construct($id,IModel $model){
       parent::WebPage($id,$model);
       $this->addBehavior(new HeaderContributor(new CSSPackageWebResource("../bootstrap","bootstrap")));
       $this->add(new ExamplesNavigationPanel("examplesNavigation",new EmptyModel()));
       $testedComponent = $this->getTestedComponent();
       if(!is_null($testedComponent) && $testedComponent!==""){
           $this->add(new ExamplesContainer("example",$this->getTestPanelForComponent($testedComponent),$testedComponent));
       }
   }

    private function getTestPanelForComponent($component){
        $files = Files::listFilesInFolder(__DIR__."/../sections/components","ExamplePanel.php");
        foreach($files as $file){
            require_once($file);
            if(strpos(strtolower(basename($file)),strtolower($component)) !== false){
                $baseClassName = str_replace(".php","",basename($file));
                $reflectionClass = new ReflectionClass($baseClassName);
                return $reflectionClass->newInstance(ExamplesContainer::example_markup_id);
            }
        }
        throw new Exception("There is an error in class-naming in the Examples Section. Remember - all class names must be names <componentUnderTest>ExamplePanel");
    }

    private function getTestedComponent(){
        $parameters = Configuration::getConfigurationInstance()->requestParameterProvider()->newRequestParameters();
        $param = $parameters->getNamedParameter(ExamplesPage::example_component_param);
        return $param;
    }
}

$page = new ExamplesPage("examples", new EmptyModel());
$page->renderDirectly();
