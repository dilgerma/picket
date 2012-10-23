<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 23.10.12
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */
abstract class ChainedModel implements IModel
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    protected function unchainModel($object)
    {
        if ($object instanceof IModel) {
            return $object->getValue();
        } else {
            return $object;
        }
    }


}
