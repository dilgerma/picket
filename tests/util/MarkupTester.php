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

    public function next(){
        $this->node = $this->node->next();
        return $this;
    }

    public function assertTagCount($tag,$num){
        $this->assertEquals($num,pq($tag,$this->node)->length);
    }


    public function attributeEquals($attributeName, $value){
        $attribute = $this->node->get(0)->attributes;
        $this->assertEquals($value,$attribute->getNamedItem($attributeName)->nodeValue);
        return $this;
    }

    public function attributeMissing($attributeName){
        $attribute = $this->node->get(0)->attributes;
        $this->assertNull($attribute->getNamedItem($attributeName));
    }

    public function nodeValue($value){
        $nodeValue = $this->node->get(0)->nodeValue;
        $this->assertEquals($nodeValue,$value);
        return $this;
    }

    public function dumpCurrent(){
        echo $this->node->htmlOuter();
    }

    /**
     * @param $name
     * @return phpQueryObject|QueryTemplatesParse|QueryTemplatesSource|QueryTemplatesSourceQuery
     */
    private function name($name){
        return pq("'".$name."'",$this->node);
    }
}
