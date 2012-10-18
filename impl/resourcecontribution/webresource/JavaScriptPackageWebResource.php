<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 12:07
 * To change this template use File | Settings | File Templates.
 */
class JavaScriptPackageWebResource extends PackageWebResource
{
    public function JavaScriptPackageWebResource($folder,$identifier){
        $this->PackageWebResource($folder,"js",new JavaScriptResourceRenderer(),$identifier);
    }
}
