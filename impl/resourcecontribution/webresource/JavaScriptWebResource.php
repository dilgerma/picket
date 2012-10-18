<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 15:33
 * To change this template use File | Settings | File Templates.
 */
class JavaScriptWebResource extends DefaultWebResource
{

    public function JavaScriptWebResource($resource,$identifier){
        $this->DefaultWebResource($resource,new JavaScriptResourceRenderer(),$identifier);
    }
}
