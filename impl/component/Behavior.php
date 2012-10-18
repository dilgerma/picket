<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 18.07.12
 * Time: 10:22
 * To change this template use File | Settings | File Templates.
 */
interface Behavior extends RequestCycle, Bindable
{
    /**
     * Only considered if your components are placed within a WebPage and not rendered directly.
     *
     * @abstract
     * @param MarkupParser $parser
     * @return HeaderContribution
     */
    public function renderHead(MarkupParser $parser);
}
