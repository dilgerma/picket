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
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 13.07.12
 * Time: 13:14
 * To change this template use File | Settings | File Templates.
 */
class DropDownOption extends FormComponentStub
{

    private $selectionModel;

    public function DropDownOption($id,$model,$selectionModel)
    {
       $this->FormComponentStub($id,$model);
       $this->addAttributes(array("value"=>$this->getModel()->getValue()));
       $this->selectionModel = $selectionModel;
       $this->setTagRenderer(new ModelValueTagBodyRenderer($this));
    }

    public function getTagBody()
    {
        return $this->getModel()->getValue();
    }

    public function innerConfigure()
    {
        if($this->selectionModel->getValue() == $this->getModel()->getValue()){
            $this->addAttributes(array("selected"=>""));
        }
    }

    public function isWithoutMarkup()
    {
        return true;
    }


    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "option";
    }

    public function getType()
    {
        return null;
    }
}
