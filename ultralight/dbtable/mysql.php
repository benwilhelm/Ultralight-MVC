<?php 

class Ultralight_Dbtable_Mysql extends Ultralight_Dbtable {

  protected $_name ;
  protected $_dbc ;
  
  public function __construct($dbc,$name) {
    $this->_dbc = $dbc ;
    $this->_name = $name ;
  }
  
  public function insert($args) {
    foreach ($args as $key => $val) {
      $keys[] = '`' . $key . '`' ;
      $vals[] = '"' . $val . '"' ;
    }
    
    $key_str = "(" . implode(',',$keys) . ")" ;
    $val_str = "(" . implode(',',$vals) . ")" ;
    
    $qry = "INSERT INTO {$this->_name} {$key_str} VALUES {$val_str}" ;
    $this->_dbc->query($qry) ;
    return $this->_dbc->insert_id ? $this->_dbc->insert_id : false ;
  }

  public function fetch($id) {
    $qry = "SELECT * FROM {$this->_name} WHERE id={$id}" ;
    return $this->_dbc->query($qry)->fetch_object() ;
  }
  
  public function fetch_all($ids=null) {
    if ($ids == null) {
      $where = '' ;
    } elseif (is_array($ids)) {
      $where = "WHERE id IN (" . implode(',',$ids) . ")" ;
    } else {
      throw new Exception("Invalid argument provided for Ultralight_Dbtable_Mysql::fetch_all") ;
    }
    
    $qry = "SELECT * FROM {$this->_name} {$where}" ;
    $rslt = $this->_dbc->query($qry) ;
    while ($obj = mysqli_fetch_object($rslt)) {
      $ret[] = $obj ;
    }
    //error_log(print_r($ret,true)) ;
    return $ret ;
  }
}