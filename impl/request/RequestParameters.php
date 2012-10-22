<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:36
 * To change this template use File | Settings | File Templates.
 */
class RequestParameters
{

    private $parameters = array();

    public function __construct(){
        $this->parameters = array_merge($_POST,$this->parameters);
        $this->parameters = array_merge($_GET,$this->parameters);
    }

    /**
     * returns all parameters (Get+Post) as a key value map
     */
    public function getAllParameters(){
       return $this->parameters;
    }

    public function getSubmittingComponent(){
        return $this->getNamedParameter(FormCallBackUri::SUBMITTING_COMPONENT);
    }

    public function getNamedParameter($name){
        $parameters = $this->getAllParameters();
        if(array_key_exists($name,$parameters)){
            return $parameters[$name];
        }
        return "";
    }

    public function isSubmit(){
        $parameters = $this->getAllParameters();
        return array_key_exists(FormCallBackUri::LISTENER,$parameters) &&
            $parameters[FormCallBackUri::LISTENER] ==
                FormCallBackUri::SUBMIT_LISTENER_SEPARATOR;
    }

    public function isSubmitFor($component){
        if($this->isSubmit()){
            $id = $this->getSubmittingComponent();
            return $component->getId() == $id;
        }
        return false;
    }

    public function getSubmittedValueFor($component){
        $parameters = $this->getAllParameters();
        if(array_key_exists($component->getId(),$parameters)) {
            return $this->getNamedParameter($component->getId());
        }
        return null;
    }
}
