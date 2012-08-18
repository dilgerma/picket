<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 13:28
 * To change this template use File | Settings | File Templates.
 */
class SubmitLink extends SubmitButton
{


    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "input";
    }

    public function getType()
    {
        return "submit";
    }
}
