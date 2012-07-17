<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 13:00
 * To change this template use File | Settings | File Templates.
 */
class DropDown extends FormComponentStub
{

    public static function createWithOptions($id, $model, $options)
    {
        $dropDown = new DropDown($id, $model);
        foreach ($options as $key => $value) {
            $dropDown->add(
                new DropDownOption(ComponentStub::concatenateId($id, $key),
                    new SimpleModel($value), $dropDown->getModel()));
        }
        return $dropDown;
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "select";
    }

    public function getTagBody()
    {
        $content = "";
        foreach ($this->fields() as $field) {
            $content .= $field->renderTag() . "<br/>";
        }
        return $content;
    }


    public function getType()
    {
        return null;
    }
}
