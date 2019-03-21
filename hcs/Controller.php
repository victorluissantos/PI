<?php
Class Controller {
	function __construct() {	
		include('class/Palavras.class.php');		
		// foreach (glob("class/*") as $filename) {
		// 	echo $filename.__FILE__;
		// 	include $filename;
		// }
	}

	function __autoload($class_name) {
		require_once("classes/$class_name.php");
	}
}
$core = new Controller();
?>