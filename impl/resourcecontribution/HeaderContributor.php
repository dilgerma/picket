<?php
/**
 * //desc start
 *
 * A Special Behavior that can be used to contribute resources to your pages <head>-section.
 * HeaderContributors can be placed on every component, but do only work if your outermost component
 * is a webpage, since webpages take care to render header-contributions.
 *
 * @see the examples section, how to use them.
 *
 * @author Martin Dilger
 * //desc end
 */
class HeaderContributor extends BehaviorAdapter
{
    private $log;

    /**
     * @var WebResource
     */
    private $resource;

    public function HeaderContributor(WebResource $resource){
        $this->resource = $resource;
        $this->log = Logger::getLogger("HeaderContributor");
    }


    public function renderHead(MarkupParser $parser)
    {
        parent::renderHead($parser);
        $content = $this->resource->render();
        return new HeaderContribution($content,$this->resource->getIdentifier());

    }

}
