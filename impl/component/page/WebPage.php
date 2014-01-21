<?php
/**
Copyright (c) 2012, Martin Dilger - EffectiveTrainings.de
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
 * Neither the name of the <organization> nor the
names of its contributors may be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL EffectiveTrainings BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * This is an example how WebPages are used:
 *
 * //desc start
 * class testpage extends WebPage
 *  {
 *    public function testpage($id,$model){
 *      $this->WebPage($id,$model);
 *      $this->add(new Label("label",new SimpleModel("hallo welt")));
 *      $this->add(new Label("blubb", new SimpleModel("so lala")));
 *    }
 *  }
 *
 * $testpage = new testpage("webpage",new SimpleModel(""));
 * $testpage->renderDirectly();
 *
 * At the bottom of a page class, always instantiate the page and call render, thus you can call the
 * page directly in the browser.
 *
 * @author Martin Dilger
 * //desc end
 */
class WebPage extends WebMarkupContainer
{
    /**
     * @var MarkupResolver
     */
    private $markupResolver;

    public function WebPage($markupId, $model)
    {
        $this->WebMarkupContainer($markupId, $model);
        $this->markupResolver = new ParentMarkupResolver();
    }

    /**
     * renders all header contributions. ensures that each contribution is rendered once, as long as the
     * identifier is unique.
     * @param MarkupParser $markupParser
     */
    public function onBeforeRender(MarkupParser $markupParser)
    {

        parent::onBeforeRender($markupParser);
        $behaviorCollector = new BehaviorCollector();
        $this->visit($behaviorCollector);

        $collected = $behaviorCollector->getCollectedBehaviors();
        $contributions = array();

        foreach ($collected as $behavior) {
            $headerContribution = $behavior->renderHead($markupParser);
            $this->renderNewHeaderContribution($contributions, $headerContribution, $markupParser);
        }
    }

    /**
     * renders a header contribution only if a contributino with the same identifier
     * was not already rendered.
     * @param $contributions
     * @param $headerContribution
     * @param $markupParser
     */
    private final function renderNewHeaderContribution(&$contributions, $headerContribution, $markupParser)
    {
        if (!array_key_exists($headerContribution->getIdentifier(),$contributions)) {
            $contributions[$headerContribution->getIdentifier()] = $headerContribution->getResource();
            $node = $markupParser->findFirstTagByName("head");
            if ($node->length !== 0) {
                $node->append($contributions[$headerContribution->getIdentifier()]);
            } else {
                $this->log->warn("No Head Section found, cannot render HeaderContributions");
            }
        } else {
            $this->log->warn("Contribution with " . $headerContribution->getIdentifier() . " was already rendered.");

        }
    }


    /*
   * Direct Render
   * Renders this component directly to the current script.
   * */
    public function renderDirectly()
    {
        $this->getTagRenderer()->setStreamWriter(new PageRenderStreamWriter($this));
        $this->render(new MarkupParser($this->markupResolver->resolveMarkup($this)));
    }


}
