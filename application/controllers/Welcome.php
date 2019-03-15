<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['caso'] = 'Gastão foi contratado em 06.02.2013 para exercer as funções de atendente no Posto de Gasolina "Lava Jato" LTDA., com sede em Criciuma - SC., com o salário mensal no importe de R$ 2.300,00. Trabalhava sempre das 09:00 ás 18:00 horas, de segunda a sexta-feira, gosando de 1 hora de intervalo intrajornada, e das 10:00 ás 14:00 horas aos sábados, sem qualquer intervalo.';

		if(isset($_POST) && !empty($_POST['caso']) ) {
			$data = array(
				'competencia' => '',
				'autor' => '',
				'nacionalidade' => '...',
				'estado_civil' => '...',
				'profissao' => '',
				'cpf' => '...',
				'rg' => '...',
				'ctps_numero' => '...',
				'ctps_serie' => '...',
				'logradouro' => '...',
				'numero' => '...',
				'bairro' => '...',
				'cidade' => '...',
				'uf' => '',
				'estado' => '',
				'cep' => '',
				'estado' => '',
				);
			$data['arts'] = array();
			$informacoes = array();
			$data['pi'] = '';

			$arr = explode(' ', $_POST['caso']);

			for ($y = $i=0; $i < count($arr); $i++) {
				$pos = strpos( $arr[$i], ',' );
				if(isset($informacoes[$y])) {
					$informacoes[$y] .= $arr[$i].' ';
				} else {
					$informacoes[$y] = $arr[$i].' ';
				}
				if ($pos !== false && $arr[$i+1] != 'e') {
					$y++;
				}
			}
			$data['caso'] = $_POST['caso'];
			$data['informacoes'] = $informacoes;
		}
		$this->load->view('index', $data);
	}

	public function isDate($um,$dois, $tres, $quatro) {
		if(strlen($dois) > 1 && strlen($dois) < 5){
			return true;
		} else {
			return false;
		}
	}

	public function isbreakLine($current, $next){
		if($next == ',') {
			return false;
		} else {
			return true;
		}
	}

	public function buil_pi($text, $information) {
		$data = '';
		if(empty($text)) {
			$data = '';
		} else {
			$data =$data.$text;;
		}
		return $data;
	}

	public function welcome_message()
	{
		$this->load->view('welcome_message');
	}

	/**
	* @see Chaves de rand para poliformismo do word
	*/
	public function padroes() {
		$chaves = array(
			0 => array(
				'Reclamatória' => 'Reclamação'
				),
			1 => array(
				'Author' => 'Reclamante',
				'Réu' => 'Reclamado'
			)
		);
	}

	/**
	* @see Responsável por retornar os principais modelos de petições iniciais
	* @return [STRING]
	*/
	public function get_modelos($data) {
		$arr[0] = "EXCELENTÍSSIMO SENHOR DOUTOR JUIZ ".rand('DE DIREITO','')."".$data['competencia']." DE "$data['cidade']."/".rand($data['uf'],$data['estado']).".";
		$arr[0] .= '<br/><br/><br/>';
		$arr[0] .= $data['nome'].', '.$data['nacionalidade'].', '.$data['estado_civil'].', '.$data['profissao'].', portador do CPF nº. '.$data['cpf'].' e do RG '.$data['rg'].' (SSP/MG), portador da CTPS nº. '.$data['ctps_numero'].', série '.$data['ctps_serie'].', com endereço na '.$data['logradouro'].', nº. 81, Centro, Caratinga/MG, CEP 35.300-365, vem, respeitosamente, à presença de Vossa Excelência, por seu advogado abaixo assinado, propor a presente:';
		$arr[0] .= '<br/>';
		$arr[0] .= ' RECLAMATÓRIA TRABALHISTA, com fulcro no art. 840 da CLT, em face de POSTO SANTO GRALL LTDA, CNPJ 04.211.095.0001-43, com endereço à Avenida Tancredo Neves, n]. 181, Bairro Limoeiro, Caratinga/MG, CEP 35.300-101, pelos fatos e fundamentos que passa a expor:';
		return $arr[0];
	}

	public function get_competencia($codigo, $valor_causa) {
		switch ($codigo) {
		 	case 'CLT':
		 		return array('competencia'=>'DA VARA DO TRABALHO');
		 		break;
		 	
		 	case 'CC':
		 		$salario_minimo = 980.00;
		 		if($valor_causa > (30*$salario_minimo)) {
		 			return array('competencia'=>'DA VARA CIVEL DO FORO CENTRAL DA COMARCA DA REGIAO METROPOLITANA DE');
		 		} else {
		 			return array('competencia'=>'DO JUIZADO ESPECIAL CIVEL DO FORO CENTRAL DA COMARCA DA REGIAO METROPOLITANA DE');
		 		}
		 		break;

		 	default:
		 		return array('competencia'=>'DO JUIZADO ESPECIAL CIVEL DO FORO CENTRAL DA COMARCA DA REGIAO METROPOLITANA DE');
		 		break;
		 } 
	}
}
