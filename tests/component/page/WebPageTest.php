<?php
include_once __DIR__ . '/../../BaseTestCase.php';
require_once __DIR__ . '/../../container/SimpleTestPanel.php';
require_once __DIR__ . '/../../util/MarkupTester.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 22.07.12
 * Time: 09:41
 * To change this template use File | Settings | File Templates.
 */
class WebPageTest extends BaseTestCase
{
    public function testRenderWebPage()
    {
        $testWebPage = new TestWebPage("webpage", new SimpleModel(""));
        $testWebPage->add(new Label("test-id", new SimpleModel("Hello Unit Test")));
        $testWebPage->add(new Label("test-id-2", new SimpleModel("All Tags get Replaced")));

        $markupParser = new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__));
        $testWebPage->render($markupParser);

        $content = $markupParser->getDocument()->htmlOuter();
        $markupTester = new MarkupTester($content, false);
        $markupTester->tagExists("html")->tagExists("body")->tagExists("div")->tagExists("div");
        $markupTester->attributeEquals("pid", "test-id")->nodeValue("Hello Unit Test");
    }


    public function testRenderWebPageWithHeaderContributor(){
        $testWebPage = new TestWebPage("webpage", new SimpleModel(""));
        $label =  new Label("test-id", new SimpleModel("Hello Unit Test"));
        $label->addBehavior(new HeaderContributor(new PackageWebResource("scripts","js",new JavaScriptResourceRenderer())));
        $label->addBehavior(new HeaderContributor(new PackageWebResource("scripts","css",new CSSResourceRenderer())));
        $testWebPage->add($label);
        $testWebPage->add(new Label("test-id-2", new SimpleModel("All Tags get Replaced")));

        $markupParser = new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__));
        $testWebPage->render($markupParser);
        $content = $markupParser->getDocument()->htmlOuter();

        $markupTester = new MarkupTester($content, false);
        $markupTester->tagExists("html")->tagExists("head")->tagExists("script")->attributeEquals("language","JavaScript")->attributeEquals("src","scripts/deeper/deeper.js");

        $cssMarkupTester = new MarkupTester($content,false);
        $cssMarkupTester->tagExists("html")->tagExists("head")->tagExists("link")->attributeEquals("rel","stylesheet")->attributeEquals("href","scripts/deeper/style.css");
    }

}

class TestWebPage extends WebPage
{

}