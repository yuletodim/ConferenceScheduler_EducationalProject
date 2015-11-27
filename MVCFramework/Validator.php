<?php
/**
 * Created by PhpStorm.
 * User: Yulia
 * Date: 27.11.2015
 * Time: 19:42
 */

namespace MVCFramework;

class Validator
{
    private $_rules = array();
    private $_errors = array();

    public function setRule($rule, $value, $params = null, $name = null){
        $this->_rules[] = array(
            'value' => $value,
            'rule' => $rule,
            'params' => $params,
            'name' => $name);
        return $this;
    }

    public function validate(){
        $this->_errors = array();
        if(count($this->_rules) > 0){
            foreach($this->_rules as $value){
                if(!$this->$value['rule']($value['value'], $value['params'])){
                    if($value['name']){
                        $this->_errors[] = $value['name'];
                    } else {
                        $this->_errors[] = $value['rule'];
                    }
                }
            }
        }

        return (bool)!count($this->_errors);
    }

    public function getErrors(){
        return $this->_errors;
    }

    public function __call($a, $b){
        throw new \Exception('Invalid validation rule.', 500);
    }

    public static function required($value){
        if(is_array($value)){
            return !empty($value);
        } else {
            return $value != '';
        }
    }

    public static function matches($val1, $val2){
        return $val1 == $val2;
    }

    public static function matchesStrict($val1, $val2){
        return $val1 === $val2;
    }

    public static function different($val1, $val2){
        return $val1 != $val2;
    }

    public static function differentStrict($val1, $val2){
        return $val1 !== $val2;
    }

    public static function minLength($value, $criteria){
        return (mb_strlen($value) >= $criteria);
    }

    public static function maxLength($value, $criteria){
        return (mb_strlen($value) <= $criteria);
    }

    public static function exactLength($value, $criteria){
        return (mb_strlen($value) == $criteria);
    }

    public static function greater($value, $criteria){
        return ($value > $criteria);
    }

    public static function lesser($value, $criteria){
        return ($value < $criteria);
    }

    public static function numeric($value){
        return is_numeric($value);
    }

    public static function email($value){
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function url($value){
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    public static function ip($value){
        return filter_var($value, FILTER_VALIDATE_IP) !== false;
    }

    public static function regex($pattern, $value){
        return (bool)preg_match($pattern, $value);
    }
}