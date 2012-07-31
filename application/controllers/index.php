<?php

class Index_Controller extends Application_Controller {
  public function __construct() {
    parent::__construct() ;
  }
  
  public function index_action() {
    $this->_view->render() ;
  }
  public function about_action() {
    $options = $this->db->get_table('options') ;
    $this->_view->rows = $options->fetch_all(array(3,1)) ;
    $this->_view->render() ;
  }
}