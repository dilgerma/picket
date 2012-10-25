<?php
include_once __DIR__ . '/../../BaseTestCase.php';
require_once __DIR__ . '/../../container/SimpleTestPanel.php';
require_once __DIR__ . '/../../util/MarkupTester.php';
require_once __DIR__."/PageTestPanel.php";
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
        $label->addBehavior(new HeaderContributor(new PackageWebResource("scripts",$testWebPage,"js",new JavaScriptResourceRenderer(),"scripts")));
        $label->addBehavior(new HeaderContributor(new PackageWebResource("scripts",$testWebPage,"css",new CSSResourceRenderer(),"styles")));
        $testWebPage->add($label);
        $testWebPage->add(new Label("test-id-2", new SimpleModel("All Tags get Replaced")));

        $markupParser = new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__));
        $testWebPage->render($markupParser);
        $content = $markupParser->getDocument()->htmlOuter();

        $markupTester = new MarkupTester($content, false);
        $markupTester->tagExists("html")->tagExists("head")->tagExists("script")->attributeEquals("language","JavaScript")->attributeEquals("src","/tests/component/page/scripts/deeper/deeper.js");

        $cssMarkupTester = new MarkupTester($content,false);
        $cssMarkupTester->tagExists("html")->tagExists("head")->tagExists("link")->attributeEquals("rel","stylesheet")->attributeEquals("href","/tests/component/page/scripts/deeper/style.css");
    }


    public function testRenderWebPageWithDoubleContributions(){
        $testWebPage = new TestWebPage("webpage", new SimpleModel(""));
        $testWebPage->addBehavior(new HeaderContributor(new PackageWebResource("scripts/deeper",$testWebPage,"js",new JavaScriptResourceRenderer(),"scripts")));
        $testWebPage->addBehavior(new HeaderContributor(new PackageWebResource("scripts/deeper",$testWebPage,"js",new JavaScriptResourceRenderer(),"scripts")));


        $markupParser = new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__));
        $testWebPage->render($markupParser);
        $content = $markupParser->getDocument()->htmlOuter();

        $markupTester = new MarkupTester($content, false);
        $markupTester->tagExists("html")->tagExists("head");
        $markupTester->assertTagCount("script",1);
    }

    public function testRenderPageWithPanel(){
        $testWebPage = new TestWebPage("webpage", new SimpleModel(""));
        $testWebPage->add(new PageTestPanel("test-id",new SimpleModel("")));

        $markupParser = new MarkupParser(MarkupParser::getMarkupNameFromScript(__FILE__));
        $testWebPage->render($markupParser);
    }

}

class TestWebPage extends WebPage
{

}
