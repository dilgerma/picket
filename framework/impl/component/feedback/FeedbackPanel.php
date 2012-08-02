<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 14:59
 * To change this template use File | Settings | File Templates.
 */
class FeedbackPanel extends ListView
{
    /**
     * @var FeedbackMessagesModel
     */
    private $feedbackModel;

    public function FeedbackPanel($id, $component){
       $this->feedbackModel =  new FeedbackMessagesModel($component);
       $this->ListView($id,$this->feedbackModel);
       $this->log->info("Instantiating FeedbackPanel, bindet to ".$component->getId());
    }

    public function populateItem($markupId, $value)
    {
         $this->add(new Label($markupId,new PropertyModel($value, "message")));
    }

    public function isVisible()
    {
        echo "check ".$this->feedbackModel->hasMessages();
        return $this->feedbackModel->hasMessages();
    }


}
