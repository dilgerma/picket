<?php
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


}
