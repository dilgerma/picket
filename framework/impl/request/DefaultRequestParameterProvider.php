<?php

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 19:42
 * To change this template use File | Settings | File Templates.
 */
class DefaultRequestParameterProvider implements RequestParameterProvider
{

    public function newRequestParameters()
    {
       return new RequestParameters();
    }
}
