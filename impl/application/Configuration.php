<?php
/**
Copyright (c) 2012, Martin Dilger - EffectiveTrainings.de
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
 * Redistributions of source code must retain the above copyright
notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
notice, this list of conditions and the following disclaimer in the
documentation and/or other materials provided with the distribution.
 * Neither the name of the <organization> nor the
names of its contributors may be used to endorse or promote products
derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
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
    private $resourceLocatorProvider;
    private $resourceSettings;

    public function Configuration(){
        $this->requestCycleProvider = new DefaultRequestCycleProvider();
        $this->requestParameterProvider = new DefaultRequestParameterProvider();
        $this->resourceLocatorProvider = new ResourceLocatorProvider();
        $this->resourceSettings = new ResourceSettings();
    }

    /**
     * @static
     * @return Configuration
     */
    public static function getConfigurationInstance(){
        if(!isset(self::$configuration)){
            self::$configuration=new Configuration();
            self::$configuration->configureLogging();
        }
        return self::$configuration;
    }

    public function resourceLocatorProvider(){
        return $this->resourceLocatorProvider;
    }

    public function requestCycleProvider(){
        return $this->requestCycleProvider;
    }

    public function requestParameterProvider(){
        return $this->requestParameterProvider;
    }

    /**
     * @return ResourceSettings
     */
    public function resourceSettings(){
        return $this->resourceSettings;
    }

    public function setRequestCycleProvider($requestCycleProvider){
        $this->requestCycleProvider = $requestCycleProvider;
    }

    public function setRequestParametersProvider($requestParameterProvider){
        $this->requestParameterProvider = $requestParameterProvider;
    }

    public function setResourceLocatorProvider($resourceLocatorProvider){
        $this->resourceLocatorProvider = $resourceLocatorProvider;
    }

    public function configureLogging(){
        Logger::configure(__DIR__."/../../log4pconfig.xml");
    }

    public function getLogger(){
        return Logger::getLogger("main");
    }


}
