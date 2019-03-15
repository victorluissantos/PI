<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resources/css/style.css'); ?>">
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<?php if(isset($informacoes) && !empty($informacoes)) {
			echo "<table width='100%'>
					<tr>
						<td width='50%'>";
			for ($i=0; $i < count($informacoes); $i++) { 
				echo "<p>If you would like to edit this page you'll find it located at:</p>
						<code>".$informacoes[$i]."</code>";
			}
			echo "</td>
				<td width='50%'>
					<textarea name='pi' style='width:100%;' rows='".(count($informacoes)*6)."'>".$pi."</textarea>
					<br>";
						for ($art=0; $art < count($arts); $art++) { 
							echo "<span>".$art['$art']."</span>";
						}
				echo "<br>
					<input type='button' value='Refinar' />
					<input type='button' value='Baixar PDF' />
					<input type='button' value='Baixar Word' />
					<input type='button' value='Compartilhar' />
				</td>
					</tr>
						</table>";
		} ?>
		<form action="" method="POST">
			<textarea name="caso" style="width:100%;" rows="20"><?php echo $caso; ?></textarea>
			<br>
			<input type="submit" value="processar" style="float:right;">
		</form>
		<br/>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>