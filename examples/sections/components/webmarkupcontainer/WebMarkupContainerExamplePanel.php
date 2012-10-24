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
        $webmarkupContainer = new WebMarkupContainer("componentExample", new SimpleModel(new LabelModel("Label access this only via its component id")));
        $webmarkupContainer->addAttributes(array("style"=>"border:1px solid red"));
        //the label has no model of its own, so it will take the one of its parent and will call "getLabel" internally --> compoundpropertymodel style
        $webmarkupContainer->add(new Label("label"));
        $this->add($webmarkupContainer);
        //code end
    }
}

class LabelModel {

    private $label;

    public function __construct($value){
        $this->label = $value;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function getLabel()
    {
        return $this->label;
    }
}
