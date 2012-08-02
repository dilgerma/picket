<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 02.08.12
 * Time: 19:44
 * To change this template use File | Settings | File Templates.
 */
class ComponentNameLabel extends Label
{
    public function ComponentNameLabel($id, ComponentStub $resourceComponent, ComponentStub $nameComponent, $suffix = ""){
        $this->Label($id,new ResourceModel($nameComponent->getId().$suffix,$resourceComponent));
    }

}
