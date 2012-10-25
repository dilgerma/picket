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
