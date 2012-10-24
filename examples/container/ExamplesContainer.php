<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 22.10.12
 * Time: 10:18
 * To change this template use File | Settings | File Templates.
 */
class ExamplesContainer extends Panel
{
    const example_markup_id = "live-example";
    /**
     *
     * @var ComponentStub
     */
    private $exampleComponent;

    /*
     * The simple Name of the example class, for example 'Label'
     * */
    private $nameOfExampleClass;

   public function __construct($id,ComponentStub $exampleComponent,$nameOfExampleClass){
       parent::Panel($id, new EmptyModel());
       $this->exampleComponent = $exampleComponent;
       $this->nameOfExampleClass = $nameOfExampleClass;
       $this->add(new Label("markup",$this->getExampleMarkupModel()));
       $this->add(new Label("code",$this->getExampleMarkupCodeModel()));
       $this->add(new Label("description",$this->getDescriptionModel()));
       $this->add(new Label("sourceCode",$this->getSourceCodeModel()));
       $this->add($this->exampleComponent);
   }

    /**
     * @abstract
     * @return IModel the path of a markupfile that is to be displayed in the markup section, may return null, then the whole markup section will be invisible.
     */
    protected function getExampleMarkupModel(){
        return new EscapingMarkupModel(MarkupParser::getMarkupNameFromScript($this->exampleComponent->getComponentFile()));
    }

    /**
     * Returns the Code to be displayed.
     * @abstract
     * @return mixed
     */
    protected function getExampleMarkupCodeModel(){
        return new EscapingCodeModel($this->exampleComponent->getComponentFile());
    }

    protected function getDescriptionModel(){
        return new EscapingDescriptionModel($this->nameOfExampleClass);
    }

    protected function getSourceCodeModel(){
        $reflectionClass = new ReflectionClass($this->nameOfExampleClass);
        return new EscapingFileSourceModel($reflectionClass->getFileName());
    }

}
