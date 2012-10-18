<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 08:48
 * To change this template use File | Settings | File Templates.
 */
class BehaviorCollector implements IVisitor
{

    private $behaviors = array();

    public function visit(ComponentStub $component)
    {
        $this->behaviors = array_merge($this->behaviors,$component->getBehaviors());
    }

    public function getCollectedBehaviors(){
        return $this->behaviors;
    }
}
