<?php
/**
* @see Valida/categoriza Strings usando Regex
* @author Mateus Soares [GIT: https://github.com/soaresmat]
*/
Class Regex {

	/**
	* @see
	* @return TRUE || FALSE [BOOL] 
	*/
	private function isdinheiro($text, $ln='pt-br') {

		$data = array('');
	
		return false;
		
	}

	/**
	* @see
	* @return TRUE || FALSE [BOOL] 
	*/
	private function isdata($text, $ln='pt-br') {
		$rex = '([01][0-9])(\.|\/|\-)([01][0-9])(\.|\/|\-)([0-9]{4})';
		$data = array('');
	
		return false;

	}

	/**
	* @see
	* @return TRUE || FALSE [BOOL] 
	*/
	private function isAno($text, $ln='pt-br') {
		$rex = '([01][0-9])(\.|\/|\-)([01][0-9])(\.|\/|\-)([0-9]{4})';
		$data = array('');
	
		return false;

	}

}