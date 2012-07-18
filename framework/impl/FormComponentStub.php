<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 11:11
 * To change this template use File | Settings | File Templates.
 */
abstract class FormComponentStub extends ComponentStub implements FormComponent
{

    private $validators;
    private $errors;
    private $submitCallback;

    public function FormComponentStub($id, $model){
        $this->ComponentStub($id,$model);
        $this->addAttributes(array("name"=>$this->getId()));
        if($this->getType() != null){
            $this->addAttributes(array("type"=>$this->getType()));
        }
        $this->validators = array();
        $this->errors = array();
        $this->submitCallback = function($value){};
    }

    public function getValidators(){
        return $this->validators;
    }

    public function addValidator($validator){
        array_push($this->validators,$validator);
    }

    public function onValidate($value)
    {
        foreach($this->getValidators() as $validator){
            $validator->validate($this,$value);
        }
    }

    public function onUpdateModel($value){
        $this->getModel()->setValue($value);
    }

    public function onSubmit(){
       call_user_func($this->submitCallback,$this->getModel()->getValue());
    }

    public function onDetach(){
    }

    public function hasErrors(){
        return count($this->errors) > 0;
    }

    public function error($message){
        array_push($this->errors,$message);
    }

    public function setSubmitCallback($function)
    {
        $this->submitCallback = $function;
    }



}
