<?php	
	error_reporting(0);
	session_start();		
	if ($_SESSION[ 'username' ]!=''){
		return "1";
	}else{
		return "0";
	}
?>