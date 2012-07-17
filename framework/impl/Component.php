<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 12:23
 * To change this template use File | Settings | File Templates.
 */
interface Component
{

    /**
     * @abstract
     * @return the Id of this component
     */
    public function getId();

    /**
     * @abstract
     * @param $component
     * @return mixed
     */
    public function add($component);

    /**
     * returns all fields that are added to this component
     * @abstract
     * @return mixed
     */
    public function fields();

}
