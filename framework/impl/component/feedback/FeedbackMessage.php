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
    private $component;

    public function FeedbackMessage($message, $level,$component = null)
    {
        $this->message = $message;
        $this->level = $level;
        $this->component = $component;
    }

    public function is($level){
        return $this->level == $level;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getComponent(){
        return $this->component;
    }

    public function __toString(){
        return "Message : ".$this->message.", ".$this->level.", ".$this->component;
    }
}
