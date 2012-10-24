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
