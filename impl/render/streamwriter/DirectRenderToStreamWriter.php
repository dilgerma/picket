<?php
/**
 * Simplesst Stream Writer that one can imagine, just
 * renders the contents out, wherever you currently are.
 *
 */
class DirectRenderToStreamWriter implements  RenderStreamWriter
{
    private $component;
    private $log;

    public function DirectRenderToStreamWriter(ComponentStub $component){
        $this->component = $component;
        $this->log = Logger::getLogger("Component");
    }

    public function renderToStream(MarkupParser $markupParer, $content)
    {
        $this->log->debug("DirectToStreamWriter: ");
        echo $content;
    }
}
