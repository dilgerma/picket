<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 22.07.12
 * Time: 08:55
 * To change this template use File | Settings | File Templates.
 */
class MarkupContainer extends ComponentStub
{

    private $markupParser;

    /**
     * @var MarkupResolver
     */
    private $markupResolver;

    public function MarkupContainer($id,IModel $model) {
        //dont move this line after the constructor, as the resolver is already used
        $this->markupResolver = new ParentMarkupResolver();
        $this->ComponentStub($id,$model);
        $this->markupParser = new MarkupParser($this->getMarkupFile());
        $this->setTagRenderer(new MarkupContainerTagRenderer($this));
    }

    public function getMarkupFile(){
        return $this->markupResolver->resolveMarkup($this);
    }

    public function getMarkupParser(){
        return $this->markupParser;
    }

    protected function attachMarkup(MarkupParser $markupParser)
    {
        $node = $markupParser->getTagForComponent($this);
        $node->append($this->getMarkupParser()->getDocument()->html()) ;
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return null;
    }

    public function onDetach()
    {
        parent::onDetach();
        unset($this->markupParser);
    }


}
