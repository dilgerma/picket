<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 15:15
 * To change this template use File | Settings | File Templates.
 */
class DefaultMessageFilter implements MessagesFilter
{

    public function accepts(FeedbackMessage $message)
    {
        return true;
    }
}
