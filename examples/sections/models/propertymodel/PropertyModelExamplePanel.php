<?php
/**
 *
 */
//code start
class PropertyModelExamplePanel extends Panel
{
    public function __construct($id){
        parent::Panel($id,new EmptyModel());
        $adress = new Address("Test-Street","Munich");
        $customer = new Customer("Hans",$adress);

        $container = new WebMarkupContainer("container", new SimpleModel($customer));
        //just access the name of the customer
        $container->add(new Label("name", new PropertyModel($customer,"name")));
        //expressions can be stacked
        $container->add(new Label("street", new PropertyModel($customer,"address.street")));
        //if you supply no model at all, the component-id is automatically used as expression into the parents model
        $container->add(new Label("address.city"));

        $this->add($container);
    }
}

class Customer {
    private $name;
    private $address;

    public function __construct($name,$address){
        $this->name = $name;
        $this->address = $address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Address {
    private $street;
    private $city;

    public function __construct($street, $city){
        $this->street = $street;
        $this->city = $city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getStreet()
    {
        return $this->street;
    }


}
        //code end
