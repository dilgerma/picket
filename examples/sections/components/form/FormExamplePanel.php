<?php
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
