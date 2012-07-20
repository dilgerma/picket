<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 13:14
 * To change this template use File | Settings | File Templates.
 */
class DropDownOption extends FormComponentStub
{

    private $selectionModel;

    public function DropDownOption($id,$model,$selectionModel)
    {
       $this->FormComponentStub($id,$model);
       $this->addAttributes(array("value"=>$this->getModel()->getValue()));
        $this->selectionModel = $selectionModel;
    }

    public function getTagBody()
    {
        return $this->getModel()->getValue();
    }

    public function innerConfigure()
    {
        if($this->selectionModel->getValue() == $this->getModel()->getValue()){
            $this->addAttributes(array("selected"=>""));
        }
    }

    public function isWithoutMarkup()
    {
        return true;
    }


    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "option";
    }

    public function getType()
    {
        return null;
    }
}
