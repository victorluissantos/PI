<?php 
if(isset($_POST) && !empty($_POST)) {
	include('header.php');
	$palavra = new Palavras();
	$data=json_decode($palavra->silabas($_POST['word']));

	echo '<div class="alert alert-'.$data->type.' alert-dismissable">';
		echo '<b>'.$data->msg.'</b>';
		if($data->type == 'success') {
			echo '<br/>';
			if(!empty($data->classificacao)) {
				echo '<br/>';
				echo '<code>';
				echo '<b>Classificação:</b>';
				print_r($data->classificacao);
				echo '</code>';
			}
			echo '<code>';
			echo '<b>Silabas:</b>';
			print_r($data->silabas);
			echo '</code>';
			echo '<code>';
			echo '<b>Vogais:</b>';
			print_r($data->vogais);
			echo '</code>';
			echo '<code>';
			echo '<b>Consoantes:</b>';
			print_r($data->consoantes);
			echo '</code>';
		}
	echo '</div>';
}
?>
<form method="POST" action="">
	<input type="text" class="form-control" name="word" value="" />
	<input type="submit" class="btn btn-info pull-right" value="Processar" />
</form>