<?php
require 'contents/mapa.class.br.php';
Class Controller extends Mapa {

	function __construct() {
		parent::__construct();
		
		include('class/Palavras.class.php');
		include('class/Frases.class.php');
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