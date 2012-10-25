<?php
/**
 * This is an example how WebPages are used:
 *
 * //desc start
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
 *
 * @author Martin Dilger
 * //desc end
 */
class WebPage extends WebMarkupContainer
{
    /**
     * @var MarkupResolver
     */
    private $markupResolver;

    public function WebPage($markupId, $model)
    {
        $this->WebMarkupContainer($markupId, $model);
        $this->markupResolver = new ParentMarkupResolver();
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

        foreach ($collected as $behavior) {
            $headerContribution = $behavior->renderHead($markupParser);
            $this->renderNewHeaderContribution(&$contributions, $headerContribution, $markupParser);
        }
    }

    /**
     * renders a header contribution only if a contributino with the same identifier
     * was not already rendered.
     * @param $contributions
     * @param $headerContribution
     * @param $markupParser
     */
    private final function renderNewHeaderContribution($contributions, $headerContribution, $markupParser)
    {
        if (!array_key_exists($headerContribution->getIdentifier(),$contributions)) {
            $contributions[$headerContribution->getIdentifier()] = $headerContribution->getResource();
            $node = $markupParser->findFirstTagByName("head");
            if ($node->length !== 0) {
                $node->append($contributions[$headerContribution->getIdentifier()]);
            } else {
                $this->log->warn("No Head Section found, cannot render HeaderContributions");
            }
        } else {
            $this->log->warn("Contribution with " . $headerContribution->getIdentifier() . " was already rendered.");

        }
    }


    /*
   * Direct Render
   * Renders this component directly to the current script.
   * */
    public function renderDirectly()
    {
        $this->getTagRenderer()->setStreamWriter(new PageRenderStreamWriter($this));
        $this->render(new MarkupParser($this->markupResolver->resolveMarkup($this)));
    }


}
