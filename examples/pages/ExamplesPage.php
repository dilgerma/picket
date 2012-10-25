<?php
/**
Copyright (c) 2012, Martin Dilger - EffectiveTrainings.de
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
 * Neither the name of the <organization> nor the
names of its contributors may be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL EffectiveTrainings BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


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
       $this->addBehavior(new HeaderContributor(new CSSPackageWebResource("../bootstrap",$this,"bootstrap")));
       $this->add(new ExamplesNavigationPanel("examplesNavigation",new EmptyModel()));
       $testedComponent = $this->getTestedComponent();
       if(!is_null($testedComponent) && $testedComponent!==""){
           $this->add(new ExamplesContainer("example",$this->getTestPanelForComponent($testedComponent),$testedComponent));
       }
   }

    private function getTestPanelForComponent($component){
        $files = Files::listFilesInFolder(__DIR__."/../sections/","ExamplePanel.php");
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
