<?php
/**
 * //desc start
 * A Label is the simplest component that you can think of.
 * It just takes the model that you supply and displays the contents.
 * @author Martin Dilger
 * //desc end
 */
class Label extends ComponentStub
{

    public function Label($id,$model=null){
        $this->ComponentStub($id,$model);
        $this->setTagRenderer(new ModelValueTagBodyRenderer($this));
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
       return null;
    }

}
