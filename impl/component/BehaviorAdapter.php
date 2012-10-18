<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 14:15
 * To change this template use File | Settings | File Templates.
 */
class BehaviorAdapter implements Behavior
{

    public function renderHead(MarkupParser $parser){
          return new HeaderContribution("","");
    }

    public function bind(ComponentStub $component)
    {
        // TODO: Implement bind() method.
    }

    public function onMarkupTag(MarkupParser $markupParser)
    {
        // TODO: Implement onMarkupTag() method.
    }

    public function onRender(MarkupParser $markupParser)
    {
        // TODO: Implement onRender() method.
    }

    public function onBeforeRender(MarkupParser $markupParser)
    {
        // TODO: Implement onBeforeRender() method.
    }

    public function onAfterRender(MarkupParser $markupParser)
    {
        // TODO: Implement onAfterRender() method.
    }

    public function onInitialize()
    {
        // TODO: Implement onInitialize() method.
    }

    public function onDetach()
    {
        // TODO: Implement onDetach() method.
    }

    /**
     * @param $lifecyclePhase a phase as defined in this interface.
     * @param $function the callback functino that may take a component as parameter
     * @return mixed
     */
    public function setCallback($lifecyclePhase, $function)
    {
        // TODO: Implement setCallback() method.
    }
}
