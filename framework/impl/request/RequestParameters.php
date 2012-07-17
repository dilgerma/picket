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


    /**
     * returns all parameters (Get+Post) as a key value map
     */
    public function getAllParameters(){
        $parameters = array();
        $parameters = array_merge($_POST,$parameters);
        $parameters = array_merge($_GET,$parameters);
        return $parameters;
    }

    public function getSubmittingComponent(){
        $parameters = $this->getAllParameters();
        return $parameters[FormCallBackUri::SUBMITTING_COMPONENT];
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
            return $parameters[$component->getId()];
        }
        return null;
    }
}
