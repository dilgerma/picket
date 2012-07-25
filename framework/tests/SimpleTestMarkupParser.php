<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 22.07.12
 * Time: 11:56
 * To change this template use File | Settings | File Templates.
 */
class SimpleTestMarkupParser extends MarkupParser
{
     public function SimpleTestMarkupParser($fileName){
         $this->MarkupParser(__DIR__."/testmarkup/".$fileName);
     }
}
