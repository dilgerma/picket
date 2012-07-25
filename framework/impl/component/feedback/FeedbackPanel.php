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
    public function FeedbackPanel($id, $component){
       $this->ListView($id,new FeedbackMessagesModel($component));
       $this->log->info("Instantiating FeedbackPanel, bindet to ".$component->getId());
    }

    public function populateItem($markupId, $value)
    {
         $this->add(new Label($markupId,new PropertyModel($value, "message")));
    }

}
