<?php

/**
 *
 * A typical URI looks like this:
 *
 * /script.php?listener=form-submit&sc=<component-id>
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:13
 * To change this template use File | Settings | File Templates.
 */
class FormCallBackUri
{

    private $component;

    public function FormCallBackUri($component){
        $this->component = $component;
    }

   public function getScriptName(){
       return basename($_SERVER['PHP_SELF']);;
   }

    public function getCallbackURI(){
        $callback=$this->getScriptName()."?".FormCallBackUri::LISTENER."=".FormCallBackUri::SUBMIT_LISTENER_SEPARATOR."&".
            FormCallBackUri::SUBMITTING_COMPONENT."=".$this->component->getId();
        return $callback;
    }

    /**
     * separator that indicates that a form submit needs to happen
     */
    const SUBMIT_LISTENER_SEPARATOR = "form-submit";
    const SUBMITTING_COMPONENT = "sc";
    const LISTENER = "listener";
}
