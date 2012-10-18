<?php
include_once __DIR__ . '/../BaseTestCase.php';
require_once __DIR__."/test-class-hierarchies/WebPageChild.php";
require_once __DIR__."/test-class-hierarchies/ChildPageWithMarkup.php";
require_once __DIR__."/test-class-hierarchies/parent/WebPageParent.php";
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 18.10.12
 * Time: 16:31
 * To change this template use File | Settings | File Templates.
 */
class MarkupResolverTest extends BaseTestCase
{
     public function testResolveParentMarkup(){
         $child = new WebPageChild("test",new EmptyModel());
         $resolver = new ParentMarkupResolver();
         $file = $resolver->resolveMarkup($child);
         $this->assertTrue(Strings::endsWith($file,"WebPageParent.html"));
     }

    public function testResolveChildMarkup(){
         $child = new ChildPageWithMarkup("test",new EmptyModel());
         $resolver = new ParentMarkupResolver();
         $file = $resolver->resolveMarkup($child);
         $this->assertTrue(Strings::endsWith($file,"ChildPageWithMarkup.html"));
     }
}
