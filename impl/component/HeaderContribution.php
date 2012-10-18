<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 11:41
 * To change this template use File | Settings | File Templates.
 */
class HeaderContribution
{
   private $resource;
   private $identifier;

    public function HeaderContribution($resource, $identifier){
        $this->resource = $resource;
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getResource()
    {
        return $this->resource;
    }


}
