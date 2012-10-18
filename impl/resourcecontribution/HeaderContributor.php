<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 17.10.12
 * Time: 09:40
 * To change this template use File | Settings | File Templates.
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
