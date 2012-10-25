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
 * //desc start
 *
 * A ListView is a simple Repeater component that repeats a html-node as often as values are provided in the given listmodel.
 * The ListView expects a certain markup-layout, for example:
 *
 * <div pid="list">
 *  <div pid="list-child"/>
 * </div>
 *
 * the div with the pid "list" is the listview, and for every element in the given listmodel,
 * the div with pid "list-child" gets copied n times.
 *
 * @author Martin Dilger
 * //desc end
 */
abstract class ListView extends ComponentStub
{

    public function ListView($id, IModel $listmodel)
    {
        $this->ComponentStub($id, $listmodel);
        $this->setTagRenderer(new ContainerComponentRenderer($this));
    }


    /**
     *
     * This is the Method that is called for each childnode, and where you can
     * add your elements, unfortunately, this is currently not as easy to use
     * as I´d wish to.
     *
     * you have the parameter markupId, this is the id of your markupNode with the appendix "-child".
     * If there are any child-nodes within the "-child"-node, you need to attach the given markupIdSuffix to each Id,
     * so that we can uniqely identify each node.
     *
     * markupIdSuffix is only important, if you have a deeper hierarchy within you "-child" children.
     * Take the follwing example:
     *
     * <div pid="listView">
     *  <div pid="listView-child"/>
     * </div>
     *
     * This is the simplest case for a ListView, and in this case, markupIdSuffix can be ignored.
     *
     * <div pid="listView">
     *  <div pid="listView-child">
     *      <div pid="listView-inner"/>
     *  </div>
     * </div>
     *
     * In this case, to add the listView-inner Component, you need to call the following within populateItem-function.
     * $this->toListViewMarkupId("listView-inner",$markupIdSuffix), that generates something like:
     *
     * "listView-inner:0"
     *
     * @abstract
     * @param $markupId
     * @param IModel $listItem
     * @param $markupIdSuffix
     * @return mixed
     */
    public abstract function populateItem($markupId, IModel $listItem, $markupIdSuffix);

    protected function attachMarkup(MarkupParser $markupParser)
    {
        if (count($this->getModel()->getValue()) > 0) {
            $this->appendChildNodes($markupParser);
            $this->appendChildComponents();
        }
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
        $node = $markupParser->getTagForComponent($this);

        if ($node->children()->length != 1) {
            $this->throwInvalidMarkupException($markupParser);
        }

        $child = $node->children("[pid='" . $this->getId() . "-child']")->get(0);
        if (is_null($child)) {
            $this->throwInvalidMarkupException($markupParser);
        }

        foreach ($this->getModel()->getValue() as $key => $value) {

            $clonedChild = $child->cloneNode(true);

            $this->addIterationSuffixToPID($clonedChild, $key);

            $node->get(0)->appendChild($clonedChild);
        }
        //at last, remove the original child, so that only the
        //automatically generated childs remain.
        $node->get(0)->removeChild($child);
        $this->log->debug("ListView::rendered " . $node->htmlOuter());
    }

    private function appendChildComponents(){
        foreach ($this->getModel()->getValue() as $key => $value) {
            //gets the component and adds it for each node that was created in appendChildNodes
            $this->populateItem($this->toListViewMarkupId($this->getId()."-child", $key), new SimpleModel($value), $key);
        }
    }


    /**
     * As each tag within the dom document needs to have a unique pid,
     * this method iterates over all children of the given dom-node and
     * appends the suffix to their pid.
     *
     * For example:
     * if we have the domnode
     * <div pid="test"/>
     * and the suffix "0"
     *
     * after this method has finished, the domnode looks like this:
     *
     * <div pid="test:0"/>
     *
     * @param DOMNode $domNode
     * @param $suffix
     */
    private function addIterationSuffixToPID(DOMNode $domNode, $suffix)
    {
        if(count($domNode->childNodes)<=0){
            return;
        }
        foreach ($domNode->childNodes as $child) {
            $this->addIterationSuffixToPID($child, $suffix);
        }

        if (is_null($domNode->attributes) === false) {
            $pid = $domNode->attributes->getNamedItem("pid");
            $pid->nodeValue = ComponentStub::concatenateId($pid->nodeValue, $suffix);
        }

    }

    /**
     * Builds the concatenated markup id for list view childs.
     *
     * Concatenated ids look like "markupId" + ":" + "0" where 0 is the suffix that the
     * list view automatically generated.
     *
     * @param $markupId
     * @param $markupIdSuffix
     * @return string
     */
    protected function toListViewMarkupId($markupId, $markupIdSuffix){
        return $markupId.":".$markupIdSuffix;
    }

    private function throwInvalidMarkupException(MarkupParser $markupParser)
    {
        throw new Exception("To use a ListView, you provide one child that serves as template,
            unfortunately, I cannot find a single Tag and child with id " . $this->getId() . "-child \n
            Html is:\n" . $markupParser->getDocument()->htmlOuter());
    }



}
