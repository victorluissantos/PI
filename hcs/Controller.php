<?php
/**
 * @see 
 * @author Santos L. Victor
*/
require 'contents/mapa.class.br.php';

// require 'contents/mapa.class.br.php';
// require 'connect/model.class.br.php';

Class Controller extends Mapa {

	private $regex;

	function __construct() {
		parent::__construct();
		
		// $this->regex = new Regex();

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

	/**
	* @see fake "extends any" using magic function
	*/
	public function __call($method, $args)
	{
		$this->c->$method($args[0]);
	}

}
$core = new Controller();
?>