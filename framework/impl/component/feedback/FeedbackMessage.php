<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 15:07
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessage
{

    private $message;
    private $level;

    public function FeedbackMessage($message, $level)
    {
        $this->message = $message;
        $this->level = $level;
    }

    public function is($level){
        return $this->level == $level;
    }

    public function getMessage(){
        return $this->message;
    }

    public function __toString(){
        return "Message : ".$this->message.", ".$this->level;
    }
}
