<?php

class TestRequestParameters extends RequestParameters
{

    private $parameters;

    public function TestRequestParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    public function getAllParameters()
    {
        return $this->parameters;
    }

    /**
     * builds an array, that indicates a form submit
     * for the given component id.
     * @static
     * @param $componentId
     * @return array
     */
    public static function getSubmittingArray($componentId){
        return array(FormCallBackUri::LISTENER => FormCallBackUri::SUBMIT_LISTENER_SEPARATOR,
        FormCallBackUri::SUBMITTING_COMPONENT=>$componentId);
    }
}