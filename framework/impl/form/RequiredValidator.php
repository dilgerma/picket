<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 16.07.12
 * Time: 18:30
 * To change this template use File | Settings | File Templates.
 */
class RequiredValidator implements Validator
{

    public function validate(ComponentStub $component, $value)
    {

       if($value === ''){
           $component->getFeedbackMessages()->addMessage(new FeedbackMessage("Dies ist ein Pflichtfeld", Level::ERROR));
       }
    }
}
