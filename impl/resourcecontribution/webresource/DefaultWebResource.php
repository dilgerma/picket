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

    /**
     * identifier that is used to distinguish already rendered resources,
     * typically this is just the filename, maybe with the path...
     * @var
     */
    private $identifier;

    protected  $log;

    public function DefaultWebResource($path,ResourceRenderer $renderer,$identifier){
        $this->log = Logger::getLogger("DefaultWebResource");
        if(is_null($identifier) || $identifier === ""){
            throw new Exception("you must not use header resources without identifier, use the file name");
        }
        $this->renderer = $renderer;
        $this->identifier = $identifier;
        if(is_array($path)){
            $this->path = $path;
        } else {
            $this->path = array();
            array_push($this->path,$path);
        }
    }

    public function getIdentifier(){
        return $this->identifier;
    }

    public function render()
    {
        $resources = "";
        foreach($this->path as $resource){
            $resources.=$this->renderer->render(Files::toLocalPath($resource));
        }
        return $resources;

    }

}
