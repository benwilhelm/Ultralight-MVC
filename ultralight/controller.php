<?php 

class Ultralight_Controller {
  
  protected $_view ;
  
  public function __construct() {
    $this->_view = new Ultralight_View() ;
  }
  
}