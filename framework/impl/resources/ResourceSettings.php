<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 22:32
 * To change this template use File | Settings | File Templates.
 */
class ResourceSettings
{
   private $throwExceptionOnResourceMissing = false;

    public function isThrowExceptionOnResourceMissing(){
        return $this ->throwExceptionOnResourceMissing;
    }

    public function throwExceptionOnResourceMissing(){
        $this->throwExceptionOnResourceMissing = true;
    }
}
