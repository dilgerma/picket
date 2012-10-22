<?php
/**
 * A Model that reads a Markup File and escapes all html entities
 */
class EscapingMarkupModel implements IModel
{

    private $file;

    public function __construct($file){
         $this->file = $file;
    }

    public function getValue()
    {
        return EscapeMarkup::escape(file_get_contents($this->file));
    }

    public function setValue($value)
    {
        // TODO: Implement setValue() method.
    }
}
