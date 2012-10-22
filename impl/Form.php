<?php

/**
 * //desc start
 * Renders a Html Form.
 * All Form Components must be assigned to a Form.
 * You can provide your own call back by calling setSubmitCallback
 * @author Martin Dilger
 * //desc end
 */
class Form extends FormComponentStub
{

    private $callbackURI;

    /**
     * @var bool currently i dont know, why form is submitted twice...:(, so
     * i store a flag, that indicates that form submission already happened.
     */
    private $formSubmitted = false;

    public function Form($id, $model)
    {
        $this->FormComponentStub($id, $model);
        $this->callbackURI = new FormCallBackUri($this);
        $this->addAttributes(array("method" => "post", "action" => $this->callbackURI->getCallbackURI()));
        $this->formSubmitListener = new DefaultFormSubmitListener($this);
        $this->setTagRenderer(new ContainerComponentRenderer($this));
    }

    public function innerConfigure()
    {
        /**
         * Temporary Fix the Bug that Form Submission is done twice...
         */
        if ($this->formSubmitted === false) {
            $this->formSubmitListener->process();
        }
        $this->formSubmitted = true;
        return;
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

    public function onUpdateModel($value)
    {
        //the form itself does never update its model, only the children.
    }

    public function hasErrors()
    {
        $visitor = $this->visit(new FeedbackMessagesCollector(new FeedbackMessagesLevelFilter(Level::ERROR)));
        return $visitor->hasMessages();
    }

    public function isSubmitted(){
        return $this->formSubmitted;
    }


}

?>