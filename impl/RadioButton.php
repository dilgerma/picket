<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 20.10.12
 * Time: 10:12
 * To change this template use File | Settings | File Templates.
 */
class RadioButton  extends FormComponentStub
{

    public function RadioButton($id,IModel $model){
        $this->FormComponentStub($id,$model);
    }

    public function onBeforeRender(MarkupParser $markupParser)
    {
        parent::onBeforeRender($markupParser);
        $this->addAttributes(array("name"=>$this->getParent()->getId()));
    }

    protected function innerConfigure()
    {
        parent::innerConfigure();
        $this->addAttributes(array("value"=>$this->getModel()->getValue()));
    }

    public function bind(ComponentStub $component)
    {
        parent::bind($component);
        if(!$component instanceof RadioGroup){
            throw new InvalidHierarchyException($component,$this);
        }
    }


    public function getType()
    {
        return "radio";
    }

}
