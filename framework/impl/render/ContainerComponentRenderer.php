<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 20.07.12
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */
class ContainerComponentRenderer extends TagRenderer
{
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
