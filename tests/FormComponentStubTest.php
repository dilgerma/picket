<?php include_once(__DIR__ . '/BaseTestCase.php');
require_once(__DIR__ . '/SimpleTestMarkupParser.php');

/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 23.10.12
 * Time: 19:32
 * To change this template use File | Settings | File Templates.
 */
class FormComponentStubTest extends BaseTestCase
{
    public function testValidateRequiredIsRunFirst()
    {
        $formComponent = new TestFormComponent("test", new SimpleModel(""));
        $formComponent->addValidator(new RequiredValidator());
        $formComponent->addValidator(new EmailAddressValidator());

        $formComponent->onValidate("");
        $collector = new FeedbackMessagesCollector(new FeedbackMessagesLevelFilter(Level::ERROR));
        $formComponent->visit($collector);
        //if both were run, we would have 2 messages
        $this->assertEquals(1, $collector->getNumberOfMessages());

        $formComponent = new TestFormComponent("test", new SimpleModel(""));
        $formComponent->addValidator(new RequiredValidator());
        $formComponent->addValidator(new EmailAddressValidator());
        $formComponent->onValidate("test@test.de");
        $this->assertFalse($formComponent->hasErrors());
     }
}

class TestFormComponent extends FormComponentStub
{

    public function getType()
    {
        return "unit-test";
    }
}
