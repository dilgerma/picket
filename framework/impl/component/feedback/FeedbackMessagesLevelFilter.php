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

    public function FeedbackMessagesLevelFilter($level){
        $this->level = $level;
    }

    public function accepts(FeedbackMessage $message)
    {
        return $message->is($this->level);
    }
}
