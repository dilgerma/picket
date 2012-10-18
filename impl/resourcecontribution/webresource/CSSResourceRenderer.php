<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 15:52
 * To change this template use File | Settings | File Templates.
 */
class CSSResourceRenderer implements ResourceRenderer
{

    public function render($resource)
    {
        return "\n<link href=\"".$resource."\" rel=\"stylesheet\">\n";

    }
}
