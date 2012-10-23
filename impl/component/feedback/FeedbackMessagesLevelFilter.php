<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 15:13
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessagesLevelFilter implements MessagesFilter
{

     private $level;

    public function FeedbackMessagesLevelFilter($level = null){
        $this->level = $level;
    }

    public function accepts(FeedbackMessage $message)
    {
        if(is_null($this->level)){
            return true;
        }
        return $message->is($this->level);
    }
}
