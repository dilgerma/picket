<?php
/**
Copyright (c) 2012, Martin Dilger - EffectiveTrainings.de
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
 * Neither the name of the <organization> nor the
names of its contributors may be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL EffectiveTrainings BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


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
        $content = $this->renderOpenTag();
        $content.=$this->renderBody($markupParser);
        $content.=$this->renderCloseTag();
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