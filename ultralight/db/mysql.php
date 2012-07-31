<?php 

class Ultralight_Db_Mysql extends Ultralight_Db {
  
  protected $_dbc ;
  private static $_instance ;
  
  private function __construct($args) {
    extract($args) ;
    try {
      $this->_dbc = mysqli_connect($host, $username, $password, $database) ;
      $GLOBALS['dbc'] = $this->_dbc ;
    } catch (Exception $e) {
      error_log($e->getMessage()) ;
    }
  }
  
  public static function getInstance($args){	
  	if(!self::$_instance){
  		self::$_instance = new Ultralight_Db_Mysql($args);
  	}	
  	return self::$_instance;
  }  
  
  
  public function get_table($name) {
    return new Ultralight_Dbtable_Mysql($this->_dbc, $name) ;
  }
  
  
}