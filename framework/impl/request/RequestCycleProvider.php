<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:03
 * To change this template use File | Settings | File Templates.
 */
interface RequestCycleProvider
{
   public function newRequestCycle($component);
}
