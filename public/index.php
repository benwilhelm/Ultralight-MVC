<?php
 
//just an example
function sayhello(){
	echo "Hello to you too!";
}
 
//another example
function computesum(){
	$params = func_get_arg(0);
 
	$sum = 0;
	$i=0;
	foreach($params as $par){
		$par = intval($par);
		$sum += $par;
		if ($i !=0){echo " + ".$par;}
		else{echo $par;}
		$i++;
	}
 
	echo " = " . $sum;
}
 
//run the whole thing
include_once('../ultralight/bootstrap.php') ;
