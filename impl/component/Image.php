<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 04.08.12
 * Time: 11:07
 * To change this template use File | Settings | File Templates.
 */
class Image extends ComponentStub
{
   public function Image($id,$srcModel){
       $this->ComponentStub($id,$srcModel);
       $this->addAttributes(array("src"=>$srcModel->getValue()));
   }

    public function getTagName()
    {
        return "img";
    }


}
