<?php

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 12:35
 * To change this template use File | Settings | File Templates.
 */
abstract class ComponentStub implements Component, Tag, LifeCycle
{

    private $id;
    private $model;
    private $fields = array();
    private $visible = true;
    private $renderer;
    private $attributes = array();
    /**
     * @var RequestCycle
     */
    private $requestCycle;
    private $behaviors = array();
    private $feedbackMessages;
    protected $log;

    private $markupParser;

    /**
     * Component needs either a MarkupParser parsed directly or it takes the one
     * given by its parent.
     *
     * @param $id
     * @param $model
     * @param null $markupParser
     */
    public function ComponentStub($id, $model)
    {
        $this->id = $id;
        $this->model = $model;
        $this->log = Logger::getLogger("Component");
        $this->renderer = new TagRenderer($this);
        $this->addAttributes(array("pid" => $this->getId()));
        $this->requestCycle = Configuration::getConfigurationInstance()->
            requestCycleProvider()->newRequestCycle($this);
        $this->requestCycle->onInitialize();
        $this->feedbackMessages = new FeedbackMessages();
    }

    /**
     * @return RequestCycle
     */
    public function getRequestCycle()
    {
        return $this->requestCycle;
    }

    /**
     * @return the Id of this component
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param $component
     * @return mixed
     */
    public function add(ComponentStub $component)
    {
        if ($component instanceof Bindable) {
            $component->bind($this);
        }
        array_push($this->fields, $component);
    }

    /**
     * @return ComponentStub
     */
    public function fields()
    {
        return $this->fields;
    }

    public function isVisible()
    {
        return $this->visible;
    }

    public function setVisible($visible){
        $this->visible = $visible;
    }

    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @return IModel
     */
    public function getModel()
    {
        return $this->model;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }


    public function addAttributes($attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    public function appendAttribute(array $attributes)
    {
        foreach ($attributes as $key => $value) {

            if (array_key_exists($key, $this->attributes)) {

                $value = $this->attributes[$key];
                $value .= " " . $attributes[$key];
                $this->attributes = array_replace($this->attributes, array($key => $value));
            } else {
                $this->addAttributes($attributes);
            }
        }
    }

    protected function setTagRenderer(TagRenderer $tagRenderer)
    {
        $this->renderer = $tagRenderer;
    }

    public function getTagRenderer()
    {
        return $this->renderer;
    }


    /**
     * Configures this instance and afterwards all the childs.
     *
     * If you take a Form as an example, first the forms configure-
     * method is called which updates all the models and afterwards,
     * all the child components configure is called, which
     * changes some states depending on the type of component.
     * for example dropdowns check, whether the model has changed
     * and set the selected value accordingly.
     *
     * scriptname-componentId
     *                          ~
     * @return mixed
     */
    public final function render(MarkupParser $markupParser)
    {


        $this->log->debug("rendering " . $this->getId());
        $this->getRequestCycle()->onMarkupTag();
        $this->attachMarkup($markupParser);
        $markupParser->applyParameters($markupParser->getTagForComponent($this), $this);
        $this->getRequestCycle()->onBeforeRender();
        if ($this->isVisible()) {
            $this->log->debug("rendering component " . $this->getId() . " to markup " . is_null($markupParser) ? "" : $markupParser->getMarkupPath());
            $this->configure();
            $this->getRequestCycle()->onRender();
            $content = $this->getTagRenderer()->render($markupParser);
            $this->getRequestCycle()->onAfterRender();
            $this->getRequestCycle()->onDetach();
        } else {
            $markupParser->getTagForComponent($this)->remove();
            $content = "";
        }
        return $content;


    }

    /**
     * Provides the possibility for containers to attach their markup
     * to the final markup before the component is rendered.
     * @param MarkupParser $markupParser
     */
    protected function attachMarkup(MarkupParser $markupParser)
    {
        //nothing to do for simple components.
    }

    /**
     * configure is used to configure this component.
     * Not all components do have behavior that needs to be
     * configured, for example a form checks, whether there
     * are any request parameters for the form
     * itself of any of its children.
     */
    public final function configure()
    {

        $this->innerConfigure();
        foreach ($this->fields() as $field) {
            $field->configure();
        }
    }

    protected function innerConfigure()
    {
    }

    public function addBehavior(Behavior $behavior)
    {
        $behavior->bind($this);
        array_push($this->behaviors, $behavior);
    }

    public function getBehaviors()
    {
        return $this->behaviors;
    }

    /**
     *
     * @abstract
     * @return the folder of this class, typically this will be implemented like
     * dirname(__FILE__)
     */
    public function getPackage()
    {
        $reflectOnThis = new ReflectionClass($this);
        return $reflectOnThis->getFileName();
    }

    /**
     * Concatenates 2 ids.
     * @static
     * @param $id
     * @param $additionalId
     * @return string
     */
    public static function concatenateId($id, $additionalId)
    {
        return $id . ":" . $additionalId;
    }

    public function getFeedbackMessages()
    {
        return $this->feedbackMessages;
    }

    public function info($message){
        $this->feedbackMessages->addMessage(new FeedbackMessage($message,Level::INFO));
    }

    public function error($message)
    {
        $this->feedbackMessages->addMessage(new FeedbackMessage($message, Level::ERROR));
    }

    public function hasErrors()
    {
        $collector = new FeedbackMessagesCollector(new FeedbackMessagesLevelFilter(Level::ERROR));
        $this->visit($collector);
        return $collector->hasMessages();
    }

    public final function visit(IVisitor $visit)
    {
        foreach ($this->fields() as $field) {
            $field->visit($visit);
        }
        $visit->visit($this);
        return $visit;
    }

    public final function visitFunction($function)
    {
        foreach ($this->fields() as $field) {
            $field->visitFunction($function);
        }
        call_user_func($function, $this);
    }

    //simple components have no associated markup
    public function hasAssociatedMarkup()
    {
        return false;
    }

    /**
     * Per default, a Component shows its model value in its body.
     * @return mixed
     */
    public function getDisplayValue()
    {
        return $this->getModel()->getValue();
    }

    public function getTagName()
    {
        return null;
    }

    /*
     * Direct Render
     * Renders this component directly to the current script.
     * */
    public function renderDirectly(){
        $this->getTagRenderer()->setStreamWriter(new DirectRenderToStreamWriter($this));
        $this->render(new MarkupParser($_SERVER['SCRIPT_FILENAME']));
    }

    /*
     * Lifecycle Callbacks
     * */
    public function onMarkupTag()
    {
    }

    public function onRender()
    {
    }

    public function onBeforeRender()
    {
    }

    public function onAfterRender()
    {
    }

    public function onInitialize()
    {
    }

    public function onDetach()
    {
    }


}
