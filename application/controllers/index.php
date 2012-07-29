<?php

class Index_Controller extends Application_Controller {
  public function __construct() {
    parent::__construct() ;
  }
  
  public function index_action() {
    $this->_view->render() ;
  }
  public function about_action() {
    $this->_view->render() ;
  }
}