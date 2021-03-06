<?php
require_once __DIR__ . '/../../BaseTestCase.php';
require_once __DIR__ . '/FeedbackTestPanel.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 18.07.12
 * Time: 15:57
 * To change this template use File | Settings | File Templates.
 */
class FeedbackPanelTest extends BaseTestCase
{
    public function testRenderFeedback()
    {
        $form = new Form("test", new SimpleModel(""));
        $textField = new TextField("field", new SimpleModel(""));
        $textField->getFeedbackMessages()->addMessage(new FeedbackMessage("message-1", Level::ERROR));
        $form->add($textField);
        $feedback = new TestFeedbackPanel("testObject", $form);
        $rendered = $feedback->render(new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__)));

        $matcher = array('tag' => 'div', 'descendant' => array('tag' => 'div', 'content' => 'message-1'));
        $this->assertTag($matcher, $rendered);
    }

    public function testFeedbackWithinPanel()
    {
        $testPanel = new FeedbackTestPanel();
        $rendered = $testPanel->render(new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__)));

    }
}

class TestFeedbackPanel extends FeedbackPanel
{
    public function TestFeedbackPanel($id, $model)
    {
        $this->FeedbackPanel($id, $model);
    }

    public function getMarkupFile()
    {
        return MarkupParser::getMarkupNameFromScript($this->getComponentFile());
    }


}

?>

