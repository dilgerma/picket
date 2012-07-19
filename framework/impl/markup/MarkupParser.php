<?php
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

    public function MarkupParser($path)
    {
        $this->dom = phpQuery::newDocumentFileHTML($path);
    }

    /**
     * @param ComponentStub $component
     * @return phpQueryObject
     * @throws Exception if no element with the given id was found.
     */
    public function getTagForComponent(ComponentStub $component, phpQueryObject $startNode = null)
    {
        $pidSelector = $this->pidSelector($component);
        if (isset($startNode)) {
            $element = $startNode->find($pidSelector);
        } else {
            $element = pq($pidSelector);
        }

        if ($element->length == 0) {
            $componentId = $component->getId();
            throw new Exception("MarkupElement for " . $componentId . " not found,
            maybe Parameter " . MarkupConstants::ID_ATTR . "=" . $componentId . " is missing or wrong Hierarchy?");
        }

        return $element;
    }

    public function findFirstChildComponentTagWithParentId(ComponentStub $component){
        $node = $this->getTagForComponent($component);
        return $node->children($this->pidSelector($component));
    }

    /**
     * @param $element
     * @param $component
     * @property DOMElement $element
     * @property ComponentStub $component
     *
     *
     */
    public function processDocument(ComponentStub $component, phpQueryObject $startNode = null)
    {

        if ($component->isDynamicallyRendered() === false) {
            $node = $this->getTagForComponent($component, $startNode);
            $this->validateNode($node, $component);
            $this->applyParameters($node, $component);
        }
        foreach ($component->fields() as $field) {
            $this->processDocument($field, $node);
        }
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

    protected function applyParameters(phpQueryObject $node, ComponentStub $component)
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

    public function replaceNodes(ComponentStub $component)
    {
        if ($component->isDynamicallyRendered() === false) {
            $node = $this->getTagForComponent($component);
            $content = $this->renderComponent($node, $component);
            $node->replaceWith($content);
        } ;
        foreach ($component->fields() as $field) {
            $this->replaceNodes($field);
        }
    }



    private function renderComponent(phpQueryObject $node, ComponentStub $component)
    {

        $contentHtml = $node->html();
        $this->applyParameters($node,$component);
        return $component->renderTag($contentHtml);
    }

    public function getDocument()
    {
        return phpQuery::getDocument();
    }

    private function pidSelector($component){
        return "[" . MarkupConstants::ID_ATTR . "=" . $component->getId() . "]";
    }

    public static function getMarkupNameFromScript($scriptName){
        $markup = str_replace(".php",".html",$scriptName);
        return $markup;
    }
}
