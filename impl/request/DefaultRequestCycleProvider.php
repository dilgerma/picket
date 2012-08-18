<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:04
 * To change this template use File | Settings | File Templates.
 */
class DefaultRequestCycleProvider implements RequestCycleProvider
{

    public function newRequestCycle($component)
    {
        return new SimpleRequestCycle($component);
    }

}
