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
    }


    public abstract function populateItem($markupId, $listItem);

    protected function attachMarkup(MarkupParser $markupParser)
    {
        $this->appendChildNodes($markupParser);
        foreach ($this->getModel()->getValue() as $key => $value) {
            //gets the component and adds it for each node that was created in appendChildNodes
            $this->populateItem(ComponentStub::concatenateId($this->getId(), $key), $value);
        }

        $node = $markupParser->getTagForComponent($this);
        $this->log->info("replacing body of MarkupContainer ".$this->getId()."");
        //hier müsste eigentlich $node->replace verwendet werden, funktioniert aber ncht
        $node->prepend($this->getMarkupParser()->getTagForComponent($this)->htmlOuter()) ;
    }


    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return null;
    }

    /**
     *
     * A ListView has the following form in the markup
     * <div pid="list">
     *  <div pid="list" class="i am the child"/>
     * </div>
     *
     * for each listitem, that is given to the listview,
     * the childnode is copied and inserted.
     *
     * The PID of a generated childnode looks like this: <component-id of the listview>:<index in the list>
     *
     * so for the fifth element in the listview above, the pid would be "list:4",
     * and the generated element:
     *
     * <div pid="list:4" class="i am the child"/>
     *
     * The original child element is removed afterwards.
     *
     * @throws Exception
     */
    public function appendChildNodes(MarkupParser $markupParser)
    {
        $node =$markupParser->getTagForComponent($this);


       if ($node->children()->length != 1) {
           $this->throwInvalidMarkupException($markupParser);
        }

        $child = $node->children("[pid='".$this->getId()."-child']")->get(0);
        if(is_null($child)){
            $this->throwInvalidMarkupException($markupParser);
        }

        foreach ($this->getModel()->getValue() as $key => $value) {

            $clonedChild = $child->cloneNode();

            $domNode = $clonedChild->attributes->getNamedItem("pid");

            $domNode->nodeValue = ComponentStub::concatenateId($this->getId(),$key);
            $node->get(0)->appendChild($clonedChild);
        }
//        $node->get(0)->removeChild($child);
        $this->log->info("ListView::rendered ".$node->htmlOuter());
    }

    private function throwInvalidMarkupException(MarkupParser $markupParser)
    {
        throw new Exception("To use a ListView, you provide one child that serves as template,
            unfortunately, I cannot find a single Tag and child with id " . $this->getId() . "-child \n
            Html is:\n".$markupParser->getDocument()->htmlOuter());
    }

}
