<?php
include_once __DIR__ . '/../BaseTestCase.php';
require_once __DIR__.'/SimpleTestPanel.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 21:36
 * To change this template use File | Settings | File Templates.
 */
class PanelTest extends BaseTestCase
{
   public function testMarkupIsLoaded(){
       $panel = new SimpleTestPanel("test",new SimpleModel(""));
       $this->assertEquals("<input name=\"text\" type=\"text\" value=\"blubb\" pid=\"text\" class=\"blubb\">",$panel->render()) ;
   }

    public function attributesAreCorrectlyReplaced(){
        $panel = new SimpleTestPanel("test",new SimpleModel(""));
        $this->assertEquals("<input name=\"text\" type=\"text\" value=\"blubb\" pid=\"text\" class=\"blubb\">",$panel->render()) ;
    }
}
