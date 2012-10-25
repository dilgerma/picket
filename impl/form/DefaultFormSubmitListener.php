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
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:36
 * To change this template use File | Settings | File Templates.
 */
class DefaultFormSubmitListener implements FormSubmitListener
{
    private $component;
    private $requestParameters;

    public function DefaultFormSubmitListener(Form $component)
    {
        $this->component = $component;
        $this->requestParameters = Configuration::getConfigurationInstance()->requestParameterProvider()->newRequestParameters();
    }

    public function onSubmit()
    {
        $fields = $this->component->fields();
        foreach ($fields as $field) {
            $this->handleField($field);
        }
        //and last the form itself
        $this->handleField($this->component);
    }

    public function checkSubmit()
    {
        return $this->requestParameters->isSubmitFor($this->component) && $this->component->hasErrors() === false;
    }

    public function process()
    {
        if ($this->checkSubmit()) {
            $this->onSubmit();
        }
    }


    private function handleField(ComponentStub $field)
    {
        //only FormComponents participate in the LifeCycle
        if (($field instanceof FormLifeCycle)) {
            $value = $this->requestParameters->getSubmittedValueFor($field);
            $field->setRawInput($value);
            $field->onValidate($value);
            if ($field->hasErrors() === false) {
                $field->onUpdateModel($value);
                $field->onSubmit();
            }
        }
    }
}
