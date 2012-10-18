<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 15:52
 * To change this template use File | Settings | File Templates.
 */
class JavaScriptResourceRenderer implements ResourceRenderer
{

    public function render($resource)
    {
        return "\n<script language='JavaScript' type='text/javascript' src='".$resource."' />\n";

    }
}
