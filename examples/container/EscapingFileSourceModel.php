<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 11:28
 * To change this template use File | Settings | File Templates.
 */
class EscapingFileSourceModel implements IModel
{
    private $file;

    public function __construct($file){
        $this->file = $file;
    }

    public function getValue()
    {
        $content = file_get_contents($this->file);
        return EscapeMarkup::escape($content);
    }

    public function setValue($value)
    {
        // TODO: Implement setValue() method.
    }
}
