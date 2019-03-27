<?php
class Clt extends Controller {

	private static var $d_semana = array('Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado');
	private static var $dia_semana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
	private static var $h_extra = date('22:00');

	function __construct() {
		parent::__construct();
	}

	/**
	* @see responsável por validar duas datas e verificar o período de trabalho no intervalo
	*/
	public function calcula_periodo_trabalho($incio, $termino, $d_semana=array(), $sabado=false, $domingo=false) {
		$data = array(
			'type' => 'danger',
			'msg' => 'Informações erradas ou faltantes!'
			);
		if(!empty($incio) && !empty($termino)) {
			if(empty($d_semana)) {
				$data['d_semana'] = self::$d_semana;
			}

			/**
			* @from = https://www.calculo-exato.com/calculo-de-adicional-noturno/
			*/
			if($hora >= self::$h_extra) {
				$data['hora_extra']['explicacao'] = 'Adicional noturno é uma remuneração extra, de no mínimo 20%, sobre o valor da hora normal de trabalho. A hora noturna ocorre das 22h até as 5h do dia seguinte e equivale a 52 minutos e 30 segundos da hora normal.';
			}

		}
		return json_encode($data);
	}

}