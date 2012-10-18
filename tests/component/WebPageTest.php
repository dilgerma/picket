<?php
include_once __DIR__ . '/../BaseTestCase.php';
require_once __DIR__.'/../container/SimpleTestPanel.php';
require_once __DIR__.'/../util/MarkupTester.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 22.07.12
 * Time: 09:41
 * To change this template use File | Settings | File Templates.
 */
class WebPageTest extends BaseTestCase
{
      public function testRenderWebPage(){
          $testWebPage = new TestWebPage("webpage",new SimpleModel(""));
          $testWebPage->add(new Label("test-id", new SimpleModel("Hello Unit Test")));
          $testWebPage->add(new Label("test-id-2", new SimpleModel("All Tags get Replaced")));

          $markupParser = new MarkupParser("TestWebPage.html");
          $testWebPage->render($markupParser);

          $content =  $markupParser->getDocument()->htmlOuter();
          $markupTester = new MarkupTester($content,false);
          $markupTester->tagExists("html")->tagExists("body")->tagExists("div")->tagExists("div");
          $markupTester->attributeEquals("pid","test-id")->nodeValue("Hello Unit Test");
      }

}

class TestWebPage extends WebPage {

}