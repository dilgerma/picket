<?php include_once(__DIR__.'/../BaseTestCase.php');?>
<?php


/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:49
 * To change this template use File | Settings | File Templates.
 */
class RequestParametersTest extends BaseTestCase
{
    public function testIsSubmit()
    {
        $testParameters = new TestRequestParameters(array());
        $this->assertFalse($testParameters->isSubmit());

        $testParameters = new TestRequestParameters(array(FormCallBackUri::LISTENER => FormCallBackUri::SUBMIT_LISTENER_SEPARATOR));
        $this->assertTrue($testParameters->isSubmit());

    }

    public function testIsSubmitForComponent(){

        $id = "test-form";
        $component = new Form($id,new SimpleModel("test-model"));
        $nonSubmittedComponent = new Form("some-id",new SimpleModel("test-model"));

        $testParameters = new TestRequestParameters(
            array(FormCallBackUri::LISTENER => FormCallBackUri::SUBMIT_LISTENER_SEPARATOR,
            FormCallBackUri::SUBMITTING_COMPONENT=>$id));
        $this->assertTrue($testParameters->isSubmitFor($component));
        $this->assertFalse($testParameters->isSubmitFor($nonSubmittedComponent));
    }

    public function testGetParameterForComponent(){

        $testParameters = new TestRequestParameters(array("test-component"=>"submitted"));
        $component = new Form("test-component",new SimpleModel("test"));
        $value = $testParameters->getSubmittedValueFor($component);
        $this->assertEquals("submitted",$value);
    }
}

