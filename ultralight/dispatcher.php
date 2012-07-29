<?php

class Dispatcher { 
  
  private static $instance; 
  private function __construct() {} 
  private $_controller_name ;
  private $_action_name ;

  public static function getInstance() { 
    if (!self::$instance) { 
      self::$instance = new Dispatcher(); 
    } 

    return self::$instance; 
  } 
  
  public function go() {
  	global $routes;
   
  	//stear clear, allow only leters, numbers and slashes
  	if(!empty($raw_route) and preg_match('/^[\p{L}\/\d]++$/uD', $_SERVER["PATH_INFO"]) == 0){
  		die("Invalid URL");
  	}
   
    $this->parse_url() ;
   
  	$controller_name = ucfirst($this->_controller_name) . "_Controller" ;
  	$action_name = strtolower($this->_action_name) . "_action" ;
   
  	//all checked, execute requested funcion with provided parameters
  	if (class_exists($controller_name)) {
    	$controller = new $controller_name() ;      
      if (method_exists($controller,$action_name)) {
        $controller->$action_name($this->_params);
      } else {
        $this->_404() ;
      }
  	} else {
      $this->_404() ;
    }
    
  }

  public function get_controller_name() {
    return $this->_controller_name ;
  }
  
  public function get_action_name() {
    return $this->_action_name ;
  }
  
  private function parse_url() {
    $url_pieces = explode("/",$_SERVER["PATH_INFO"]);
    array_shift($url_pieces) ;
    $path = implode('/',$url_pieces) ;
    $route = $this->_check_routes($path) ;

    if ($route) {
      $param_string = str_ireplace($route,'',$path) ;
      $this->_parameterize($param_string) ;
    } else {
    
    	$controller_name = $url_pieces[0] ? $url_pieces[0] : 'index' ;
    	$action_name = $url_pieces[1] ? $url_pieces[1] : 'index' ;
    	$params = array();
    	if(count($url_pieces)>2){
    		$params = array_slice($url_pieces, 2);
    		$this->_parameterize($params) ;
    	}	
      
    	$this->_controller_name = $controller_name ;
    	$this->_action_name = $action_name ;
    }
  }
  
  private function _check_routes($path) {
    global $routes ;
    if ($routes[$path]) {
      $route = $routes[$path] ;
      $route_pieces = explode('/',$route) ;
      $this->_controller_name = $route_pieces[0] ? $route_pieces[0] : 'index' ;
      $this->_action_name = $route_pieces[1] ? $route_pieces[1] : 'index' ;
      return $path ;
    } else {
    	$url_pieces = explode("/",$path);
    	array_pop($url_pieces) ;
    	if (!empty($url_pieces)) {
      	$path = implode('/',$url_pieces) ;
      	return $this->_check_routes($path) ;
      } else {
        return false ;
      }
    }
  }
  
  private function _parameterize($p) {
    if (is_string($p)) { $p = explode('/',$p) ; }
    if (is_array($p)) {
      $pairs = array_chunk($p,2) ;
      foreach ($pairs as $pair) {
        $params[$pair[0]] = $pair[1] ? $pair[1] : true ;
      }
      $this->_params = $params ;
    } else {
      throw new Exception("Dispatcher::parameterize expects a string or array") ;
    }
  }
  
  private function _404() {
    header("HTTP/1.0 404 Not Found");
    echo "The page you're trying to reach can't be found." ;
  }
} 


