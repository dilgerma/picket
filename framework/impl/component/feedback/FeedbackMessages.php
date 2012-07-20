<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 15:05
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessages {

    private $messages = array();

    public function getMessages(MessagesFilter $filter){
       return array_filter($this->messages,function ($var) use (&$filter){
            return $filter->accepts($var);
       });
    }

    public function getAllMessages(){
        return $this->getMessages(new DefaultMessageFilter());
    }

    public function addMessage(FeedbackMessage $message){
        array_push($this->messages,$message);
    }



}
