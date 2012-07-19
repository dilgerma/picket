<?php

/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 12:35
 * To change this template use File | Settings | File Templates.
 */
abstract class ComponentStub implements Component, Tag
{

    private $id;
    private $model;
    private $fields = array();
    private $visible = true;
    private $required = false;
    private $renderer;
    private $attributes = array();
    private $requestCycle;
    private $behaviors = array();


    public function ComponentStub($id, $model)
    {
        $this->id = $id;
        $this->model = $model;
        $this->renderer = new TagRenderer($this);
        $this->requestCycle = Configuration::getConfigurationInstance()->
            requestCycleProvider()->newRequestCycle($this);
        $this->requestCycle->onInitialize();
    }

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
    public function add($component)
    {
        array_push($this->fields, $component);
    }

    public function fields()
    {
        return $this->fields;
    }

    public function isVisible()
    {
        return $this->visible;
    }

    public function isRequired()
    {
        return $this->required;
    }

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

    public function appendAttribute(array $attributes){
        foreach($attributes as $key=>$value){

            if(array_key_exists($key,$this->attributes)){

                $value = $this->attributes[$key];
                $value.=" ".$attributes[$key];
                $this->attributes = array_replace($this->attributes,array($key=>$value));
            } else {
                $this->addAttributes($attributes);
            }
        }
    }

    protected function setTagRenderer(TagRenderer $tagRenderer)
    {
        $this->renderer = $tagRenderer;
    }

    /**
     * Renders the Markup for this component.
     *
     * @param null $bodyContentMarkup optional body markup that is rendered, if the component has itself
     * no body markup.
     * @return string
     */
    public final function renderTag($bodyContentMarkup = null)
    {
        $this->requestCycle->onBeforeRender();
        if ($this->isVisible()) {
            $this->requestCycle->onRender();
            $content = $this->renderMarkupTag($bodyContentMarkup);
            $this->requestCycle->onAfterRender();
            return $content;
        }
    }

    /**
     * override this function to provide a custom
     * way your component is rendered.
     * @return string
     */
    protected function renderMarkupTag($bodyContentMarkup)
    {
        $content = $this->getTagRenderer()->renderOpenTag();
        if (is_null($this->getTagBody())) {
            $content .= $bodyContentMarkup;
        } else {
            $content .= $this->getTagBody();
        }
        $content .= $this->getTagRenderer()->renderCloseTag();
        return $content;
    }


    public function getTagBody()
    {
        return null;
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
     *
     * @return mixed
     */
    public final function render()
    {
        $this->configure();
        foreach ($this->fields() as $field) {
            $field->configure();
        }
        return $this->renderTag();
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

    /**
     * @return true if this component type can be rendered dynamically and thus
     * is not included in markup-validation.
     */
    public function isDynamicallyRendered()
    {
        return false;
    }


    public function addBehavior(Behavior $behavior)
    {
        $behavior->onBind($this);
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
    public function getPackage(){
        $reflectOnThis = new ReflectionClass($this);
        return $reflectOnThis->getFileName();
    }

    /*
     * this method handles everything that needs to be done
     * to initialize a page for usage with picket-components.
     * */
    public static function pageInit()
    {
        session_start();

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


}
