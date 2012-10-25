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
 *
 */
//code start
class BehaviorExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        $container = new WebMarkupContainer("container", new EmptyModel());
        $form = new Form("form", new EmptyModel());
        $name = new TextField("name", new SimpleModel("gerhard"));
        /*
         * Behaviors can be attached to any component.
         * */
        $name->addBehavior(new StyleBehavior());
        $form->add($name);
        $container->add($form);
        $this->add($container);
    }
}

/*
 * Just implement Behavior or extend BehaviorAdapter.
 * You got all LifeCycle-Callbacks and can attach attributes, new styles,
 * change component, whatever you like.
 * HeaderContributor for example is nothing more than Behavior.
 * */
class StyleBehavior extends BehaviorAdapter {

    public function onBeforeRender(MarkupParser $markupParser)
    {
        parent::onBeforeRender($markupParser);
        $component = $this->getComponent();
        $modelValue = $component->getModel()->getValue();
        if($modelValue === 'hans'){
            $component->addAttributes(array("style"=>"font-family:garamond;color:red;font-size:25px"));
        }
    }

}
//code end