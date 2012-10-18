<?php
include_once __DIR__ . '/../../BaseTestCase.php';

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessagesTest extends BaseTestCase
{


    public function testFilter(){

        $errorMessage = new FeedbackMessage("Message a", Level::ERROR);
        $infoMessage = new FeedbackMessage("Message b", Level::INFO);

        $feedbackMessages = new FeedbackMessages();
        $feedbackMessages->addMessage($errorMessage);
        $feedbackMessages->addMessage($infoMessage);

        $infoMessages = $feedbackMessages->getMessages(new FeedbackMessagesLevelFilter(Level::INFO));
        $this->assertEquals(1,count($infoMessages));

        $this->assertSame($infoMessage,current($infoMessages));

        $errorMessages = $feedbackMessages->getMessages(new FeedbackMessagesLevelFilter(Level::ERROR));
        $this->assertSame($errorMessage,current($errorMessages));

    }

    public function testGetAllMessages(){
        $errorMessage = new FeedbackMessage("Message a", Level::ERROR);
        $infoMessage = new FeedbackMessage("Message b", Level::INFO);

        $feedbackMessages = new FeedbackMessages();
        $feedbackMessages->addMessage($errorMessage);
        $feedbackMessages->addMessage($infoMessage);

        $all = $feedbackMessages->getAllMessages();
        $this->assertEquals(2,count($all));
    }

}

