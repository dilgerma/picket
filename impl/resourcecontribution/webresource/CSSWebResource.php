<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 15:33
 * To change this template use File | Settings | File Templates.
 */
class CSSWebResource extends DefaultWebResource
{

    public function CSSWebResource($resource,$identifier){
        $this->DefaultWebResource($resource,new CSSResourceRenderer(),$identifier);
    }
}
