<?php 

interface Ultralight_Interface_Dbtable {
  
  public function insert($args) ;
  public function fetch($id) ;
  public function fetch_all($ids=null) ;
}