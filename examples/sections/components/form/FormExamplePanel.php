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
 * User: martindilger
 * Date: 22.10.12
 * Time: 10:42
 * To change this template use File | Settings | File Templates.
 */
//code start
class FormExamplePanel extends Panel
{
    public function __construct($id)
    {
        parent::Panel($id, new EmptyModel());
        $contact = new Contact("", "test@test.de", "");
        $this->add(new Label("result", new SimpleModel($contact)));
        $form = new Form("form", new SimpleModel($contact));
        $this->add(new FeedbackPanel("feedback",$form));
        //to use property models, your domain model needs getters and setters
        $nameField = new TextField("name", new PropertyModel($contact, "name"));
        $nameField->addValidator(new nameValidator());
        $form->add($nameField);
        $form->add(new TextField("email", new PropertyModel($contact, "email")));

        //radio group
        $radioGroup = new RadioGroup("group", new SimpleModel(""));
        $radioGroup->add(new RadioButton("radioDinner", new SimpleModel("dinner")));
        $radioGroup->add(new RadioButton("radioLunch", new SimpleModel("breakfast")));
        $radioGroup->add(new RadioButton("radioBreakfast", new SimpleModel("lunch")));
        $form->add($radioGroup);

        //provide a function that is called when the form is submitted
        $form->setSubmitCallback(function() use ($form)
        {
            echo "<script language='JavaScript'>alert('" . $form->getModel()->getValue() . "')</script>";
        });
        $this->add($form);
    }
}

class nameValidator implements  Validator {


    public function validate(ComponentStub $component, $value)
    {
       if("hans"===$value){
           $component->error("Name must not be hans!!");
       }
    }
}

class Contact
{

    private $name;
    private $email;
    private $contactReason;

    public function __construct($name, $email, $contactReason)
    {
        $this->name = $name;
        $this->email = $email;
        $this->contactReason = $contactReason;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setContactReason($contactReason)
    {
        $this->contactReason = $contactReason;
    }

    public function getContactReason()
    {
        return $this->contactReason;
    }

    function __toString()
    {
        return $this->name . " " . $this->email . " " . $this->contactReason;
    }

}

//code end
