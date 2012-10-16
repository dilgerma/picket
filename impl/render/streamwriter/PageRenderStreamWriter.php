<?php
/**
 *
 * Renders the complete stream into the page.
 * ALl Tags, and replacements.
 *
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 14:42
 * To change this template use File | Settings | File Templates.
 */
class PageRenderStreamWriter implements RenderStreamWriter
{

    public function renderToStream(MarkupParser $markupParser, $content)
    {
         echo $markupParser->getDocument()->htmlOuter();
    }
}
