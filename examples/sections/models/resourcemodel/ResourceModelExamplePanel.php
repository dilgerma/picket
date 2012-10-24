<?php
/**
 *
 */
        //code start
class ResourceModelExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        $this->add(new Label("componentExample", new ResourceModel("theKey",$this)));
    }
}
/*
 * this is the class that needs to be in the same package
 *
class ResourceModelExamplePanel_resource
{
    const theKey = "here you are!";
}
*/
//code end


