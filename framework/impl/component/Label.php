<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 20.07.12
 * Time: 11:05
 * To change this template use File | Settings | File Templates.
 */
class Label extends ComponentStub
{

    public function Label($id,$model){
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
