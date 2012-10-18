<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 12:38
 * To change this template use File | Settings | File Templates.
 */
class MarkupContainerTagRenderer extends TagRenderer
{
    public function MarkupContainerTagRenderer(ComponentStub $component){
        $this->TagRenderer($component);
    }

    public function renderBody(MarkupParser $markupParser)
    {
        $this->log->debug("rendering body ".$this->component->getId());
        foreach($this->component->fields() as $field){
            $this->log->debug("Container Component renderer renders component ".$this->component->getId());
            $field->render($markupParser);
        }
        return $markupParser->getTagForComponent($this->component)->html();
    }
}
