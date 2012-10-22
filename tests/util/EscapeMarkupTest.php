<?php
include_once(__DIR__.'/../BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */
class EscapeMarkupTest extends BaseTestCase
{
    public function testEscapeChars(){
        $html= "<div><span class=\"test\">a Text</span></div>";
        $escaped = EscapeMarkup::escape($html);
        $this->assertEquals("&lt;div&gt;&lt;span class=&quot;test&quot;&gt;a Text&lt;/span&gt;&lt;/div&gt;",$escaped);
    }
}
