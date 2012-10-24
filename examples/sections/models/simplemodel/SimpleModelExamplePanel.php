<?php
/**
 *
 */
class SimpleModelExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        //code start
        $this->add(new Label("componentExample", new SimpleModel("A simple Model has only getValue and setValue Methods")));
        //code end
    }
}
