<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 20.07.12
 * Time: 14:09
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessagesCollector implements IVisitor
{
    private $filter;
    private $messages = array();
    private $log;

    public function FeedbackMessagesCollector(MessagesFilter $filter){
        $this->filter = $filter;
        $this->log = Logger::getLogger("Component");;
    }

    public function visit(ComponentStub $component)
    {
        $this->log->debug("visiting ".$component->getId());
        $collected = $component->getFeedbackMessages()->getMessages($this->filter);
        $this->messages =  array_merge($this->messages,$collected);
    }

    public function getNumberOfMessages(){
        return count($this->messages);
    }

    public function hasMessages(){
        return $this->getNumberOfMessages()>0;
    }

    public function getMessages(){
        return $this->messages;
    }
}
