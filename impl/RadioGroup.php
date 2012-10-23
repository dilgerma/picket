<?php
/**
 *
 * Groups a List of Radio Buttons,
 * all radio Buttons in this group have the same name.
 */
class RadioGroup extends FormComponentStub
{

    public function RadioGroup($id,IModel $model){
        $this->ComponentStub($id,$model);
        $this->setTagRenderer(new ContainerComponentRenderer($this));
    }

    public function onUpdateModel($value)
    {
        foreach($this->fields() as $field){
            if($value === $field->getModel()->getValue()){
                $field->addAttributes(array("checked"=>"true"));
            }
        }
    }

}
