<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 04.08.12
 * Time: 11:21
 * To change this template use File | Settings | File Templates.
 */
class Link extends ComponentStub
{

    public function Link($id, IModel $hrefModel,IModel $bodyModel = null){
        $this->ComponentStub($id,$bodyModel);
        $this->addAttributes(array("href"=>$hrefModel->getValue()));

        //if we have a body model, replace the current body with the one defined in the model
        if(is_null($bodyModel) === false){
            $this->setTagRenderer(new ModelValueTagBodyRenderer($this));
        }
    }

    /**
     * Gets the Tagname
     * @return mixed
     */
    public function getTagName()
    {
        return "a";
    }


}
