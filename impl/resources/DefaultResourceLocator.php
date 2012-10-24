<?php
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
