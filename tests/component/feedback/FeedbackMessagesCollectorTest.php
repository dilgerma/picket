<?php
include_once __DIR__ . '/../../BaseTestCase.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 20.07.12
 * Time: 14:11
 * To change this template use File | Settings | File Templates.
 */
class FeedbackMessagesCollectorTest extends BaseTestCase
{
    public function testCollectFeedbackMessages(){

        $form = new Form("test-form",new SimpleModel(""));
        $form->error("test-error");

        $textfield = new TextField("test",new SimpleModel(""));
        $textfield->error("test-text-error");
        $form->add($textfield);

        $messageCollector = new FeedbackMessagesCollector(new FeedbackMessagesLevelFilter(Level::ERROR));
        $form->visit($messageCollector);

        $this->assertEquals(2,$messageCollector->getNumberOfMessages());
        $this->assertTrue($messageCollector->hasMessages());
        $this->assertTrue($form->hasErrors());

    }
}
