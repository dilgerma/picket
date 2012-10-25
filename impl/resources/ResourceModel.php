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
DISCLAIMED. IN NO EVENT SHALL EffectiveTrainings BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


/**
 * //desc start
 * Resource Model allows you to externalize some strings.
 * What you need to do in order to use a resource model is to
 * provide a Class in the same package structure as your component with _resource ending.
 *
 * So if you create a Panel TestPanel.php, you need to declare a new Class TestPanel_resource.php
 * in a File with the same name.
 *
 * In this class you can then declare const-values, for example
 *
 * const theKey = "display me!"
 *
 * Within TestPanel, you can use a Resource Model like this:
 *
 * $this->add(new Label("someId", new ResourceModel("theKey",$this);
 *
 * And the Label will display the value of the const named "theKey"
 *
 * @author Martin Dilger
 * //desc end
 */
class ResourceModel implements IModel
{

    private $key;
    private $component;

    public function ResourceModel($key, ComponentStub $component){
       $this->key = $key;
        $this->component = $component;
    }

    public function getValue()
    {
        $locator = Configuration::getConfigurationInstance()->resourceLocatorProvider()->get();
        return $locator->getResource($this->key,$this->component);
    }

    public function setValue($value)
    {
        //noop
    }
}
