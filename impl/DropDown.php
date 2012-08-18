<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 13:00
 * To change this template use File | Settings | File Templates.
 */
class DropDown extends FormComponentStub
{

    public function DropDown($id,$model){
        $this->FormComponentStub($id,$model);
        $this->setTagRenderer(new ContainerComponentRenderer($this));
    }

    public static function createWithOptions($id, $model, $options)
    {
        $dropDown = new DropDown($id, $model);
        foreach ($options as $key => $value) {
            $dropDown->add(
                new DropDownOption(ComponentStub::concatenateId($id, $key),
                    new SimpleModel($value), $dropDown->getModel()));
        }
        return $dropDown;
    }


    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "select";
    }


    public function getType()
    {
        return null;
    }

    //TODO extract to Container-Trait
    protected function attachMarkup(MarkupParser $markupParser)
    {

        $node = $markupParser->getTagForComponent($this);
        foreach ($this->fields() as $field) {
            $field->getTagRenderer()->configure($markupParser);
            $tag = $field->getTagRenderer()->renderOpenTag();
            $tag .= $field->getTagRenderer()->renderCloseTag();
            $this->log->debug("appending dropdown-option child ".$tag." to ".$this->getId());
            $markupParser->appendChildNode($node, $tag);
        }
    }
}