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
    private $componentBindedTo;

    public function FeedbackPanel($id, $component){
       $this->componentBindedTo = $component;
       $this->ListView($id,new FeedbackMessagesModel($this->componentBindedTo));
    }

    public function populateItem($markupId, $value)
    {
         $this->add(new TextField($markupId,new PropertyModel($value, "message")));
    }

    /*
     * Panels dont have markup, as they are rendered directly
     * to the dom-tree.
     * panel->render prints the whole markup out.
     */
    public function isWithoutMarkup()
    {
        return true;
    }


}
