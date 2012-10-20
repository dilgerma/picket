<?php
/**
 *
 * Groups a List of Radio Buttons,
 * all radio Buttons in this group have the same name.
 */
class RadioGroup extends FormComponentStub
{

    public function RadioGroup($id,IModel $model){
        $this->FormComponentStub($id,$model);
        $this->setTagRenderer(new ContainerComponentRenderer($this));
    }

    public function onBeforeRender(MarkupParser $markupParser)
    {
        foreach($this->fields() as $field){
            if($this->getModel()->getValue() === $field->getModel()->getValue()){
                $field->addAttributes(array("checked"=>"true"));
            }
        }
        parent::onBeforeRender($markupParser);
    }


    public function getType()
    {
       return null;
    }



}
