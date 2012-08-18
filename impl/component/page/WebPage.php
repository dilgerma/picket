<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 22.07.12
 * Time: 08:55
 * To change this template use File | Settings | File Templates.
 */
class WebPage extends MarkupContainer
{
    public function WebPage(){
        $this->MarkupContainer(WebPage::WEB_PAGE_ID,new EmptyModel());
        $this->getTagRenderer()->setStreamWriter(new DirectRenderToStreamWriter($this));
    }

    /**
     * markup id that the html tag must have in order
     * to render a page.
     */
    const WEB_PAGE_ID = "webpage";
}
