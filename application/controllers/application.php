<?php

class Application_Controller extends Ultralight_Controller {
  public function __construct() {
    parent::__construct() ;
    $this->_view->title = "Ultralight MVC" ;
    $this->_view->set_layout(APPLICATION_ROOT . '/views/layout.tpl.php') ;
  }
}