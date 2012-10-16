<?php
/**
 * Created by IntelliJ IDEA.
 * User: martindilger
 * Date: 16.10.12
 * Time: 15:23
 * To change this template use File | Settings | File Templates.
 */
abstract class DefaultWebResource implements WebResource
{

    /**
     * The location, for example /scripts/jquery.js
     * Accepts both a single String or an Array of Strings.
     * @var array|string
     */
    private $path;

    private $renderer;

    protected  $log;

    public function DefaultWebResource($path,ResourceRenderer $renderer){
        $this->log = Logger::getLogger("DefaultWebResource");
        $this->renderer = $renderer;
        if(is_array($path)){
            $this->path = $path;
        } else {
            $this->path = array();
            array_push($this->path,$path);
        }
    }


    public function render($component)
    {
        $resources = "";
        foreach($this->path as $resource){
            $resources.=$this->renderer->render($resource);
        }
        return $resources;

    }

}
