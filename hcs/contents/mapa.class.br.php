<?php
/**
* @author Santos l. Victor
*/
Class Mapa {
	
	function __construct() {
	}
	
	public static function vogais() {
		$data = array(
			0 => 'A',
			1 => 'E',
			2 => 'I',
			3 => 'O',
			4 => 'U',
			);
		return json_encode($data);
	}

	public static function vogais_fortes() {
		$data = array(
			0 => 'Á',
			1 => 'É',
			2 => 'Í',
			3 => 'Ó',
			4 => 'Ú',
			);
		return json_encode($data);
	}

	public static function todas_vogais() {
		return json_encode(array_merge(json_decode(self::vogais()),json_decode(self::vogais_fortes())));
	}

	public static function consoantes() {
		$data = array(
					0 => 'B',
					1 => 'C',
					2 => 'D',
					3 => 'F',
					4 => 'G',
					5 => 'H',
					6 => 'J',
					7 => 'K',
					8 => 'L',
					9 => 'M',
					10 => 'N',
					11 => 'P',
					12 => 'Q',
					13 => 'R',
					14 => 'S',
					15 => 'T',
					16 => 'V',
					17 => 'W',
					18 => 'X',
					19 => 'Z');
			
		return json_encode($data);
	}

	/**
	* @see Monta todas as possibilidades de silabas possíveis
	* @return [JSON] list
	*/
	public static function silabas() {
		$data = array();
		$combinacoes = json_decode(self::consoantes());
		$combinacoes[] = 'CR';
		$combinacoes[] = 'PR';
		$combinacoes[] = 'VR';
		$combinacoes[] = 'CH';
		$combinacoes[] = 'LH';
		$combinacoes[] = 'NH';
		$combinacoes[] = 'RR';

		foreach ($combinacoes as $key => $value) {
			foreach (json_decode(self::vogais()) as $i => $val) {
				$data[] = $value.$val;
			}
		}
		return json_encode($data);
	}

	public static function verbos_irregulares() {
		$data = array(
			0 => 'SOU',
			1 => 'É',
			2 => 'SOMOS',
			3 => 'SOIS',
			4 => 'SÃO',
			5 => 'SER',
			6 => 'SEJA',
			7 => 'SEJAM',
			8 => 'SER',
			9 => 'ESTAR',
			10 => 'ESTEVE',
			11 => 'ESTIVESSE',
			12 => 'SERÁ'
			);
		return json_encode($data);
	}


	public static function preposicoes() {
		$data = array(
			0 => 'NA',
			1 => 'NO',
			2 => 'DE',
			3 => 'DO',
			4 => 'EM'
			);
		return json_encode($data);
	}

	public static function artigos() {
		$data = array(
			0 => 'Á',
			1 => 'A',
			2 => 'Ó',
			3 => 'O',
			);
		return json_encode($data);
	}

	public static function pronome_pessoal() {
		$data = array(
			0 => 'EU',
			1 => 'TU',
			2 => 'ELE',
			3 => 'NÓS',
			4 => 'VÓS',
			5 => 'ELES'
			);
		return json_encode($data);
	}
}