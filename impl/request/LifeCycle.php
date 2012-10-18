<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 01.08.12
 * Time: 18:39
 * To change this template use File | Settings | File Templates.
 */
interface LifeCycle
{
    public function onMarkupTag(MarkupParser $markupParser);

    public function onRender(MarkupParser $markupParser);

    public function onBeforeRender(MarkupParser $markupParser);

    public function onAfterRender(MarkupParser $markupParser);

    public function onInitialize();

    public function onDetach();
}
