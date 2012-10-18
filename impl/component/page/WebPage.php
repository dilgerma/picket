<?php
/**
 * This is an example how WebPages are used:
 *
 * class testpage extends WebPage
*  {
*    public function testpage($id,$model){
*      $this->WebPage($id,$model);
*      $this->add(new Label("label",new SimpleModel("hallo welt")));
*      $this->add(new Label("blubb", new SimpleModel("so lala")));
*    }
*  }
*
* $testpage = new testpage("webpage",new SimpleModel(""));
* $testpage->renderDirectly();
 *
 * At the bottom of a page class, always instantiate the page and call render, thus you can call the
 * page directly in the browser.
*/
class WebPage extends WebMarkupContainer
{

    public function WebPage($markupId, $model){
        $this->WebMarkupContainer($markupId,$model);
    }

    /**
     * renders all header contributions. ensures that each contribution is rendered once, as long as the
     * identifier is unique.
     * @param MarkupParser $markupParser
     */
    public function onBeforeRender(MarkupParser $markupParser)
    {

        parent::onBeforeRender($markupParser);
        $behaviorCollector = new BehaviorCollector();
        $this->visit($behaviorCollector);

        $collected = $behaviorCollector->getCollectedBehaviors();
        $contributions = array();
        foreach($collected as $behavior){
            $headerContribution = $behavior->renderHead($markupParser);
            $contributions[$headerContribution->getIdentifier()]=$headerContribution->getResource();
        }
        foreach($contributions as $header){
            $node = $markupParser->findFirstTagByName("head");
            $node->append($header);
        }
    }


    /*
   * Direct Render
   * Renders this component directly to the current script.
   * */
    public function renderDirectly(){
        $this->getTagRenderer()->setStreamWriter(new PageRenderStreamWriter($this));
        $this->render(new MarkupParser(MarkupParser::getCurrentMarkupName()));
    }

}
