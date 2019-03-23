<?php
/**
* @author Santos L. Victor
*/
Class Frases {
	
	public static $mapa;

	function __construct() {
		self::$mapa = new Mapa();
	}

	public static function processar($frase, $ln='pt-br') {
		$data = array(
			'msg' => 'Palavra não informada !',
			'type' => 'danger');
		if(!empty($frase)) {
			$data = array(
				'msg' => 'frase processada com sucesso !',
				'type' => 'success',
				'frase' => $frase,
				'palavras' => array(0=>'')
				);
			
			$palavra = new Palavras();
			$arr = explode(' ', $frase);
			
			foreach ($arr as $key => $value) {
				$data['palavras'][] = $value;
				if(in_array(strtoupper($value), json_decode(self::$mapa->artigos()))) {
					$data['artigos'][] = $value;
				} else {
					$rest = $palavra->silabas($value);
					$data['tooltips'][] = $rest;
				}
			}
		}
		return json_encode($data);
	}

	/**
	* @see  Recebe uma palavra e divide em silabas
	* @author Santos L. Victor
	*/
	public static function identifica($palavra, $ln='pt-br') {
		$data = array(
			'msg' => 'Palavra não informada !',
			'type' => 'danger');
		if(!empty($palavra)) {
			$data = array(
				'msg' => 'Palavra processada com sucesso !',
				'type' => 'success',
				'palavra' => $palavra,
				'silabas' => array(0=>'')
				);

			$silabas = 0; // controla concatenação das vogais
			foreach (str_split($palavra) as $key => $value) {
				$is_consoante = '';
				if(in_array(strtoupper($value), json_decode(self::$mapa->vogais()))) {
					$data['vogais'][] = $value;
					$is_consoante = false;
				} else if(in_array(strtoupper($value), json_decode(self::$mapa->consoantes()))) {
					$data['consoantes'][] = $value;
					$is_consoante = true;
				}

				if($key < 2 ) {
					$data['silabas'][$silabas] .= $value;
				} else if (!$is_consoante) {
					$data['silabas'][$silabas] .= $value;
				} else if ($is_consoante) {
					if(isset($palavra[$key+1]) && in_array(strtoupper($palavra[$key+1]), json_decode(self::$mapa->consoantes()))) 
					{
						$data['silabas'][$silabas] .= $value;
					} else if(!isset($palavra[$key+1]) && in_array($value, array('r'))) {
						$data['classificacao'] = 'Verbo';
						$data['silabas'][$silabas] .= $value;
					} else {
						$silabas++;
						$data['silabas'][$silabas] = $value;						
					}
				}
				$data['letras'][] = $value;
			}
		}
		return $data;
	}
}