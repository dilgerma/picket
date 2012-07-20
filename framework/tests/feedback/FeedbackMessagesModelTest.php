<?php
include_once __DIR__.'/../BaseTestCase.php';

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessagesModelTest extends BaseTestCase
{


    public function testGetMessagesFromComponents(){


        $errorMessage = new FeedbackMessage("Message a", Level::ERROR);
        $form = new Form("test",new SimpleModel(""));
        $form->getFeedbackMessages()->addMessage($errorMessage);

        $infoMessage = new FeedbackMessage("Message b", Level::INFO);
        $textField = new TextField("test-text",new SimpleModel(""));
        $textField->getFeedbackMessages()->addMessage($infoMessage);

        $form->add($textField);

        $feedbackMessages = new FeedbackMessagesModel($form);
        $messages = $feedbackMessages->getValue();
        $this->assertEquals(2,count($messages));
    }

}

