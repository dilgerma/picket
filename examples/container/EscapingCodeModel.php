<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 10:49
 * To change this template use File | Settings | File Templates.
 */
class EscapingCodeModel implements IModel
{

    const code_start = "//code start";
    const code_end = "//code end";

    private $file;

    public function __construct($file){
        $this->file = $file;
    }

    public function getValue()
    {
        $content = file_get_contents($this->file);
        return Strings::getInBetween($content,EscapingCodeModel::code_start,EscapingCodeModel::code_end);
    }

    public function setValue($value)
    {
        // TODO: Implement setValue() method.
    }
}
