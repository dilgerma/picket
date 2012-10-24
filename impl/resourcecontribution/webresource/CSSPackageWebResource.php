<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 12:07
 * To change this template use File | Settings | File Templates.
 */
class CSSPackageWebResource extends PackageWebResource
{
    public function CSSPackageWebResource($folder,ComponentStub $packageComponent, $identifier){
        $this->PackageWebResource($folder, $packageComponent,"css",new CSSResourceRenderer(),$identifier);
    }
}
