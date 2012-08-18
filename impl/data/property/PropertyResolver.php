<?php
/**
 * Created by IntelliJ IDEA.
 * User: dilgerma
 * Date: 17.07.12
 * Time: 22:55
 * To change this template use File | Settings | File Templates.
 */
class PropertyResolver
{
    public function resolveProperty($object, $expression){
        $expressions = $this->expressionExplode($expression);
        $result = $this->traverse($object,$expressions,null);
        return $result;
    }

    public function setProperty($object, $expression, $value){
        $expressions = $this->expressionExplode($expression);
        $this->traverse($object, $expressions, $value);
    }

    public function traverse($obj,array $expressions,$value){
        if(count($expressions) === 0){
            return $obj;
        }

        if(count($expressions) === 1 && is_null($value) === false){
            call_user_func(array($obj, $this->findSetter(array_shift($expressions))),$value);
            return;
        }


        $shifted = array_shift($expressions);
        return $this->traverse(call_user_func(array($obj,$this->findGetter($shifted))),$expressions,$value);
    }

    public function expressionExplode( $expression){
        return explode(".",$expression);
    }

    public function findGetter($expression){
        return $method = "get".ucfirst($expression);
    }

    public function findSetter($expression){
        return $method = "set".ucfirst($expression);
    }
}
