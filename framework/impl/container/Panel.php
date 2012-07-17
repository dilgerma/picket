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
        $this->markupParser = new MarkupParser($this->getMarkupFile());
        $this->markupParser->replaceNodes($this);
        $rendered = $this->markupParser->getDocument()->html();
        return $rendered;
    }


    public function getMarkupFile(){
        $filename = $this->getPackage();
        $markup = str_replace(".php",".html",$filename);
        return $markup;
    }

    public function isDynamicallyRendered()
    {
        return true;
    }


    /**
     *
     * @abstract
     * @return the folder of this class, typically this will be implemented like
     * dirname(__FILE__)
     */
    private function getPackage(){
        $reflectOnThis = new ReflectionClass($this);
        return $reflectOnThis->getFileName();
    }
}
