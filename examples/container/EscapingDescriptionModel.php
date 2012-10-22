<?php
/**
 * Just reads the javadoc of the given class file.
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 11:21
 * To change this template use File | Settings | File Templates.
 */
class EscapingDescriptionModel implements IModel
{
    const desc_start = "//desc start";
    const desc_end = "//desc end";

    private $file;

    public function __construct($file){
        $clazz = new ReflectionClass($file);
        $this->file = $clazz->getFileName();
    }

    public function getValue()
    {
        return htmlspecialchars(Strings::getInBetween(Files::getFileContent($this->file),EscapingDescriptionModel::desc_start,EscapingDescriptionModel::desc_end));
    }

    public function setValue($value)
    {
        // TODO: Implement setValue() method.
    }
}
