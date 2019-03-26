<?php
/**
* @author Santos L. Victor
*/
Class Textos {
	
	public static $mapa;

	function __construct() {
		self::$mapa = new Mapa();
	}

	public static function processar($frase, $ln='pt-br') {
		$data = array(
			'type' => 'danger',
			'msg' => 'Nenhum informação coletada !'
			);
		if() {

			if() {
				$frase = new Frases();
			}
		}
		return json_encode($data);
	}

	/**
	* @see  Recebe um texto e determina parametros para quebra de raciocínio lógico na analise textual
	* @author Santos L. Victor
	*/
	public static function quebra_deraciocinio($palavra, $ln='pt-br') {
		
	}

	/**
	* @author Santos L. Victor
	*/
	public function cognition($verbs, $sujects) {
		$data = array(
			'type' => 'danger',
			'msg' => 'Nenhum conexão cognitiva realizada'
			);
		if(!empty($verbs) || !empty($sujects)) {

			require_once __DIR__ . '/vendor/autoload.php';

			use Phpml\Classification\KNearestNeighbors;

			$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
			$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

			$classifier = new KNearestNeighbors();
			$classifier->train($samples, $labels);

			$classifier->predict([3, 2]);
			// return 'b'
		}

		return json_encode($data);
	}

}