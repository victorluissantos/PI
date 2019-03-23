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
					if(in_array(strtoupper($value), json_decode(self::$mapa->todas_vogais()))) {
						$data['vogais'][] = $value;
						$is_consoante = false;
					} else if(in_array(strtoupper($value), json_decode(self::$mapa->consoantes()))) {
						$data['consoantes'][] = $value;
						$is_consoante = true;
					}

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
						if(!isset($palavra[$key+1]) && in_array($value, array('u','i'))) {
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
								} else if(preg_match('/\p{Lu}/u', $palavra)) {
									$data['classificacao'] = 'Substantivo Próprio';
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
					$data['letras'][] = utf8_encode($value);
				}
				
				if(in_array(self::toupper($palavra), json_decode(self::$mapa->verbos_irregulares()))) {
					$data['classificacao'] = 'Verbo';
				} else if(in_array(self::toupper($palavra), json_decode(self::$mapa->pronome_pessoal()))) {
					$data['classificacao'] = 'Pronome Pessoal';
				} else if(empty($data['classificacao']) && preg_match('/\p{Lu}/u', $data['palavra'])) {
					$data['classificacao'] = 'Substantivo Próprio';
				} else if(in_array(self::toupper($palavra), json_decode(self::$mapa->preposicoes()))) {
					$data['classificacao'] = 'Preposição';
				}

				$data['vogais'] = array_unique($data['vogais']);
				$data['consoantes'] = array_unique($data['consoantes']);
				$data['silabas'] = array_filter($data['silabas']);
			}
		}
		return json_encode($data);
	}

	/**
	* @see Recebe um verbo e encontra a forma infinitiva
	*/
	public static function infinitivo($palavra) {
		$data = array(
			'msg' => 'Palavra não informada !',
			'type' => 'danger');

		if(!empty($palavra)) {
			$data = array(
				'msg' => 'Formatação não realizada !',
				'type' => 'warning',
				'classificacao' => 'Verbo Irregular',
				'verbo' => $palavra,
				'infinitivo' => ''.__FILE__.__LINE__
				);
			if(in_array(self::toupper($palavra), json_decode(self::$mapa->verbos_irregulares()))) {
				$data = array(
					'msg' => 'Formatação realizada com sucesso !',
					'type' => 'sucesso',
					'classificacao' => 'Verbo Irregular',
					'verbo' => $palavra,
					'infinitivo' => ''.__FILE__.__LINE__
					);

			} else {
				$infinitivo='';
				for ($i=strlen($palavra); $i >= 0; $i--) { 
					# code...
				}

				$data = array(
					'msg' => 'Formatação realizada com sucesso !',
					'type' => 'sucesso',
					'classificacao' => 'Verbo Irregular',
					'verbo' => $palavra,
					'infinitivo' => $infinitivo
					);
			}
		}
		return json_encode($data);
	}

	/**
	* @author deixa a palavra em letra maiuscula independente do encode
	*/
	private static function toupper($t) {
		$encoding = mb_internal_encoding(); // ou UTF-8, ISO-8859-1...
		return mb_strtoupper($t, $encoding); // retorna VIRÁ
	}
}