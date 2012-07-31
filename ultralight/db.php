<?php

abstract class Ultralight_Db {
  
  public static function factory($args) {
    $type = ucfirst($args['type']) ;
    $class_name = "Ultralight_Db_{$type}" ;
    return $class_name::getInstance($args) ;
  }  
  
}