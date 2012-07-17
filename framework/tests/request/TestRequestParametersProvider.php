<?php


class TestRequestParametersProvider implements RequestParameterProvider {

    private $testParameters;

    public function TestRequestParametersProvider($parameters){
        $this->testParameters = $parameters;
    }

    public function newRequestParameters()
    {
        return $this->testParameters;
    }
}