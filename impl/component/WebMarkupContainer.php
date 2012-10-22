<?php
/**
 * //desc start
 * A WebMarkupContainer can be used to group components inline.
 * A WebMarkupContainer does not supply its own markup, but expects a component with the given component-id
 * to be present.
 *
 * A good example for the usage of a webmarkupcontainer would be to make a whole section invisible, if a certain condition
 * is not fulfilled.
 *
 * @author Martin Dilger
 * //desc end
 */
class WebMarkupContainer extends ComponentStub
{

     public function WebMarkupContainer($id, IModel $model){
         $this->ComponentStub($id,$model);
         $this->setTagRenderer(new ContainerComponentRenderer($this));
     }
}
