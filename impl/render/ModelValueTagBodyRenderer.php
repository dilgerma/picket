<?php
/**
 * renders the model value as tag body of the
 * surrounding component
 */
class ModelValueTagBodyRenderer extends TagRenderer
{
    public function renderBody(MarkupParser $markupParser)
    {
       return $this->component->getModel()->getValue();
    }

}
