<?php
class TextField extends FormComponentStub
{

    public function TextField($id,$model=null) {
        $this->FormComponentStub($id,$model);
    }

    protected function innerConfigure()
    {
        $this->addAttributes(array("value"=>$this->getModel()->getValue()));
    }


    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "input";
    }

    public function getType()
    {
        return "text";
    }
}

?>