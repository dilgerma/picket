<?php
/**
 *
 * Empty Tag that is used for example to render
 * panels, that dont have own markup.
 *
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 22:15
 * To change this template use File | Settings | File Templates.
 */
class EmptyTagRenderer extends TagRenderer
{

    public function EmptyTagRenderer(){
    }

    public function renderCloseTag()
    {
        return "";
    }

    public function renderOpenTag()
    {
        return "";
    }


}
