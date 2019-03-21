<?php
/**
* @author Santos l. Victor
*/
Class Mapa {
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

	public static function silabas() {
		$data = array();
		$combinacoes = json_decode(self::vogais());
		// $combinacoes[] = 'R';
		// $combinacoes[] = 'H';

		foreach (json_decode(self::consoantes()) as $key => $value) {
			foreach ($combinacoes as $i => $val) {
				$data[] = $value.$val;
			}
		}
		return json_encode($data);
	}

	public static function verbos_irregulares() {
		$data = array(
			0=>'ser'
			);
		return json_encode($data);
	}

}