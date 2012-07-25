<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 15.07.12
 * Time: 18:07
 * To change this template use File | Settings | File Templates.
 */
class Configuration
{

    private static $configuration;

    private $requestCycleProvider;
    private $requestParameterProvider;

    public function Configuration(){
        $this->requestCycleProvider = new DefaultRequestCycleProvider();
        $this->requestParameterProvider = new DefaultRequestParameterProvider();
    }

    public static function getConfigurationInstance(){
        if(!isset(self::$configuration)){
            self::$configuration=new Configuration();
            self::$configuration->configureLogging();
        }
        return self::$configuration;
    }


    public function requestCycleProvider(){
        return $this->requestCycleProvider;
    }

    public function requestParameterProvider(){
        return $this->requestParameterProvider;
    }

    public function setRequestCycleProvider($requestCycleProvider){
        $this->requestCycleProvider = $requestCycleProvider;
    }

    public function setRequestParametersProvider($requestParameterProvider){
        $this->requestParameterProvider = $requestParameterProvider;
    }

    public function configureLogging(){
        Logger::configure(__DIR__."/../../log4pconfig.xml");
    }

    public function getLogger(){
        return Logger::getLogger("main");
    }

}
