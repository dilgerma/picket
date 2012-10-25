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