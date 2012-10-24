<?php
/**
 *
 */
class WebPageExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        //code start
        $webPage = new WebPage("componentExample",new SimpleModel("How to render a webPage"));
        $webPage->add(new Label("labelOnAPage", new SimpleModel("Label gets rendered")));
        //this is a wrong example, as webpages typically stand only for their own. Look at the docs in WebPage to see how it is
        //supposed to work
        $this->add($webPage);
        //code end
    }
}
