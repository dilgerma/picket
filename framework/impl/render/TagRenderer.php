<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 08:05
 * To change this template use File | Settings | File Templates.
 */
class TagRenderer implements ComponentRenderer
{
    /*
     * type Tag
     * */
    protected $component;
    protected $log;
    private $tagName;
    private $streamWriter;

    public function TagRenderer(ComponentStub $component){
        $this->component = $component;
        $this->log = Logger::getLogger("Component");
        $this->tagName = $component->getTagName();
        $this->streamWriter = new MarkupParserRenderStreamWriter($this->component);
    }

    /**
     * renders a Tag and all attributes.
     * @return string
     */
    public function renderOpenTag(){

       if($this->hasTagName() === false){
            $this->log->debug("component ".$this->component->getId()." has no tagname, ignoring");
            return;
        }
        $tag = "<".$this->tagName." ";

        $attributes = $this->component->getAttributes();

        foreach(array_keys($attributes) as $attribute){
            $tag.=$attribute."='".$attributes[$attribute]."' ";
        }
        $tag.=">";

        return $tag;
    }

    public function renderBody(MarkupParser $markupParser){
       return "";
    }

    /*
     * renders the closing tag.
     * */
    public function renderCloseTag(){
        if($this->hasTagName() === false){
            $this->log->debug("component ".$this->component->getId()." has no tagname, ignoring");
            return;
        }
        return "</".$this->tagName.">";
    }

    public function render(MarkupParser $markupParser){
        $this->configure($markupParser);

        $markupParser->applyParameters($markupParser->getTagForComponent($this->component),$this->component);
        $content = $this->renderOpenTag();
        $content.=$this->renderBody($markupParser);
        $content.=$this->renderCloseTag();
        $this->log->debug("rendered tag for ".$this->component->getId()." ".$content);
        $this->streamWriter->renderToStream($markupParser,$content);

        return $markupParser->getTagForComponent($this->component)->htmlOuter();
    }


    private function hasTagName(){
        return is_null($this->tagName)===false &&  $this->tagName != '';
    }

    public function setStreamWriter(RenderStreamWriter $writer)
    {
        $this->streamWriter = $writer;
    }

    /**
     * Initializes this TagRenderer, can be called any time,
     * this method is omnipotent.
     * @param MarkupParser $markupParser
     */
    public final function configure(MarkupParser $markupParser){
        if($this->hasTagName() === false){
           $this->tagName = $markupParser->guessTagNameFromMarkup($this->component);
        }
    }
}

?>