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
 * User: dilgerma
 * Date: 15.07.12
 * Time: 17:00
 * To change this template use File | Settings | File Templates.
 */
class SimpleRequestCycle implements RequestCycle
{

    private $renderCallback;
    private $initializeCallback;
    private $beforeRenderCallback;
    private $afterRenderCallback;
    private $markupTagCallback;
    private $detachCallback;

    private $component;

    public function SimpleRequestCycle($component){
        $this->renderCallback = function(){};
        $this->initializeCallback = function(){};
        $this->beforeRenderCallback = function(){};
        $this->afterRenderCallback = function(){};
        $this->markupTagCallback = function(){};
        $this->detachCallback = function(){};

        $this->component = $component;
    }

    public final function onRender(MarkupParser $markupParser)
    {
        call_user_func($this->renderCallback,$this->component);
        $this->component->onRender($markupParser);
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onRender($markupParser);
        }
    }

    public final function onBeforeRender(MarkupParser $markupParser)
    {

        call_user_func($this->beforeRenderCallback, $this->component);
        $this->component->onBeforeRender($markupParser);
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onBeforeRender($markupParser);
        }
    }

    public final function onAfterRender(MarkupParser $markupParser){
        call_user_func($this->afterRenderCallback, $this->component);
        $this->component->onAfterRender($markupParser);
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onAfterRender($markupParser);
        }
    }

    public final function onMarkupTag(MarkupParser $markupParser){
        call_user_func($this->markupTagCallback,$this->component);
        $this->component->onMarkupTag($markupParser);
        $behaviors = $this->component->getBehaviors();
        foreach($behaviors as $behavior){
            $behavior->onMarkupTag($markupParser);
        }
    }

    public final function onInitialize(){
        call_user_func($this->initializeCallback, $this->component);
        $this->component->onInitialize();
    }

    public function onDetach()
    {
        call_user_func($this->detachCallback, $this->component);
        $this->component->onDetach();
    }

    /**
     * @param $lifecyclePhase a phase as defined in this interface.
     * @param $function the callback functino that may take a component as parameter
     * @return mixed
     */
    public function setCallback($lifecyclePhase, $function)
    {
        switch($lifecyclePhase){
            case RequestCycle::ON_INITIALIZE: $this->initializeCallback = $function;break;
            case RequestCycle::ON_MARKUP: $this->markupTagCallback = $function;break;
            case RequestCycle::ON_BEFORE_RENDER: $this->beforeRenderCallback = $function;break;
            case RequestCycle::ON_RENDER: $this->renderCallback = $function;break;
            case RequestCycle::ON_AFTER_RENDER: $this->afterRenderCallback = $function;break;
            case RequestCycle::ON_DETACH: $this->detachCallback = $function;break;
        }
    }
}
