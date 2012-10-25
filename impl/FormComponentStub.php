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
 * Time: 11:11
 * To change this template use File | Settings | File Templates.
 */
abstract class FormComponentStub extends ComponentStub implements FormComponent,FormLifeCycle
{

    private $validators;
    private $submitCallback;

    /**
     * this is the raw value from the get- or post parameters.
     * @var
     */
    private $rawInput;

    public function FormComponentStub($id, $model, $label=""){
        $this->ComponentStub($id,$model,$label);
        $this->validators = array();
        $this->submitCallback = function($value){};
        $this->initFormComponent();
    }

    protected function initFormComponent(){
        $this->addAttributes(array("name"=>$this->getId()));
        if($this->getType() != null){
            $this->addAttributes(array("type"=>$this->getType()));
        }
    }

    public function getValidators(){
        return $this->validators;
    }

    public function addValidator($validator){
        array_push($this->validators,$validator);
    }

    public function onValidate($value)
    {
        //required validations are done first
        $this->onValidateRequired($value);
        //if this already fails, do nothing more
        //we do not want required- and for example email-adress errors displayed at once.
        if($this->hasErrors()){
            return;
        }
        //do all other validations
        foreach($this->getValidators() as $validator){
            $validator->validate($this,$value);
        }
    }

    protected function onValidateRequired($value){
        foreach($this->getRequiredValidators() as $validator){
            $validator->validate($this,$value);
        }
    }

    private function getRequiredValidators(){
        return array_filter($this->getValidators(), function($validator){
            if($validator instanceof RequiredValidator){
                return true;
            }
            return false;
        });

    }

    public function onUpdateModel($value){
        $this->getModel()->setValue($value);
    }

    public function onSubmit(){
       call_user_func($this->submitCallback,$this->getModel()->getValue());
    }

    public function setSubmitCallback($function)
    {
        $this->submitCallback = $function;
    }

    public function hasErrors()
    {
        $messages = $this->getFeedbackMessages()->getMessages(new FeedbackMessagesLevelFilter(Level::ERROR));
        return count($messages) > 0;
    }

    /**
     * retrieves the raw input from get- or post parameters
     * @return mixed
     */
    public function getRawInput(){
        return $this->rawInput;
    }

    /**
     * sets the raw input
     * @param $value
     */
    public function setRawInput($value){
        $this->rawInput = $value;
    }



}
