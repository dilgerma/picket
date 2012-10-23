<?php

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
