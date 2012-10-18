<?php
include_once(__DIR__.'/../BaseTestCase.php');
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 17.10.12
 * Time: 16:44
 * To change this template use File | Settings | File Templates.
 */
class MarkupTester extends BaseTestCase
{

    private $dom;

    /**
     * @var phpQueryObject
     */
    private $node;

    public function MarkupTester($content,$file = true){
        if($file){
            $this->dom = phpQuery::newDocumentFileHTML($content);
        } else {
            $this->dom = phpQuery::newDocumentHTML($content);
        }
    }

    public function tagExists($tag){
        $this->node = $this->name($tag);
        $this->assertTrue($this->node->length > 0);
        return $this;
    }

    public function attributeEquals($attributeName, $value){
        $attribute = $this->node->get(0)->attributes;
        $this->assertEquals($attribute->getNamedItem($attributeName)->nodeValue,$value);
        return $this;
    }

    public function nodeValue($value){
        $nodeValue = $this->node->get(0)->nodeValue;
        $this->assertEquals($nodeValue,$value);
        return $this;
    }

    /**
     * @param $name
     * @return phpQueryObject|QueryTemplatesParse|QueryTemplatesSource|QueryTemplatesSourceQuery
     */
    private function name($name){
        return pq("'".$name."'",$this->node);
    }
}
