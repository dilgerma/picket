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

    public function MarkupContainer($id,IModel $model) {
        $this->ComponentStub($id,$model);
        $this->markupParser = new MarkupParser($this->getMarkupFile());
        $this->setTagRenderer(new ContainerComponentRenderer($this));

    }

    public function getMarkupFile(){
        $filename = $this->getPackage();
        $markup = MarkupParser::getMarkupNameFromScript($filename);
        return $markup;
    }

    public function getMarkupParser(){
        return $this->markupParser;
    }

    protected function attachMarkup(MarkupParser $markupParser)
    {
        $node = $markupParser->getTagForComponent($this);
        $this->log->info("replacing body of MarkupContainer ".$this->getId()."");
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

}
