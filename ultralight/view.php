<?php

class Ultralight_View {
  private $_layout ;
  private $_path ;
  private $_content ;
  
  public function __construct($path=null) {
    global $dispatcher ;
    if (!$path) {
      $path = $dispatcher->get_controller_name() ;
      $path .= '/' ;
      $path .= $dispatcher->get_action_name() ;
      $path .= '.tpl.php' ;
      $path = APPLICATION_ROOT . '/views/' . $path ;
    }
    $this->_path = $path ;
  }
  
  public function render($path = null) {
    $this->_content = $this->_get_content($path) ;   
    ob_start() ;
    include($this->_layout) ;
    $ret = ob_get_contents() ;
    ob_end_clean() ;
    print $ret ;
  }
  
  public function set_layout($path) {
    $this->_layout = $path ;
  }
  
  public function get_content() {
    return $this->_content ;
  }
  
  protected function _get_content() {
    if (!$path) { $path = $this->_path ; } 
    $path = $this->_path ;
    ob_start() ;
    include($path) ;
    $ret = ob_get_contents() ;
    ob_end_clean() ;
    return $ret ;
  }
  
}