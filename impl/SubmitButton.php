<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 13:28
 * To change this template use File | Settings | File Templates.
 */
class SubmitButton extends ComponentStub implements Bindable
{

    /**
     * @var Form
     */
    private $form;

    public function SubmitButton($id,$model){
        $this->ComponentStub($id,$model);
        $this->setTagRenderer(new ModelValueTagBodyRenderer($this));
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "button";
    }

    public function getType()
    {
        return "submit";
    }


    public function bind(ComponentStub $component)
    {
        if(!$component instanceof Form){
            throw new Exception("SubmitButton must only be added to forms!");
        }
        $this->form = $component;
    }
}
