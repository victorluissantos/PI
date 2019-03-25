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
					echo '<button type="button" class="btn btn-light btn-sm" data-placement="top" data-toggle="tooltip" data-html="true" title="';
						echo '<em>Classificação:</em><u>'.$arr->classificacao.'</u><br/><b>Sílabas:</b>';
						print_r($arr->silabas);
						echo '">';
	  						echo $arr->palavra;
					echo '</button>';

				}
			}
			?>
			<div id="accordion">
			  	<div class="card">
			    	<div class="card-header" id="headingOne">
		        		<button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#lei" aria-expanded="true" aria-controls="lei">
		          		Leis / Artigos / Parágrafos/ Incisos
		        		</button>
			    	</div>
			    	<div id="lei" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
			      		<div class="card-body">
							<span class="badge badge-warning">Art: 121 CP</span>
			      		</div>
			    	</div>

			    	<div class="card-header" id="headingOne">
		        		<button class="btn btn-link btn-sm" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
		          		Informações
		        		</button>
			    	</div>
			    	<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
			      		<div class="card-body">
						<?php
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
						?>
			      		</div>
			    	</div>
			  	</div>
			</div>
<?php		}
	echo '</div>';
}
?>
<form method="POST" action="" class="hsf">
	<div class="input-group mb-3">
		<input type="text" class="form-control" name="word" value="<?php echo isset($_POST['word'])?$_POST['word']:''; ?>" placeholder="Direito e Tecnologia, lado a lado no seu dia a dia">
		<div class="input-group-append">
			<button class="btn btn-outline-info" type="submit">Processar</button>
		</div>
	</div>
</form>
<?php include('footer.php'); ?>