<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 04.08.12
 * Time: 17:37
 * To change this template use File | Settings | File Templates.
 */
class PasswordTextField  extends TextField
{
    public function PasswordTextField($id,IModel $model){
        $this->TextField($id,$model);
    }

    public function getType()
    {
        return "password";
    }


}
