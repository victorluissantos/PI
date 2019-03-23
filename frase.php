<?php 
if(isset($_POST) && !empty($_POST)) {
	include('header.php');
	$frase = new Frases();
	$data=json_decode($frase->processar($_POST['word']));
	echo '<div class="alert alert-'.$data->type.' alert-dismissable">';
		echo '<b>'.$data->msg.'</b>';
		if($data->type == 'success') {
			echo '<pre>';
			var_dump($data->tooltips);
			echo '<br/>';
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
<form method="POST" action="">
	<input type="text" class="form-control" name="word" value="" />
	<input type="submit" class="btn btn-info pull-right" value="Processar" />
</form>