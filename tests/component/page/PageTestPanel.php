<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 14:55
 * To change this template use File | Settings | File Templates.
 */
class PageTestPanel extends Panel
{
    public function PageTestPanel($id,$model){
        $this->Panel($id,$model);
        $this->add(new Label("panel-test-id",new SimpleModel("Panel gets rendered")));
    }
}
