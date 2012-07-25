<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 22.07.12
 * Time: 09:02
 * To change this template use File | Settings | File Templates.
 */
class MarkupParserRenderStreamWriter implements RenderStreamWriter
{

    private $component;
    private $log;

    public function MarkupParserRenderStreamWriter(ComponentStub $component){
        $this->component = $component;
        $this->log = Logger::getLogger("Component");
    }

    public function renderToStream(MarkupParser $markupParser, $content)
    {
        $this->log->debug("MarkupParserRenderStreamWriter::rendering to stream ".$content);
        $node = $markupParser->getTagForComponent($this->component);
        $markupParser->replaceMarkupNode($node,$content);
    }
}
