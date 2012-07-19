<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 18.07.12
 * Time: 11:20
 * To change this template use File | Settings | File Templates.
 */
abstract class ListView extends Panel
{

    public function ListView($id, IModel $listmodel)
    {
        $this->Panel($id, $listmodel);
        $this->appendChildNodes();
        foreach ($listmodel->getValue() as $key => $value) {
            $this->populateItem(ComponentStub::concatenateId($this->getId(), $key), $value);
        }
    }

    public abstract function populateItem($markupId, $listItem);

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "list";
    }

    protected function appendChildNodes()
    {
        $node = $this->getMarkupParser()->getTagForComponent($this);

        if ($node->childNodes->length == 0) {
            throw new Exception("To use a ListView, you provide one child that serves as template and has the same pid as the parent,
            unfortunately, I cannot find a child with id " . $this->getId() . " in File " . $this->getMarkupFile());
        }
        $child = $node->childNodes->item(0);


        foreach($this->getModel()->getValue() as $key=>$value){
            $clonedChild = $child->cloneNode();
           echo $node->attributes->item(0)->textContent;
            $clonedChild->attributes->setNamedItem("pid", ComponentStub::concatenateId($this->getId(),$key));
            $node->appendChild($clonedChild);
        }




    }


}
