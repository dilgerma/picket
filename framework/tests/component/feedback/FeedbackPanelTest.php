<?php
include_once __DIR__ . '/../../BaseTestCase.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 18.07.12
 * Time: 15:57
 * To change this template use File | Settings | File Templates.
 */
class FeedbackPanelTest extends BaseTestCase
{
    public function testRenderListView()
    {
        $form = new Form("test", new SimpleModel(""));
        $textField = new TextField("field", new SimpleModel(""));
        $textField->getFeedbackMessages()->addMessage(new FeedbackMessage("message-1", Level::ERROR));
        $form->add($textField);
        $feedback = new FeedbackPanel("feedback", $form);
        $rendered = $feedback->render();

        $matcher = array('tag' => 'div', 'descendant' => array('tag' => 'input','attributes'=>array("value"=>"message-1")));
        $this->assertTag($matcher,$rendered);
    }
}

?>

