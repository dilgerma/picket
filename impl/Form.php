<?php
/**
Copyright (c) 2012, Martin Dilger - EffectiveTrainings.de
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
 * Neither the name of the <organization> nor the
names of its contributors may be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL EffectiveTrainings BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */



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