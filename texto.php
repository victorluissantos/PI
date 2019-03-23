<?php include('header.php'); ?>
<?php
if(isset($_POST) && !empty($_POST)) {
	$frase = new Frases();
	$data=json_decode($frase->processar($_POST['word']));
	echo '<div class="alert alert-'.$data->type.' alert-dismissable">';
		echo '<b>'.$data->msg.'</b>';
		if($data->type == 'success') {
			if(!empty($data->tooltips)) {
				echo '<br /><br />';
				foreach ($data->tooltips as $key => $value) {
					$arr = json_decode($value);
					echo '<button type="button" class="btn btn-light btn-sm" data-toggle="tooltip" data-html="true" title="';
						echo '<em>Classificação:</em><u>'.$arr->classificacao.'</u><br/><b>Sílabas:</b>';
						print_r($arr->silabas);
						echo '">';
	  						echo $arr->palavra;
					echo '</button>';

				}
			}
			if(!empty($data->palavras)) {
				echo '<code>';
				echo '<b>Palavras:</b>';
				print_r($data->palavras);
				echo '</code>';
			}
			if(!empty($data->verbos)) {
				echo '<code>';
				echo '<b>Verbos:</b>';
				print_r($data->verbos);
				echo '</code>';
			}
			if(!empty($data->substantivos)) {
				echo '<code>';
				echo '<b>Substantivo:</b>';
				print_r($data->substantivos);
				echo '</code>';
			}
			if(!empty($data->adjetivos)) {
				echo '<code>';
				echo '<b>Adjetivos:</b>';
				print_r($data->adjetivos);
				echo '</code>';
			}
			if(!empty($data->artigos)) {
				echo '<code>';
				echo '<b>Artigos:</b>';
				print_r($data->artigos);
				echo '</code>';
			}
		}
	echo '</div>';
}
?>
<form method="POST" action="" class="hsf">
	<div class="input-group mb-3">
		<textarea type="text" class="form-control" name="word"><?php echo isset($_POST['word'])?$_POST['word']:''; ?>Foi admitido em 01/JUNHO/2015 e dispensado, sem justa causa, em 04/DEZEMBRO/2018. Exerceu a função de caixa, na agência de Tagugatinga, com registro em sua CTPS. - Sua últia e maior remuneração doi no importe de R$ 2.500,00 (dois mil e quinhentos reis) mensais. - Sua jornada de trabalho era das 09h00 ás 16h30, de segundas a sextas-feiras, sempre com 30 minutos de intervalo para alimentação e descanso. Jamais recebeu o pagamento de qualquer hora extra. - Não usufruiu as férias referentes ao período aquisitivo 2016/2017. - Em que se pese tenha sido dispensado sem justa causa e tenha o aviso prévio sifo indenizado por opção do empregador, suas verbas recisórias foram-lhe pagas somente em 20/DEZEMBRO/2018.</textarea>
		<div class="input-group-append">
			<button class="btn btn-outline-info" type="submit">Processar</button>
		</div>
	</div>
</form>
<?php include('footer.php'); ?>