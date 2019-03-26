<?php
/**
 * @see 
 * @author Santos L. Victor
*/
require_once 'contents/mapa.class.br.php';
require_once 'connect/model.class.php';

Class Controller extends Mapa {

	private $regex;

	function __construct() {
		parent::__construct();

		include('class'.DIRECTORY_SEPARATOR.'Palavras.class.php');
		include('class'.DIRECTORY_SEPARATOR.'Frases.class.php');

		$this->autoload( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . "class" );
	}

	function __autoload($class_name) {

		require_once("classes/$class_name.php");
	}

	/**
	* @see 
	*/
	function autoload( $path ) {
	    $items = glob( $path . DIRECTORY_SEPARATOR . "*" );

	    foreach ($items as $key => $item) {
	        
	        $isPhp = 'php'; //pathinfo( $item )(!empty(["extension"])?["extension"]:'php') === "php";

	        if ( is_file( $item ) && $isPhp ) {
	            require_once $item;
	        } elseif ( is_dir( $item ) ) {
	            $this->autoload( $item );
	        }
	    }
	}

	/**
	* @see fake "extends any" using magic function
	*/
	public function __call($method, $args)
	{
		$this->c->$method($args[0]);
	}

	/**
	* @see load a model from by name
	*/
	public static function load_model($name_class)
	{
		if(file_exists(__DIR__.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$name_class.'_model.php')) {
			require_once(file_exists(__DIR__.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$name_class.'_model.php'));
			return json_encode(array('type'=>'success', 'msg'=>'Model carregada com sucesso!','data'=>'File: '.file_exists(__DIR__.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$name_class.'_model.php')));
		} else {
			return json_encode(array('type'=>'danger', 'msg'=>'Model não encontrada','data'=>'File: '.file_exists(__DIR__.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$name_class.'_model.php')));
		}
	}

}
$core = new Controller();
?>