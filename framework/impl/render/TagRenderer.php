<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 14.07.12
 * Time: 08:05
 * To change this template use File | Settings | File Templates.
 */
class TagRenderer
{
    /*
     * type Tag
     * */
    private $tag;

    public function __construct($tag){
        $this->tag = $tag;
    }

    /**
     * renders a Tag and all attributes.
     * @return string
     */
    public function renderOpenTag(){
        $tag = "<".$this->tag->getTagName()." ";
        $attributes = $this->tag->getAttributes();

        foreach(array_keys($attributes) as $attribute){
            $tag.=$attribute."='".$attributes[$attribute]."' ";
        }
        $tag.=">";
        return $tag;
    }

    /*
     * renders the closing tag.
     * */
    public function renderCloseTag(){
        return "</".$this->tag->getTagName().">";
    }

}

?>