<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 09:20
 * To change this template use File | Settings | File Templates.
 */
class SimpleTestPanel extends Panel
{
   public function SimpleTestPanel(){
       $this->Panel("testObject", new SimpleModel(""));
       $this->add(new FeedbackPanel("feedback",$this));
       $this->error("Fehler passiert");
   }
}
