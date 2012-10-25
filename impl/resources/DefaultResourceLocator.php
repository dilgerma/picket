<?php
/**
Copyright (c) 2012, Martin Dilger - EffectiveTrainings.de
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
 * Neither the name of the <organization> nor the
names of its contributors may be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL EffectiveTrainings BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 22:13
 * To change this template use File | Settings | File Templates.
 */
class DefaultResourceLocator implements ResourceLocator
{

    private $log;

    const RESOURCE_SUFFIX = "_resource";

    public function DefaultResourceLocator(){
        $this->log = Logger::getLogger("DefaultResourceLocator");
    }

    public function getResource($key, ComponentStub $component = null, $defaultValue = null)
    {
        $resourceName = DefaultResourceLocator::getResourceNameFromScript($component);

        include_once(str_replace(".php","_resource.php",$component->getComponentFile()));
        $resourceReflection = new ReflectionClass($resourceName);
        $this->log->debug("Getting Resource ".$resourceName);
        if($resourceReflection->hasConstant($key)){
           return $resourceReflection->getConstant($key);
        }
        if($defaultValue !== null){
            return $defaultValue;
        }

        $config = Configuration::getConfigurationInstance();
        if($config->resourceSettings()->isThrowExceptionOnResourceMissing()){
            throw new Exception("Missing Resource ".$key." for Component ".$component->getId()." and no default Value");
        }

        return "";

    }

    public static function getResourceNameFromScript(ComponentStub $component)
    {
        if (!is_null($component)) {
            $package = new ReflectionClass($component);
            $package = $package->getName();
            $resourceFile = $package.DefaultResourceLocator::RESOURCE_SUFFIX;
            return $resourceFile;
        }
    }

}
