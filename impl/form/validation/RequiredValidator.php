<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 16.07.12
 * Time: 18:30
 * To change this template use File | Settings | File Templates.
 */
class RequiredValidator extends  AbstractValidator
{

    const defautMsg = "Dies ist ein Pflichtfeld";

    public function validate(ComponentStub $component, $value)
    {

       if($value === ''){
           $msg = RequiredValidator::defautMsg;
           if($component->getLabel() !== ""){
               $msg = $component->getLabel()." ist ein Pflichtfeld";
           }
           $component->getFeedbackMessages()->addMessage(new FeedbackMessage($msg, Level::ERROR));
       }
    }
}
