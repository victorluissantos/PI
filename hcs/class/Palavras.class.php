<?php
/**
* @see Processa palavras
* @author Santos L. Victor
*/
Class Palavras {
	public static $mapa;

	function __construct() {
		self::$mapa = new Mapa();
	}

	/**
	* @see retornar todas as silabas possíveis
	*/
	public static function list_silabas() {
		return json_encode(self::$mapa->silabas());
	}

	/**
	* @see  Recebe uma palavra e divide em silabas
	*/
	public static function silabas_n($palavra, $ln='pt-br') {
		$data = array(
			'msg' => 'Palavra não informada !',
			'type' => 'danger');
		if(!empty($palavra)) {
			if(count(explode(' ', $palavra)) > 1) {
				$data = array(
					'msg' => 'Palavra identificada como frase !',
					'type' => 'warning',
					'palavra' => $palavra,
					);
			} else {
				$data = array(
					'msg' => 'Palavra processada com sucesso !',
					'type' => 'success',
					'palavra' => $palavra,
					'classificacao' => '',
					'silabas' => array(0=>''),
					'vogais' => array(),
					'consoantes' => array()
					);

				$silabas = null; // controla concatenação das vogais
				foreach (str_split($palavra) as $key => $value) {
					if($key <=1 && in_array(strtoupper($value), json_decode(self::$mapa->vogais()))
						||
						in_array(strtoupper($value), json_decode(self::$mapa->vogais_fortes()))) {
						$data['vogais'][] = $value;
					} else {
						$vogal = $data['vogais'];
						if(in_array(strtoupper($value), json_decode(self::$mapa->vogais()))) {
							$data['vogais'] = __FILE__.__LINE__;
						} else {
							$data['vogais'] = __FILE__.__LINE__;
						}
						$data['vogais'] = __FILE__.__LINE__;
					}
				}
				$data['vogais'] = array_unique($data['vogais']);
				$data['consoantes'] = array_unique($data['consoantes']);
				$data['silabas'] = array_filter($data['silabas']);
			}
		}
		return $data;
	}

	/**
	* @see  Recebe uma palavra e divide em silabas
	*/
	public static function silabas($palavra, $ln='pt-br') {
		$data = array(
			'msg' => 'Palavra não informada !',
			'type' => 'danger');
		if(!empty($palavra)) {
			if(count(explode(' ', $palavra)) > 1) {
				$data = array(
					'msg' => 'Palavra identificada como frase !',
					'type' => 'warning',
					'palavra' => $palavra,
					);
			} else {
				$data = array(
					'msg' => 'Palavra processada com sucesso !',
					'type' => 'success',
					'palavra' => $palavra,
					'classificacao' => '',
					'silabas' => array(0=>''),
					'vogais' => array(),
					'consoantes' => array()
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

					// if(strlen($data['silabas'][$silabas]) == 3) {
					// 	$silabas++;
					// }

					if($key < 2 ) {
						if(in_array(strtoupper($palavra[$key]), json_decode(self::$mapa->consoantes()))) {
							if(!empty($data['silabas'][$silabas])
								&&
								strlen($data['silabas'][$silabas]) == 1
								) {
								$data['silabas'][$silabas] .= $value;
							} else {
								$silabas++;
								$data['silabas'][$silabas] = $value;
							}
						} else {
							$data['silabas'][$silabas] .= $value;
						}
					} else if (!$is_consoante) {
						if(!isset($palavra[$key+1]) && in_array($value, array('u'))) {
							$data['classificacao'] = 'Verbo no Passado';
							$data['silabas'][$silabas] .= $value;
						}
						else 
						{
							$data['silabas'][$silabas] .= $value;
						}
					}
					else if ($is_consoante)
					{
						if(isset($palavra[$key+1]) && in_array(strtoupper($palavra[$key+1]), json_decode(self::$mapa->consoantes())) 
							&& !in_array(strtoupper($palavra[$key+1]), array('H','R')))
						{
							$data['silabas'][$silabas] .= $value;
						}
						else if(!isset($palavra[$key+1]) || in_array($value, array('r', 'h')))
						{
							if(strtoupper(substr($palavra, -1))=='L' && preg_match('/\p{Lu}/u', $palavra)){
								$data['classificacao'] = 'Substantivo Próprio';
								$data['silabas'][$silabas] .= $value;
							} else if(strtoupper(substr($palavra, -1))=='L') {
								$data['classificacao'] = 'Substantivo Comum';
								$data['silabas'][$silabas] .= $value;
							} else if(strtoupper(substr($palavra, -1))=='R') {
								$data['classificacao'] = 'Verbo';
								$data['silabas'][$silabas] .= $value;
							} else if(strtoupper($value) == 'R') {
								$silabas++;
								$data['silabas'][$silabas] = $value;
								if( (strlen($palavra) - $key) == 4 || (strlen($palavra) - $key) == 1) {
									$data['classificacao'] = 'Verbo';
								} else {
									$data['classificacao'] = 'Substantivo Comum';
								}
							} else {
								if(strtoupper(substr($palavra, -1))=='S') {
									$data['classificacao'] = 'Substativo Plural';
								} else {
									$data['classificacao'] = 'Verbo';
								}
								$data['silabas'][$silabas] .= $value;
							}
						}
						else
						{
							$silabas++;
							$data['silabas'][$silabas] = $value;
						}
					}
					$data['letras'][] = $value;
				}
				$data['vogais'] = array_unique($data['vogais']);
				$data['consoantes'] = array_unique($data['consoantes']);
				$data['silabas'] = array_filter($data['silabas']);
			}
		}
		return json_encode($data);
	}
}