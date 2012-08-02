<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 15:01
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessagesModel implements IModel, MessagesModel
{
    private $componentRoot;
    private $filter;
    private $log;

    public function FeedbackMessagesModel(ComponentStub $componentRoot, MessagesFilter $filter = null)
    {
        $this->componentRoot = $componentRoot;
        $this->filter = is_null($filter) ? new DefaultMessageFilter() : $filter;
        $this->log = Logger::getLogger("Model");
    }

    public function getValue()
    {

        $messagesCollector = new FeedbackMessagesCollector($this->filter);
        $this->componentRoot->visit($messagesCollector);
        return $messagesCollector->getMessages();
    }

    public function hasMessages(){
        return count($this->getValue())>0;
    }

    public function setValue($value)
    {
        //noop
    }

}
