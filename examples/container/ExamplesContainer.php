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
 * Time: 10:18
 * To change this template use File | Settings | File Templates.
 */
class ExamplesContainer extends Panel
{
    const example_markup_id = "live-example";
    /**
     *
     * @var ComponentStub
     */
    private $exampleComponent;

    /*
     * The simple Name of the example class, for example 'Label'
     * */
    private $nameOfExampleClass;

   public function __construct($id,ComponentStub $exampleComponent,$nameOfExampleClass){
       parent::Panel($id, new EmptyModel());
       $this->exampleComponent = $exampleComponent;
       $this->nameOfExampleClass = $nameOfExampleClass;
       $this->add(new Label("markup",$this->getExampleMarkupModel()));
       $this->add(new Label("code",$this->getExampleMarkupCodeModel()));
       $this->add(new Label("description",$this->getDescriptionModel()));
       $this->add(new Label("sourceCode",$this->getSourceCodeModel()));
       $this->add($this->exampleComponent);
   }

    /**
     * @abstract
     * @return IModel the path of a markupfile that is to be displayed in the markup section, may return null, then the whole markup section will be invisible.
     */
    protected function getExampleMarkupModel(){
        return new EscapingMarkupModel(MarkupParser::getMarkupNameFromScript($this->exampleComponent->getComponentFile()));
    }

    /**
     * Returns the Code to be displayed.
     * @abstract
     * @return mixed
     */
    protected function getExampleMarkupCodeModel(){
        return new EscapingCodeModel($this->exampleComponent->getComponentFile());
    }

    protected function getDescriptionModel(){
        return new EscapingDescriptionModel($this->nameOfExampleClass);
    }

    protected function getSourceCodeModel(){
        $reflectionClass = new ReflectionClass($this->nameOfExampleClass);
        return new EscapingFileSourceModel($reflectionClass->getFileName());
    }

}
