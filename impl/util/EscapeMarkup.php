<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 10:33
 * To change this template use File | Settings | File Templates.
 */
class EscapeMarkup
{
    /**
     * escapes the given markup, so that it can be displayed in the browser
     * @static
     * @param $markup
     */
    public static function escape($markup){
        return htmlspecialchars($markup);
    }
}
