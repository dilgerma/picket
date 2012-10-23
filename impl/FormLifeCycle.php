<?php
/**
 * indicates that this components wants to participate in the form lifecycle,
 * so accepts submits, is recognized by the form submit listener and delegates
 * form submits to its children.
 */
interface FormLifeCycle
{
    public function onValidate($value);

    public function hasErrors();

    public function onUpdateModel($value);

    public function onSubmit();
}
