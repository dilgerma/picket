<?php

include_once(__DIR__.'/BaseTestCase.php');
require_once(__DIR__.'/request/TestRequestParameters.php');
require_once(__DIR__.'/request/TestRequestParametersProvider.php');
require_once(__DIR__.'/SimpleTestMarkupParser.php');

?>

<?php




/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class FormTest extends BaseTestCase
{

    public function testRender(){
        $testValue="test-rendered-label-in-form";
        $form = new Form("form-id", new SimpleModel("test-model"));
        $form->add(new Label("infoLabel",new SimpleModel($testValue)));
        $form->add(new TextField("text-field",new SimpleModel("text-field")));
        $form->add(new SubmitLink("submit",new SimpleModel("")));

        $markupParser = new SimpleTestMarkupParser("SimpleTestFormMarkup.html");

        $rendered = $form->render($markupParser);


        $matcher = array("tag"=>"form","attributes"=>array("name"=>$form->getId(),"method"=>"post","action"=>"ide-phpunit.php?listener=form-submit&sc=form-id"));

        //well, the result is ide dependent, not very nice..
        $this->assertTag($matcher,$rendered);


        $matcherWithSpan = array("tag"=>"form","descendant"=>array("tag"=>"span","content"=>$testValue));
        $this->assertTag($matcherWithSpan,$rendered);
    }


    public function testFormSubmit(){

        $parameterArray = TestRequestParameters::getSubmittingArray("form-id");
        $submittingTextField = array("text-field"=>"blubb","form-id"=>"blubb-form");
        $testRequestParameters = new TestRequestParameters(array_merge($parameterArray,$submittingTextField));
        $testRequestParameterProvider = new TestRequestParametersProvider($testRequestParameters);


        $configuration = Configuration::getConfigurationInstance();
        $configuration->setRequestParametersProvider($testRequestParameterProvider);

        $markupParser = new SimpleTestMarkupParser("SimpleTestFormMarkup.html");

        $form = new Form("form-id", new SimpleModel("test-model"));
        $textField = new TextField("text-field", new SimpleModel("test-text"));
        $this->assertEquals("test-text",$textField->getModel()->getValue());

        $form->add($textField);
        $rendered = $form->render($markupParser);

        $modelValue = $textField->getModel()->getValue();
        $this->assertEquals("blubb",$modelValue);

        $matcher = array("tag"=>"form", "descendant"=>array("tag"=>"input", "attributes"=>array("name"=>$textField->getId(),"value"=>"blubb")));
        $this->assertTag($matcher,$rendered);


    }


}


