<?php include('header.php'); ?>

<style type="text/css">

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#body {
	margin: 0 15px 0 15px;
}

p.footer {
	text-align: right;
	font-size: 11px;
	border-top: 1px solid #D0D0D0;
	line-height: 32px;
	padding: 0 10px 0 10px;
	margin: 20px 0 0 0;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}
</style>

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
					<textarea name='pi' style='width:100%;' rows='".(count($informacoes)*6)."'>".str_replace('<br/>', "\n", $pi)."</textarea>
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

<?php include('footer.php'); ?>