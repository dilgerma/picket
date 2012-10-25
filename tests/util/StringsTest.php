<?php
include_once(__DIR__ . '/../BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 09:55
 * To change this template use File | Settings | File Templates.
 */
class StringsTest extends BaseTestCase
{
    public function testRemoveFirstCharacterIfAvailable(){
        $path = "/test/blubb";
        $path = Strings::removeFirstCharacterIfAvailable($path,"/");
        $this->assertEquals("test/blubb",$path);

        $path = "test/blubb";
        $path = Strings::removeFirstCharacterIfAvailable($path,"/");
        $this->assertEquals("test/blubb",$path);
    }

}
