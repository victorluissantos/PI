<?php 
include('header.php');
if(isset($_POST) && !empty($_POST)) {
	$palavra = new Palavras();
	$data=json_decode($palavra->processa($_POST['word']));

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
<form method="POST" action="" class="hsf">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="word" placeholder="Direito e Tecnologia, lado a lado no seu dia a dia">
		<div class="input-group-append">
			<button class="btn btn-outline-info" type="submit">Processar</button>
		</div>
	</div>
</form>
<?php include('footer.php'); ?>