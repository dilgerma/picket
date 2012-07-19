<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 21:05
 * To change this template use File | Settings | File Templates.
 */
class Panel extends ComponentStub
{
    private $markupParser;

    public function Panel($id, $model){
        $this->ComponentStub($id,$model);
        $this->setTagRenderer(new EmptyTagRenderer());
        $this->markupParser = new MarkupParser($this->getMarkupFile());
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return null;
    }

    protected function renderMarkupTag()
    {
        $this->markupParser->replaceNodes($this);
        $rendered = $this->markupParser->getDocument()->html();
        return $rendered;
    }

    protected function getMarkupParser(){
        return $this->markupParser;
    }


    public function getMarkupFile(){
        $filename = $this->getPackage();
        $markup = MarkupParser::getMarkupNameFromScript($filename);
        return $markup;
    }

    public function isDynamicallyRendered()
    {
        return true;
    }



}
