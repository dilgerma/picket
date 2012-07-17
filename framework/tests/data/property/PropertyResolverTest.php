<?php
include_once __DIR__ . '/../../BaseTestCase.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 23:22
 * To change this template use File | Settings | File Templates.
 */
class PropertyResolverTest extends BaseTestCase
{
    private $propertyResolver;

    public function setUp(){
        $this->propertyResolver = new PropertyResolver();
    }

    public function tearDown(){
        unset($this->propertyResolver);
    }

    public function testFindGetter(){
        $propertyResolver = new PropertyResolver();
        $this->assertEquals("getName",$propertyResolver->findGetter("name"));
    }

    public function testExpressionExplode(){
        $expression = "contact.address.street";
        $exploded = $this->propertyResolver->expressionExplode($expression);
        $this->assertEquals(3, count($exploded));
        $this->assertEquals("contact",$exploded[0]);
        $this->assertEquals("address",$exploded[1]);
        $this->assertEquals("street",$exploded[2]);
    }

    public function testTraverse(){
        $textField = new TextField("test", new SimpleModel("test-value"));
        $expression = "model.value";
        $value = $this->propertyResolver->resolveProperty($textField,$expression,null);
        $this->assertEquals("test-value",$value);
    }

    public function testTraverseSetter(){

        $street = new Street("test-street","23");
        $address = new Address($street);

        $textField = new TextField("test", new PropertyModel($address,"street.houseNumber"));
        $this->assertEquals("23",$textField->getModel()->getValue());

        $textField->getModel()->setValue("abc");
        $this->assertEquals("abc",$textField->getModel()->getValue());
        $this->assertEquals("abc",$street->getHouseNumber());

    }
}

class Address {
    private $street;

    public function Address($street){
        $this->street = $street;
    }

    public function getStreet(){
        return $this->street;
    }

}

class Street {
    private $streetName;
    private $houseNumber;

    public function Street($streetName, $houseNumber){
        $this->streetName = $streetName;
        $this->houseNumber = $houseNumber;
    }

    public function getStreetName(){
        return $this->streetName;
    }

    public function getHouseNumber(){
        return $this->houseNumber;
    }

    public function setHouseNumber($houseNumber){
        $this->houseNumber = $houseNumber;
    }

}