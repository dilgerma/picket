<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 11:36
 * To change this template use File | Settings | File Templates.
 */
class TextArea extends FormComponentStub
{

    public function TextArea($id,IModel $model){
        $this->FormComponentStub($id,$model);
        $this->setTagRenderer(new ModelValueTagBodyRenderer($this));
    }

    public function getType()
    {
        return null;
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "textarea";
    }


}
