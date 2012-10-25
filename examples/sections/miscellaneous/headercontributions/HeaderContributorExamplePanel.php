<?php

/**
 *
 */
//code start
class HeaderContributorExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        $container = new WebMarkupContainer("componentExample",new EmptyModel());
        /*
         * Every component can contribute to the head section.
         * Precondition is, your components need to be placed on a webpage (not rendered directly to the markup) and
         * your page needes a head section in its markup.
         * */
        $label = new Label("label", new SimpleModel("Even labels can contribute to the head-section"));
        $container->add($label);
        /*
         * just add a headercontributor and a corresponding webresource (for example javascript or css)
         * JavaScriptPackageResource takes all javascript-files that it can find and renders <script/>-section for each
         * */
        $label->addBehavior(new HeaderContributor(new JavaScriptPackageWebResource("resources",$this,"scripts")));
        /*
         * the identifier takes care, that resources are not rendered twice.
         * The resource below will not get rendered, as there is already a resource with name "scripts"
         * */
        $label->addBehavior(new HeaderContributor(new JavaScriptPackageWebResource("resources",$this,"scripts")));

        /*
         * No matter where you place your contributions, the page takes responsibility to render them
         * CSSPackackeResource takes all css-files that it can find and renders link-elements for each.
         * */
        $container->addBehavior(new HeaderContributor(new CSSPackageWebResource("resources",$this,"css")));
        /*
         * If you dont want to use PackageResources, you can easily declare all css or script resources on your own.
         * Notice, it doesnt matter if you declare your resources with a leader "/" or not.
         * */
        $this->addBehavior(new HeaderContributor(new CSSWebResource("/single/single-style.css",$this,"single-css")));

        /*
         * Look at the source of the page how the contributions get rendered.
         * */
        $this->add($container);
    }
}

/*
 * This is the script that is placed in the folder resources, relative to this component
 *
 * alert('I´ a script and I was rendered by a Header Contribution');
 *
 * This is the css, that is placed in the resources folder
 *
 *  .headercontribution{
 *    border: 1px solid red;
 *    background: #cccccc;
 *  }
 *
 * This is the css in single-style.css
 *  .single-file{
 *   font-family: Helvetica;
 *   font-size: 20px;
 *  }
 * */
//code end
