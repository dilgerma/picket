<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 09:20
 * To change this template use File | Settings | File Templates.
 */
class FeedbackTestPanel extends Panel
{
   public function FeedbackTestPanel(){
       $this->Panel("testObject", new SimpleModel(""));
       $this->add(new FeedbackPanel("feedback",$this));
       $this->error("Fehler passiert");
   }
}
