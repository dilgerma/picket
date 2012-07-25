<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 20.07.12
 * Time: 16:14
 * To change this template use File | Settings | File Templates.
 */
interface ComponentRenderer
{
    /**
     * renders a Tag and all attributes.
     * @return string
     */
    public function renderOpenTag();

    public function renderBody(MarkupParser $markupParser);
    /*
     * renders the closing tag.
     * */
    public function renderCloseTag();

    public function render(MarkupParser $markupParser);

    public function setStreamWriter(RenderStreamWriter $writer);
}
