<?php
include_once __DIR__ . '/../BaseTestCase.php';
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 21:19
 * To change this template use File | Settings | File Templates.
 */
class SimpleTestPanel extends Panel
{
      public function SimpleTestPanel(){
          $this->Panel("testObject",new SimpleModel(""));
          $this->add(new TextField("text", new SimpleModel("blubb")));
      }
}
