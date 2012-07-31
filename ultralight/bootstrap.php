<?php

if (!defined(ULTRALIGHT_ROOT)) {
  define(ULTRALIGHT_ROOT,$_SERVER['DOCUMENT_ROOT'] . '/../ultralight/' ) ;
}
if (!defined(APPLICATION_ROOT)) {
  define(APPLICATION_ROOT,$_SERVER['DOCUMENT_ROOT'] . '/../application/' ) ;
}
if (!defined(CONFIG_DIR)) {
  define(CONFIG_DIR,$_SERVER['DOCUMENT_ROOT'] . '/../config/' ) ;
}

foreach (scandir(ULTRALIGHT_ROOT) as $file) {
  if (is_file(ULTRALIGHT_ROOT . $file)) { include_once(ULTRALIGHT_ROOT . $file) ; }
}
foreach (scandir(APPLICATION_ROOT . 'helpers/') as $file) {
  if (is_file(APPLICATION_ROOT . 'helpers/' . $file)) { include_once(APPLICATION_ROOT . 'helpers/' . $file) ; }
}

include_once(CONFIG_DIR . 'config.php') ;
include_once(CONFIG_DIR . 'routes.php') ;

spl_autoload_register(function($class_name){
  $class_dirs['m'] = $_SERVER['DOCUMENT_ROOT'] . '/../application/models/' ;
  $class_dirs['v'] = $_SERVER['DOCUMENT_ROOT'] . '/../application/views/' ;
  $class_dirs['c'] = $_SERVER['DOCUMENT_ROOT'] . '/../application/controllers/' ;
  $class_dirs['u'] = $_SERVER['DOCUMENT_ROOT'] . '/../' ;
  $class_name = str_ireplace('_controller','',$class_name) ;
  $class_path = str_replace('_','/',$class_name) ;
  $class_path = strtolower($class_path) . ".php" ;

  foreach($class_dirs as $dir) {
    if (is_file($dir . $class_path)) {
      include_once($dir . $class_path) ;
      $loaded = true ;
      break ;
    }
  }

  if (!$loaded) {
    error_log("WARNING: Could not auto-load class $class_name") ;
  }
}) ;

$dispatcher = Dispatcher::getInstance() ;
$dispatcher->go();