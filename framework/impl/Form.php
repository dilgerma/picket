<?php

class Form extends FormComponentStub
{

    private $callbackURI;

    public function Form($id, $model){
        $this->FormComponentStub($id, $model);
        $this->callbackURI = new FormCallBackUri($this);
        $this->addAttributes(array("method"=>"post","action"=>$this->callbackURI->getCallbackURI()));
        $this->formSubmitListener = new DefaultFormSubmitListener($this);
    }

    public function innerConfigure(){
        $this->formSubmitListener->process();
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
       return "form";
    }

    public function getType()
    {
        return null;
    }

}

?>