<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */
class ParentMarkupResolver implements MarkupResolver
{

    public function resolveMarkup(ComponentStub $component)
    {
        $file =  $component->getPackage();
        $markup = MarkupParser::getMarkupNameFromScript($file);
        if(file_exists($markup)){
            return $markup;
        }

        while(!file_exists($markup = $this->getParentMarkup($component))){
        }
        return $markup;
    }

    private function getParentMarkup(ComponentStub $component){
        $clazz  =new ReflectionObject($component);
        return MarkupParser::getMarkupNameFromScript($clazz->getParentClass()->getFileName());
    }
}
