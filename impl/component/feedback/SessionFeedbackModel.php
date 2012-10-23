<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 02.08.12
 * Time: 20:42
 * To change this template use File | Settings | File Templates.
 */
class SessionFeedbackModel implements IModel,MessagesModel
{

    public function getValue()
    {
        $session = Session::get();
        return $session->getFeedbackMessages()->getMessages(new FeedbackMessagesLevelFilter());
    }

    public function setValue($value)
    {
    }

    public function hasMessages()
    {
        return count($this->getValue())>0;
    }
}
