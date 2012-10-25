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


require_once __DIR__ . "/../../libs/phpquery/php_query.php";
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 10:35
 * To change this template use File | Settings | File Templates.
 */
class MarkupParser
{

    private $dom;
    private $markupPath;
    private $log;

    public function MarkupParser($path)
    {
        $this->dom = phpQuery::newDocumentFileHTML($path);
        $this->markupPath = $path;
        $this->log = Logger::getLogger("MarkupParser");
    }

    /**
     * @param ComponentStub $component
     * @return phpQueryObject
     * @throws Exception if no element with the given id was found.
     */
    public function getTagForComponent(ComponentStub $component)
    {
        $parent = $component->getParent();
        if(!is_null($parent)){
            $startNode = $this->getTagForComponent($parent);
        }
        $pidSelector = $this->pidSelector($component);
        if (isset($startNode)) {
            $element = $startNode->find($pidSelector);
        } else {
            $element = pq($pidSelector, $this->dom->getDocumentID());
        }

        if ($element->length == 0) {
            $componentId = $component->getId();
            throw new Exception("MarkupElement for " . $componentId . " not found,
            maybe Parameter " . MarkupConstants::ID_ATTR . "=" . $componentId . " is missing or wrong Hierarchy?.\n
            \nLoaded from " . $this->markupPath . "\nCurrent Document is:\n
            \n\n" . htmlspecialchars($this->getDocument()->html()));
        }

        if($element->length > 1){
            $componentId = $component->getId();
            throw new Exception("There is more than one Element on the page with  ".MarkupConstants::ID_ATTR.
                " ".$componentId.". \n\nCurrent Document is\n\n".htmlspecialchars($this->getDocument()->html()));
        }

        return $element;
    }

    /**
     * @param $element
     * @param $component
     * @property DOMElement $element
     * @property ComponentStub $component
     *
     *
     */
    public function processContainerComponentChilds(ComponentStub $component, phpQueryObject $startNode = null)
    {

        foreach ($component->fields() as $field) {
            $this->processContainerComponentChilds($field);
        }

        $node = $this->getTagForComponent($component, $startNode);
        $this->validateNode($node, $component);
        $this->applyParameters($node, $component);
    }

    protected function validateNode(phpQueryObject $node, ComponentStub $component)
    {

        if ($component->getTagName() !== null) {
            $markupNodeName = $node->get(0)->nodeName;
            if ($component->getTagName() !== $markupNodeName) {
                throw new Exception("Element with pid " . $component->getId() . " expects Tag '" . $component->getTagName() . "' but we found
                '" . $markupNodeName . "' - maybe the pid is attached to the wrong tag?");
            }
        }

        unset($node);
    }

    public function applyParameters(phpQueryObject $node, ComponentStub $component)
    {
        $attributes = $component->getAttributes();
        $attributesToMerge = array();
        foreach ($node->get(0)->attributes as $nodeElement) {
            if (array_key_exists($nodeElement->name, $attributes) === false) {
                $attributesToMerge[$nodeElement->name] = $nodeElement->value;
            }
        }


        $component->addAttributes($attributesToMerge);
        unset($attributesToMerge);
    }

    public function replaceMarkupNode(phpQueryObject $existingNode, $newNode)
    {
        $this->log->debug("Replacing Markup Node : ".$existingNode." with ".$newNode);
        $existingNode->replaceWith($newNode);
    }


    private function renderComponent(phpQueryObject $node, ComponentStub $component)
    {

        $contentHtml = $node->html();
        $this->log->debug("applying parameters " . $component->getId());
        $this->applyParameters($node, $component);
        $this->log->debug("rendering component " . $component->getId());
        $content = $component->render($this, $contentHtml);
        $this->log->debug("Rendered Componenet " . $content);
        return $content;
    }

    public function getDocument()
    {
        return phpQuery::getDocument($this->dom->getDocumentID());
    }

    private function pidSelector($component)
    {
        return "[" . MarkupConstants::ID_ATTR . "=" . $component->getId() . "]";
    }

    public function getMarkupPath()
    {
        return $this->markupPath;
    }

    public static function getMarkupNameFromScript($scriptName)
    {
        $markup = str_replace(".php", ".html", $scriptName);
        return $markup;
    }

    public static function getCurrentScriptMarkup()
    {
        return MarkupParser::getMarkupNameFromScript(MarkupParser::getCurrentScript());
    }

    public static function getCurrentScript()
    {
        return $_SERVER['SCRIPT_NAME'];
    }

    public static function getCurrentMarkupName(){
        return MarkupParser::getMarkupNameFromScript($_SERVER['SCRIPT_FILENAME']);
    }

    public function appendChildNode(phpQueryObject $node,$content){
        $node->append($content);
    }

    public function guessTagNameFromMarkup(ComponentStub $component)
    {
        $tagname = $this->getTagForComponent($component)->get(0)->nodeName;
        $this->log->debug("Trying to guess TagName from Markup - ".$tagname." for component ".$component->getId());
        return $tagname;
    }

    public function findFirstTagByName($name){
        $pidSelector = "'".$name."'";
        return pq($pidSelector, $this->dom->getDocumentID());
    }
}
