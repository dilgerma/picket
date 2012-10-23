<?php
include_once __DIR__.'/../../BaseTestCase.php';
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 23.10.12
 * Time: 19:04
 * To change this template use File | Settings | File Templates.
 */
class EmailAddressValidatorTest extends BaseTestCase
{
    public function testValid(){
        $label = new Label("test",new SimpleModel(""));
        $validator = new EmailAddressValidator();
        $validator->validate($label,"test@test.de");
        $this->assertFalse($label->hasErrors());
    }

    public function testInvalid(){
        $label = new Label("test",new SimpleModel(""));
        $validator = new EmailAddressValidator();
        $validator->validate($label,"test@test");
        $this->assertTrue($label->hasErrors());
    }
}
