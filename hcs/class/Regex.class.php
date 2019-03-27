<?php
/**
* @see Valida/categoriza Strings usando Regex
* @author Mateus Soares [GIT: https://github.com/soaresmat]
*/
Class Regex {

	/**
	* @see valida se é dinheiro
	* @return TRUE || FALSE [BOOL] 
	*/
	public function isdinheiro($text, $ln='pt-br') {

		$rex = '([01][0-9])(\.|\/|\-)([01][0-9])(\.|\/|\-)([0-9]{4})';
		
		if (preg_match("/".$rex."/", $text)) {
			return true;
		}
		return false;
	}

	/**
	* @see Valida se um determinado text é data
	* @return TRUE || FALSE [BOOL] 
	*/
	public function isdata($text, $ln='pt-br') {

		$rex = '([01][0-9])(\.|\/|\-)([01][0-9])(\.|\/|\-)([0-9]{4})';

		if (preg_match("/".$rex."/", $text)) {
			return true;
		}
		return false;
	}

	/**
	* @see Valida se é um ano
	* @return TRUE || FALSE [BOOL] 
	*/
	public function isAno($text, $ln='pt-br') {

		$rex = '([01][0-9])(\.|\/|\-)([01][0-9])(\.|\/|\-)([0-9]{4})';
		
		if (preg_match("/".$rex."/", $text)) {
			return true;
		}
		return false;
	}

}