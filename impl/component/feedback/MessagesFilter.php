<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 19.07.12
 * Time: 15:12
 * To change this template use File | Settings | File Templates.
 */
interface MessagesFilter
{
    public function accepts(FeedbackMessage $message);


}
