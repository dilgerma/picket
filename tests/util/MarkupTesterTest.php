<?php
include_once(__DIR__.'/../BaseTestCase.php');
include_once(__DIR__.'/MarkupTester.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 17.10.12
 * Time: 16:51
 * To change this template use File | Settings | File Templates.
 */
class MarkupTesterTest extends BaseTestCase
{
    public function testFile(){

        $markupTester = new MarkupTester("TestMarkup.html");
        $markupTester->tagExists("html")->tagExists("body")->tagExists("div")->
            attributeEquals("pid","webpage")->tagExists("div")->
            attributeEquals("pid","test-id")->attributeEquals("id","test-id")
            ->nodeValue("hallo welt 2");
    }

    public function testMarkup(){
        $markup = "<div><form><input></form></span></div>";
        $markupTester = new MarkupTester($markup,false);
        $markupTester->tagExists("div")->tagExists("form")->tagExists("input");
    }
}
