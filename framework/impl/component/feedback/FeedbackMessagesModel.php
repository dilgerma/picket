<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 15:01
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessagesModel implements IModel
{
    private $componentRoot;
    private $filter;

    public function FeedbackMessagesModel(ComponentStub $componentRoot, MessagesFilter $filter = null){
        $this->componentRoot = $componentRoot;
        $this->filter = is_null($filter) ? new DefaultMessageFilter() : $filter;
    }

    public function getValue()
    {
        $messages = array();
        foreach($this->componentRoot->fields() as $field){
           $messages =$this->addMessages($messages,$field->getFeedbackMessages()->getMessages($this->filter));
        }
        //and the root itself
        $messages = $this->addMessages($messages,$this->componentRoot->getFeedbackMessages()->getMessages($this->filter));
        return $messages;

    }

    public function setValue($value)
    {
        //noop
    }

    private function addMessages(&$messages,$compoentMessages){
        return array_merge($messages,$compoentMessages);
    }
}
