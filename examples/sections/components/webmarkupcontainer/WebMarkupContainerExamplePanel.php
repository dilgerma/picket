<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 10:42
 * To change this template use File | Settings | File Templates.
 */
class WebMarkupContainerExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        //code start
        $webmarkupContainer = new WebMarkupContainer("componentExample", new SimpleModel("container model"));
        $webmarkupContainer->addAttributes(array("style"=>"border:1px solid red"));
        //the label has no model of its own, so it will take the one of its parent
        $webmarkupContainer->add(new Label("label"));
        $this->add($webmarkupContainer);
        //code end
    }
}
