<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 04.08.12
 * Time: 15:28
 * To change this template use File | Settings | File Templates.
 */
class WebMarkupContainer extends ComponentStub
{
     public function WebMarkupContainer($id, IModel $model){
         $this->ComponentStub($id,$model);
         $this->setTagRenderer(new ContainerComponentRenderer($this));
     }
}
