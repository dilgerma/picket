<?php include_once(__DIR__.'/BaseTestCase.php');?>
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
        $form = new Form("form-id", new SimpleModel("test-model"));
        $form->add(new TextField("text-field",new SimpleModel("text-field")));
        $form->add(new SubmitButton("submit",new SimpleModel("")));

        $rendered = $form->renderTag();
        //well, the result is ide dependent, not very nice..
        $this->assertEquals("<form name='".$form->getId()."' method='post' action='ide-phpunit.php?listener=form-submit&sc=form-id' ></form>",$rendered);
    }


    public function testFormSubmit(){

        $parameterArray = TestRequestParameters::getSubmittingArray("form-id");
        $submittingTextField = array("text-id"=>"blubb","form-id"=>"blubb-form");
        $testRequestParameters = new TestRequestParameters(array_merge($parameterArray,$submittingTextField));
        $testRequestParameterProvider = new TestRequestParametersProvider($testRequestParameters);


        $configuration = Configuration::getConfigurationInstance();
        $configuration->setRequestParametersProvider($testRequestParameterProvider);

        $form = new Form("form-id", new SimpleModel("test-model"));
        $textField = new TextField("text-id", new SimpleModel("test-text"));
        $form->add($textField);
        $form->render();

        $rendered = $textField->getModel()->getValue();
        $this->assertEquals("blubb",$rendered);

    }

}


